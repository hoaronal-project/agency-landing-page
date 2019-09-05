<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Changepass extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Change Password';
		$data['msg'] = '';
		$this->form_validation->set_rules('pass', 'pass', 'trim|required|min_length[5]');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$row = $this->home_content_model->get_record_by_id(1);
			$data['row']=$row;
			$this->load->view('admin/pages/changepass_view', $data);
			return;
		}
		
		$data_array=array(
					'admin_password'=>$this->input->post('pass')
		);
		
		$this->admin_model->update(1,$data_array);
		$this->session->set_flashdata('updated_action', true);
		redirect(base_url('admin/changepass'));
	}
}