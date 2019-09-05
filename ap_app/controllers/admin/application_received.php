<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Application_Received extends CI_Controller {
	public function index($id=''){
		
		if($id==''){
			redirect(base_url('admin/jobs'));	
		}
		
		$data['title'] = SITE_NAME.': Application Received';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->applied_jobs_model->count_jobseekers_by_job_id($id);
		$config = pagination_configuration(base_url("admin/application_received"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(4) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->applied_jobs_model->get_jobseekers_by_job_id($id, $config["per_page"], $page);
		$data['result'] = $obj_result;
		$data["total_rows"] = $total_rows;
		$this->load->view('admin/application_received_view', $data);
		return;
	}
}