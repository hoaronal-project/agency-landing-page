<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_Types extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Job Types';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->job_types_model->record_count('tbl_job_types');
		$config = pagination_configuration(base_url("admin/job_types"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->job_types_model->get_all_records($config["per_page"], $page);
		$data['result'] = $obj_result;
		$data["total_rows"] = $total_rows;
		$this->load->view('admin/job_types/job_types_view', $data);
		return;
	}
	
	public function add(){
		$data['msg'] = '';
		
		$this->form_validation->set_rules('type_name', 'Job Type', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$form_data =$this->load->view('admin/job_types/job_type_add_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(), 'form_data'=>$form_data));
			exit;
		}
		$data_array = array(
							'type_name' => $this->input->post('type_name'),
							'dated' => date("Y-m-d H:i:s")
		);
		$this->job_types_model->add($data_array);
		echo json_encode(array('msg'=>'done'));
	}
		
	public function update($id=''){
		
		if($id==''){
			echo json_encode(array('msg'=>'ID is missing. Please refresh the page and try again.'));
			exit;
		}
		$row = $this->job_types_model->get_record_by_id($id);
		$data['row']=$row ;
		$data['msg'] = '';
		
		$this->form_validation->set_rules('type_name', 'Job Type', 'trim|required');	
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$form_data =$this->load->view('admin/job_types/job_type_edit_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(), 'form_data'=>$form_data));
			exit;
		}
		$data_array = array(
							'type_name' => $this->input->post('type_name')
		);
		$this->job_types_model->update($id, $data_array);
		echo json_encode(array('msg'=>'done'));
	}
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->job_types_model->delete($id);
		echo 'done';
		exit;
	}
}