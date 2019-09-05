<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller {
	
	private $news_resultset;
	private $general_row;
	private $menuTop;
	private $menuBottom;
	public function __construct()
    {
      	parent::__construct();
		$news_result = $this->news_model->get_records_by_limit(2,0);
		$this->common_row = $this->home_content_model->get_record_by_id(1);
		$this->news_resultset = $news_result;
		$this->menuTop = $this->pages_model->get_active_records_by_menu('menuTop');
		$this->menuBottom = $this->pages_model->get_active_records_by_menu('menuBottom');
    }
	
	public function index(){
		$data = array();
		
		if(!$this->session->userdata('user_id')){
			redirect(base_url('register'));
		}
		$row=$this->jobseeker_model->get_record_by_id($this->session->userdata('user_id'));
		
		$data['msg'] = '';
		$this->form_validation->set_rules('f_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('l_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|max_length[10]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('text_resume', 'resume txt', 'trim');
		$this->form_validation->set_rules('passcode', 'Password', 'trim');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
				
		if ($this->form_validation->run() === FALSE) {
			$data['meta_title']=SITE_NAME.': Edit Profile';
			$data['meta_description']='';
			$data['news_result']=$this->news_resultset;
			$data['row']=$row;
			$data['common_row'] = $this->common_row;
			$data['menuTop'] = $this->menuTop;
			$data['menuBottom'] = $this->menuBottom;
			$this->load->view('jobseeker/profile_view', $data);
			return;
		}
		$data_array = array(
					'f_name' => $this->input->post('f_name'),
					'l_name' => $this->input->post('l_name'),
					'phone' => $this->input->post('phone'),
					'city' => $this->input->post('city'),
					'text_resume' => $this->input->post('text_resume')
		);
		
		if($this->input->post('passcode')!=''){
			$data_array['passcode']=$this->input->post('passcode');
		}
		
		if (!empty($_FILES['resume']['name'])){
			$real_path = realpath(APPPATH . '../public/uploads/resume/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'doc|docx|pdf|rtf|txt|jpg|jpeg|png';
			$config['overwrite'] = false;
			$config['max_size'] = 12000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('resume')){
				$msg = $this->upload->display_errors();
				$data['meta_title']=SITE_NAME.': Edit Profile';
				$data['meta_description']='';
				$data['news_result']=$this->news_resultset;
				$data['row']=$row;
				$data['msg']=$msg;
				$this->load->view('jobseeker/profile_view', $data);
			}
			
			$resume_data = array('upload_data' => $this->upload->data());	
			$resume_name = $resume_data['upload_data']['file_name'];
			$data_array['resume'] = $resume_name;
		}
		
		$this->jobseeker_model->update($this->session->userdata('user_id'), $data_array);
		$this->session->set_flashdata('msg', 'Profile has been updated successfully.');
		redirect(base_url('jobseeker/profile'));
	}
}