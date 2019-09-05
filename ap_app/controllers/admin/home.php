<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function index(){
		
		$data['title'] = SITE_NAME.': Login';
		$data['msg'] = '';
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/home_view', $data);
			return;
		}
		
		$password = $this->input->post('password');
		
		$userRow = $this->admin_model->authenticate_admin($this->input->post('username'), $password);
		if(!$userRow){
			$data['msg'] = 'Wrong username or password provided';
			$this->load->view('admin/home_view', $data);
			return;
		}
			
		$admin_data = array(
				 'admin_id' => $userRow->id,
				 'name' => $userRow->admin_username,
				 'is_admin_login' => TRUE);
		$this->session->set_userdata($admin_data);
		
		redirect(base_url().'admin/dashboard','');		
	}	
		
	public function logout() {
						
		$user_data = array(
		 'admin_id' => '',
		 'username' => '',
		 'photo' => '',
		 'name' => '',
		 'is_admin_login' => FALSE);
		  
		$this->session->set_userdata($user_data);
		$this->session->unset_userdata($user_data);
		redirect(base_url(), 'refresh'); 
	}
}
