<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job extends CI_Controller {
	
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
	
	public function index($job_slug=''){
		$id = $this->get_int(str_replace('-','_',$job_slug));
		
		$data = array();
		$row = $this->jobs_model->get_active_record_by_id($id);
		if(!$row){
			redirect(base_url('staffing'));	
			exit;
		}
		
		$is_already_applied = $this->applied_jobs_model->is_already_applied($this->session->userdata('user_id'), $id);
		
		$data['is_already_applied']=$is_already_applied;
		$data['meta_title']=SITE_NAME.': '.$row->job_title;
		$data['meta_description']='';
		$data['news_result']=$this->news_resultset;
		$data['row']=$row;
		$data['common_row'] = $this->common_row;
		$data['menuTop'] = $this->menuTop;
		$data['menuBottom'] = $this->menuBottom;
		$this->load->view('job_view', $data);
	}
	
	public function register(){
			$this->apply();
	}
	
	public function apply($job_slug=''){
			if($this->session->userdata('user_id')){
				redirect(base_url('jobseeker/dashboard'));	
			} 
		
			$data['meta_title']=SITE_NAME.': Registration';
			$data['meta_description']='';
			$data['news_result']=$this->news_resultset;
			$data['cpt_code'] = create_ml_captcha();
			$data['common_row'] = $this->common_row;
			$data['menuTop'] = $this->menuTop;
			$data['menuBottom'] = $this->menuBottom;
			$this->load->view('registration_view', $data);	
			
	}
	
	//Applying for Job
	public function apply_for_job($job_slug=''){
		
		$id = $this->get_int(str_replace('-','_',$job_slug));
		$row = $this->jobs_model->get_active_record_by_id($id);
		
		if(!$this->session->userdata('user_id')){
			$this->session->set_flashdata('err_applied','You are not logged in. Please login and try again.');
			echo json_encode(array('msg'=>'done', 'redirect_url'=>'apply/'.$job_slug));
			exit;
		}
		if(!$row){
			$this->session->set_flashdata('err_applied','Opps! This job is no more available.');
			echo json_encode(array('msg'=>'done', 'redirect_url'=>'staffing'));
			exit;
		}
		
		//Check if already applied for this job
		$is_already_applied = $this->applied_jobs_model->is_already_applied($this->session->userdata('user_id'), $id);
		
		if($is_already_applied){
			echo json_encode(array('msg'=>'done', 'redirect_url'=>'job/'.$job_slug));
			exit;
		}
		
		$data_array = array(
							'job_seeker_ID' =>$this->session->userdata('user_id'),
							'job_ID' =>$id,
							'cover_letter' =>$this->input->post('cover_letter'),
							'dated' =>date("Y-m-d H:i:s")
							);
		
		//inserting into applied_job
		$this->applied_jobs_model->add($data_array);
		$this->session->set_flashdata('applied_action', true);
		echo json_encode(array('msg'=>'done', 'redirect_url'=>'job/'.$job_slug));
	}
	
	//Registration
	public function registration(){
		if (!$this->input->is_ajax_request()) {
   			redirect(base_url());
			exit;
		}
		$data['msg'] = '';
		//$this->form_validation->set_rules('jslug', 'Job ID', 'trim|required');
		$this->form_validation->set_rules('f_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('l_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|max_length[10]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('text_resume', 'resume txt', 'trim');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|is_unique[tbl_jobseeker.email_address]');
		$this->form_validation->set_rules('passcode', 'Password', 'trim|required');
		$this->form_validation->set_rules('captcha', 'code', 'trim|required|validate_ml_spam');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		if (empty($_FILES['resume']['name'])){
			$this->form_validation->set_rules('resume', 'resume', 'trim|required');	
		}
		
		if ($this->form_validation->run() === FALSE) {
			$cpt_code = create_ml_captcha();
			echo json_encode(array('msg'=>validation_errors(), 'cp'=>$cpt_code));
			exit;
		}
		
		$job_slug = $this->input->post('jslug');
		
		$data_array = array(
					'f_name' => $this->input->post('f_name'),
					'l_name' => $this->input->post('l_name'),
					'phone' => $this->input->post('phone'),
					'city' => $this->input->post('city'),
					'text_resume' => $this->input->post('text_resume'),
					'email_address' => $this->input->post('email_address'),
					'passcode' => $this->input->post('passcode'),
					'dated' => date('Y-m-d H:i:s')
		);
		
		if (!empty($_FILES['resume']['name'])){
			$real_path = realpath(APPPATH . '../public/uploads/resume/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'doc|docx|pdf|rtf|txt|jpg|jpeg|png';
			$config['overwrite'] = false;
			$config['max_size'] = 12000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('resume')){
				$msg = $this->upload->display_errors();
				$cpt_code = create_ml_captcha();
				echo json_encode(array('msg'=>$msg, 'cp'=>$cpt_code));
				exit;
			}
			
			$resume_data = array('upload_data' => $this->upload->data());	
			$resume_name = $resume_data['upload_data']['file_name'];
			$data_array['resume'] = $resume_name;
		}
		$user_id = $this->jobseeker_model->add($data_array);
		$member_data = array(
				 'user_id' => $user_id,
				 'name' => $data_array['f_name'].' '.$data_array['l_name'],
				 'is_user_login' => TRUE);
		$this->session->set_userdata($member_data);
		if($job_slug!=''){
			$this->apply_for_job($job_slug);
		} else {
			echo json_encode(array('msg'=>'done', 'redirect_url'=>'jobseeker/dashboard'));
		    exit;
		}	
	}
	
	//Ajax Login
	public function login(){
		if (!$this->input->is_ajax_request()) {
   			redirect(base_url());
			exit;
		}
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		//Ajax Login
		if ($this->form_validation->run() === FALSE) {
			echo json_encode(array('msg'=>validation_errors()));
			exit;	
		}	
		
		$row = $this->jobseeker_model->authenticate_user($this->input->post('email'), $this->input->post('pass'));
		if(!$row){
			echo json_encode(array('msg'=>'Wrong username or password provided.'));
			exit;
		}
			
		$member_data = array(
				 'user_id' => $row->ID,
				 'name' => $row->f_name.' '.$row->l_name,
				 'is_user_login' => TRUE);
		$this->session->set_userdata($member_data);
		$job_slug = $this->input->post('js');
		if($job_slug!=''){
			$this->apply_for_job($job_slug);
		} else{
			echo json_encode(array('msg'=>'done', 'redirect_url'=>'jobseeker/dashboard'));
		}
	}
	
	public function logout(){
		$member_data = array(
				 'user_id' => '',
				 'name' => '',
				 'is_user_login' => FALSE);
		$this->session->set_userdata($member_data);
		redirect(base_url());
	}
	
	private function get_int($string){
		return(int)preg_replace('/[^\-\d]*(\-?\d*).*/','$1',$string);
	}
}