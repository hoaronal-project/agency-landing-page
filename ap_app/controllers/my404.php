<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My404 extends CI_Controller {
	
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
		$data['title'] = 'Page not found';
		$data['news_result']=$this->news_resultset;
		$data['common_row'] = $this->common_row;
		$data['menuTop'] = $this->menuTop;
		$data['menuBottom'] = $this->menuBottom;
		$this->output->set_status_header('404'); 
        $this->load->view('404_view',$data);
	}
}