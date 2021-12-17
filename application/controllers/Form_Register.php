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
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$status = $this->input->post('status');
        $institution = $this->input->post('institution');
        $goal = $this->input->post('goal');
		$schedule = $this->input->post('schedule');
 
		$data = array(
			'FULLNAME' => $name,
			'EMAIL' => $email,
			'PHONE' => $phone,
			'STATUS' => $status,
			'INSTITUTION' => $institution,
			'GOAL' => $goal,
			'SCHEDULE' => $schedule
			);
		$this->Register->input_data($data,'register');
		redirect('Form_Register/index');
	}

	public function participant()
    {
        // $participant =  $this->db->query("
		// SELECT * FROM REGISTER")->row();
        // $data = array(
        //     'title' => "Master Data Participant",
        //     'participant' => $participant,
        // );
		$data["title"] = "Peserta Sosialisasi";
		// $dt = $this->db->query("SELECT count(*) FROM register")->row();

		// $data = array(
		//   'dt' => $dt,
		// );

		$data["total"] = $this->Register->total();

		$data["participant"] = $this->Register->getAll();
        $this->load->view('dist/modules-participant', $data);
		//json_encode($data);
    }

	public function delete($id)
    {
        $this->Register->deleteParticipant($id);
		$this->load->view('dist/modules-participant');
    }
	
	

}

/* End of file Home.php */
