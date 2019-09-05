<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Dashboard';
		$data['msg'] = '';
		$this->load->view('admin/dashboard_view', $data);
		return;
	}
		
}
