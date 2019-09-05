<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jobs extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Posted Jobs';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->jobs_model->record_count('tbl_jobs');
		$config = pagination_configuration(base_url("admin/jobs"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->jobs_model->get_all_records_admin_listing($config["per_page"], $page);
		$data['result'] = $obj_result;
		$data["total_rows"] = $total_rows;
		$this->load->view('admin/jobs/jobs_view', $data);
		return;
	}
	
	public function add(){
		$data['msg'] = '';
		
		$this->form_validation->set_rules('job_title', 'job title', 'trim|required');
		$this->form_validation->set_rules('job_type_ID', 'job type', 'trim|required');
		$this->form_validation->set_rules('city', 'city', 'trim|required|max_length[65]');
		$this->form_validation->set_rules('state', 'state', 'trim|required');
		$this->form_validation->set_rules('editor1', 'Description', 'trim|required');	
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$data['obj_types'] = $this->job_types_model->get_all_records_display();
			$form_data =$this->load->view('admin/jobs/job_add_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(), 'form_data'=>$form_data));
			exit;
		}
		$data_array = array(
							'job_title' => $this->input->post('job_title'),
							'job_type_ID' => $this->input->post('job_type_ID'),
							'city' => $this->input->post('city'),
							'state' => $this->input->post('state'),
							'description' => $this->input->post('editor1'),
							'dated' => date("Y-m-d H:i:s")
		);
		$this->jobs_model->add($data_array);
		echo json_encode(array('msg'=>'done'));
	}
		
	public function update($id=''){
		
		if($id==''){
			echo json_encode(array('msg'=>'Job ID is missing. Please refresh the page and try again.'));
			exit;
		}
		$row = $this->jobs_model->get_record_by_id($id);
		$data['row']=$row ;
		$data['msg'] = '';
		
		$this->form_validation->set_rules('job_title', 'job title', 'trim|required');
		$this->form_validation->set_rules('job_type_ID', 'job type', 'trim|required');
		$this->form_validation->set_rules('city', 'city', 'trim|required|max_length[65]');
		$this->form_validation->set_rules('state', 'state', 'trim|required');
		$this->form_validation->set_rules('editor1', 'Description', 'trim|required');	
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$data['obj_types'] = $this->job_types_model->get_all_records_display();
			$form_data =$this->load->view('admin/jobs/job_edit_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(), 'form_data'=>$form_data));
			exit;
		}
		$data_array = array(
							'job_title' => $this->input->post('job_title'),
							'job_type_ID' => $this->input->post('job_type_ID'),
							'city' => $this->input->post('city'),
							'state' => $this->input->post('state'),
							'description' => $this->input->post('editor1')
		);
//print_array($data_array);
//exit;
		$this->jobs_model->update($id, $data_array);
		echo json_encode(array('msg'=>'done'));
	}
	
	public function status($id='', $current_staus=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		if($current_staus==''){
			echo 'invalid current status provided.';
			exit;
		}
		
		if($current_staus=='active')
			$new_status= 'inactive';
		else
			$new_status= 'active';
		
		$data = array (
						'sts' => $new_status
		);
		
		$this->jobs_model->update($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->jobs_model->delete($id);
		echo 'done';
		exit;
	}
}