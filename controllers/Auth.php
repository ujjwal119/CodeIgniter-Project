<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		if($this->session->userdata('login')){
				redirect(base_url().'user/task');
		}
	}
	
	public function index(){
		redirect(base_url().'auth/login');
	}	
	
	public function login(){
		if($this->input->post('user') && $this->input->post('pass')){
			$user = $this->input->post('user');
			$password = $this->input->post('pass');
			$this->load->model('Default_model', '', TRUE);
			$user_exists = $this->Default_model->user_exists($user);
			// print_r($user_exists);
			if($user_exists){
				if($password == $user_exists['user_pwd']){
					$data = array(
						'login' 	    => TRUE,
						'user_id'		=> $user_exists['user_name'],
						'name'			=> $user_exists['name']
					);
					// print_r($data);
					$this->session->set_userdata($data);
					redirect(base_url().'user/task');
					}else{
					$data['error'] = array(
						'Incorrect password entered'
					);
					$this->load->view('login', $data);
				}
			}
			else{
				$data['error'] = array(
					'No such user exist'
				);
				$this->load->view('login', $data);
			}

		}else{
			$this->load->view('login');
		}
	}
}


?>
