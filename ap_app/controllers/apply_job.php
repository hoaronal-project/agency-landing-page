<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Apply_Job extends CI_Controller {
	
	public function index($id=''){
		if (!$this->input->is_ajax_request()) {
   			echo json_encode(array('msg'=>'Wrong request.'));
			exit;
		}
		
		if($id==''){
			echo json_encode(array('msg'=>'Job not found. Please refresh page and try again.'));
			exit;
		}
		
		if(!$this->session->userdata('user_id')){
			echo json_encode(array('msg'=>'Session expired! Please login and then try again.'));
			exit;	
		}
		
		$data = array();
		$row = $this->jobs_model->get_active_record_by_id($id);
		if(!$row){
			echo json_encode(array('msg'=>'This job is not available.'));
			exit;
		}
		
		$row_js = $this->jobseeker_model->get_record_by_id($this->session->userdata('user_id'));
		if(!$row_js){
			echo json_encode(array('msg'=>'User not found. Please login and then try again.'));
			exit;
		}
		
		$is_already_applied = $this->applied_jobs_model->is_already_applied($this->session->userdata('user_id'), $id);
		
		if($is_already_applied){
			echo json_encode(array('msg'=>'You have already applied for this job.'));
			exit;	
		}
		$data['row']=$row;
		$data['row_js']=$row_js;
		$form_data = $this->load->view('apply_job_popup_view', $data, true);
		echo json_encode(array('msg'=>'', 'jt'=>$row->job_title,'form_data'=>$form_data));
	}
	//Applying for Job
	public function apply_now(){
		
		$this->form_validation->set_rules('cover_letter', 'cover letter', 'trim|required');
		$this->form_validation->set_rules('jid', 'Job ID', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		$id = $this->input->post('jid');
		
		if ($this->form_validation->run() === FALSE) {
			echo json_encode(array('msg'=>validation_errors()));
			exit;
		}
		
		$row = $this->jobs_model->get_active_record_by_id($id);
		$job_slug = url_title($row->job_title.'-'.$row->ID, '-', TRUE);
		
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
		
		$row_js = $this->jobseeker_model->get_record_by_id($this->session->userdata('user_id'));
		if(!$row_js){
			echo json_encode(array('msg'=>'User not found. Please login and then try again.'));
			exit;
		}
		
		//Check if already applied for this job
		$is_already_applied = $this->applied_jobs_model->is_already_applied($this->session->userdata('user_id'), $id);
		
		if($is_already_applied){
			echo json_encode(array('msg'=>'done', 'redirect_url'=>'job/'.$job_slug));
			exit;
		}
		
		if (!empty($_FILES['resume']['name'])){
			$real_path = realpath(APPPATH . '../public/uploads/resume/');
			@unlink($real_path.'/'.$row_js->resume);
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'doc|docx|pdf|rtf|txt|jpg|jpeg|png';
			$config['overwrite'] = false;
			$config['max_size'] = 12000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('resume')){
				$msg = $this->upload->display_errors();
				echo json_encode(array('msg'=>$msg));
				exit;
			}
			
			$resume_data = array('upload_data' => $this->upload->data());	
			$resume_name = $resume_data['upload_data']['file_name'];
			$this->jobseeker_model->update($this->session->userdata('user_id'), array('resume'=>$resume_name));
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
}