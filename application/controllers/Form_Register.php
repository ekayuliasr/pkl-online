<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->helper('url');
        $this->load->model('Register_Model', 'Register');
    }
    
    public function index()
    {
        $this->load->view('dist/form/form-register');
    }
	
	function register(){
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$no_hp = $this->input->post('no_hp');
		$status = $this->input->post('status');
        $asal_sekolah = $this->input->post('asal_sekolah');
        $tujuan = $this->input->post('tujuan');
		$jadwal = $this->input->post('jadwal');
 
		$data = array(
			'nama' => $nama,
			'email' => $email,
			'no_hp' => $no_hp,
			'status' => $status,
			'asal_sekolah' => $asal_sekolah,
			'tujuan' => $tujuan,
			'jadwal' => $jadwal
			);
		$this->Register->input_data($data,'register');
		redirect('Form_Register/index');
	}
 
/*
    public function register()
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$no_hp = $this->input->post('no_hp');
		$status = $this->input->post('status');
        $asal_sekolah = $this->input->post('asal_sekolah');
        $tujuan = $this->input->post('TUJUAN');
		$jadwal = $this->input->post('JADWAL');

		if ($email == '' || $nama == '' || $no_hp == '' || $status == '' || $asal_sekolah == '' || $tujuan == '' || $jadwal == '') {
			$this->msg = array('status' => false, 'message' => 'Data registrasi masih kosong', 'data' => null);
		} else {
			if ($this->API->checkEmail($email)) {
				$this->msg = array('status' => false, 'message' => 'Email sudah digunakan', 'data' => null);
			} else {
				$data = array(
					'NAMA' => $nama,
					'EMAIL' => $email, 
					'NP_HP' => $no_hp,
					'STATUS' => $status,
					'ASAL_SEKOLAH' => $asal_sekolah,
					'TUJUAN' => $tujuan,
                    'JADWAL' => $jadwal,
				);
	
				if ( $do = $this->Register->Register($data)) {
					$this->msg = array('status' => true, 'message' => 'User created', 'data' => $data);
				} else {
					$this->msg = array('status' => false, 'message' => 'Internal server error', 'data' => null);
				}
			}
			
		}

		echo json_encode($this->msg);
	}*/
}

/* End of file Home.php */
