<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_Content extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Homepage Content';
		$data['msg'] = '';
		$this->form_validation->set_rules('slider', 'slider', 'trim');
		$this->form_validation->set_rules('services', 'services', 'trim');
		$this->form_validation->set_rules('about_tech', 'about_tech', 'trim');
		$this->form_validation->set_rules('how_we_work', 'how_we_work', 'trim');
		$this->form_validation->set_rules('become_client', 'become_client', 'trim');
		$this->form_validation->set_rules('meet_tech_footer', 'meet_tech_footer', 'trim');
		$this->form_validation->set_rules('contact_info_footer', 'contact_info_footer', 'trim');
		$this->form_validation->set_rules('contact_address_contact_page', 'contact_address_contact_page', 'trim');
		$this->form_validation->set_rules('tech_text', 'tech_text', 'trim');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$row = $this->home_content_model->get_record_by_id(1);
			$data['row']=$row;
			$this->load->view('admin/pages/home_content_view', $data);
			return;
		}
		
		$data_array=array(
					'slider'=>$this->input->post('slider'),
					'services'=>$this->input->post('services'),
					'about_tech'=>$this->input->post('about_tech'),
					'how_we_work'=>$this->input->post('how_we_work'),
					'become_client'=>$this->input->post('become_client'),
					'contact_info_footer'=>$this->input->post('contact_info_footer'),
					'contact_address_contact_page'=>$this->input->post('contact_address_contact_page'),
					'tech_text'=>$this->input->post('tech_text'),
					'meet_tech_footer'=>$this->input->post('meet_tech_footer')
		);
		
		$this->home_content_model->update(1,$data_array);
		$this->session->set_flashdata('updated_action', true);
		redirect(base_url('admin/home_content'));
	}
}