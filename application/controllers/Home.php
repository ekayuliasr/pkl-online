<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth','refresh');
        }
        $this->load->model('API_Model', 'API');
        $this->load->model('Home_Model', 'Home');
    }
    
    public function index()
    {
        $isAdmin = $this->session->userdata('admin');
        if ($isAdmin) {
            if ($this->session->userdata('data')->ADMIN_ROLE == 2) {
                $totalUser = $this->API->getUserRow();
                $totalCompany = $this->API->getCompanyRow();
                $totalProduct = $this->API->getProductRow();
                $totalSelling = $this->API->getSellingRow();
                $totalParticipant = $this->db->get('REGISTER')->num_rows();
            } else {
                $totalUser = $this->API->getUserRow($this->session->userdata('data')->ADMIN_INSTITUTION);
                $totalCompany = $this->API->getCompanyRow();
                $totalProduct = $this->API->getProductRow();
                $totalSelling = $this->API->getSellingRow(null, $this->session->userdata('data')->ADMIN_INSTITUTION);
            }

            $data = array(
                'title' => "Admin Dashboard",
                'total_user' => $totalUser,
                'total_company' => $totalCompany,
                'total_product' => $totalProduct,
                'total_selling' => $totalSelling,
                'total_participant' => $totalParticipant,
            );
            $this->load->view('dist/index-admin', $data);
        } else {
            $totalProduct = $this->API->getProductRow($this->session->userdata('id'));
            $totalSelling = $this->API->getSellingRow($this->session->userdata('id'));
            $user = $this->API->getJoinUser($this->session->userdata('id'));
            $transaction = $this->API->getTransactionLimit($this->session->userdata('id',));
            $products = [];
            if (!empty($user->COMPANY_ID)) {
                $products = $this->API->getProductDistinct($this->session->userdata('id'), $user->COMPANY_ID);
                for ($i=0; $i < count($products); $i++) { 
                    $products[$i]->IMAGE = $this->API->getFirstChildById(array('PRODUCT_ID' => $products[$i]->PRODUCT_ID), 'PRODUCT_IMAGE');
                }
            }
            

            $jobs = $this->API->getJobsHome();
            $data = array(
                'title' => "Dashboard",
                'total_product' => $totalProduct,
                'total_selling' => $totalSelling,
                'products' => $products,
                'user' => $user,
                'jobs' => $jobs,
                'transaction' => $transaction
            );
            $this->load->view('dist/index', $data);
        }
    }

    public function product()
    {
        $isAdmin = $this->session->userdata('admin');
        if (!$isAdmin) {
            $totalProduct = $this->API->getProductRow($this->session->userdata('id'));
            $user = $this->API->getById(array('USER_ID' => $this->session->userdata('id')), 'USER');
            $products = [];
            if (!empty($user->COMPANY_ID)) {
                $products = $this->API->getChildById(array('USER_ID' => $this->session->userdata('id')), 'USER_PRODUCT');
                for ($i=0; $i < count($products); $i++) { 
                    $products[$i]->PRODUCT = $this->API->getChildById(array('PRODUCT_ID' => $products[$i]->PRODUCT_ID), 'PRODUCT');
                }
            }

            $data = array(
                'title' => "Produk Saya",
                'total_product' => $totalProduct,
                'products' => $products,
                'isAvailable' => $user->COMPANY_ID != null ? true : false
            );
           //echo json_encode($data);
           $this->load->view('dist/modules-product-user', $data);
        }
    }

    public function product_add()
    {
        $isAdmin = $this->session->userdata('admin');
        if (!$isAdmin) {
            $user = $this->API->getById(array('USER_ID' => $this->session->userdata('id')), 'USER');
            $products = $this->API->getProductDistinct($this->session->userdata('id'), $user->COMPANY_ID);

            for ($i=0; $i < count($products); $i++) { 
                $products[$i]->IMAGE = $this->API->getFirstChildById(array('PRODUCT_ID' => $products[$i]->PRODUCT_ID), 'PRODUCT_IMAGE');
            }
            $data = array(
                'title' => "Pilih Produk",
                'products' => $products,
                'isAvailable' => $user->COMPANY_ID != null ? true : false
            );
            $this->load->view('dist/modules-product-select-user', $data);
        }
    }

    public function add_product()
    {
        if (empty($this->input->post('id'))) {
            echo json_encode(
                array('status' => false, 'message' => 'Field id empty', 'data' => null)
            );
        } else {
            $key = $this->random_strings(5);
            $find = $this->API->getById(array('REFF_ID' => $key), 'USER_PRODUCT');
            while ($find != null) {
                $key = $this->random_strings(5);
                $find = $this->API->getById(array('REFF_ID' => $key), 'USER_PRODUCT');
            }

            $data = array(
                'REFF_ID' => $key,
                'REFF_DATE' => date("Y-m-d H:i:s"),
                'REFF_STATUS' => 1,
                'USER_ID' => $this->session->userdata('id'),
                'PRODUCT_ID' => $this->input->post('id')
            );

                $query = $this->db->insert('USER_PRODUCT', $data);
                if (!$query) {
                    echo json_encode(
                        array('status' => $query, 'message' => 'Error when add data product')
                    );
                } else {
                    echo json_encode(
                        array('status' => true, 'message' => 'Add data product success')
                    );
                }
        }
    }

    public function delete_product($id)
    {
        // $id = $this->uri->segment(5);
        // if (empty($id)) {
        //     echo json_encode(
        //        array('status' => false, 'message' => 'Field id empty', 'data' => null)
        //     );
        // } else {
        //     $result = $this->API->delete(array('id' => $id), 'USER_PRODUCT');
        //     echo json_encode(
        //        array('status' => true, 'message' => 'Delete data job by id success', 'data' => $result)
        //     );
        // }  
        
        $this->Home->delete($id);
		redirect('product');
    }

    public function detail_product()
    {

        $id = $this->uri->segment(3);
        $product = $this->db->query("
            SELECT * FROM USER_PRODUCT UP 
            JOIN USER U ON UP.USER_ID = U.USER_ID
            JOIN PRODUCT P ON UP.PRODUCT_ID = P.PRODUCT_ID 
            JOIN PRODUCT_CATEGORY PC ON P.CATEGORY_ID = PC.CATEGORY_ID
            JOIN PRODUCT_IMAGE PI ON P.PRODUCT_ID = PI.PRODUCT_ID 
            WHERE id = $id ")->row();

        $data = array(
            'title' => $product->REFF_ID,
            'product' => $product
        );
        $this->load->view('dist/modules-detail-product', $data);

       // echo json_encode($product);
       
    }

    public function logout()
    {
        session_destroy();

        redirect('auth','refresh');
    }

    private function random_strings($length_of_string)
    {
    
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result), 
                        0, $length_of_string);
    }
}

/* End of file Home.php */
