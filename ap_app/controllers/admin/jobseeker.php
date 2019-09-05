<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jobseeker extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Job Seekers';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->jobseeker_model->record_count('tbl_jobseeker');
		$config = pagination_configuration(base_url("admin/jobseeker"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->jobseeker_model->get_all_records_admin_listing($config["per_page"], $page);
		$data['result'] = $obj_result;
		$data["total_rows"] = $total_rows;
		$this->load->view('admin/jobseekers/jobseeker_view', $data);
		return;
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
		
		$this->jobseeker_model->update($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->jobseeker_model->delete($id);
		echo 'done';
		exit;
	}
}