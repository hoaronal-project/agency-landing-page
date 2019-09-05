<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends CI_Controller {
	
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
			$result = $this->gallery_model->get_all_records_by_sts('active');
			$data['news_result']=$this->news_resultset;
			$data['meta_title'] = SITE_NAME.': Gallery';
			$data['meta_keyword'] = 'Tech, Future, gallery, Tech Future';
			$data['meta_description'] = 'Tech Future Gallery';
			$data['result'] = $result;
			$data['common_row'] = $this->common_row;
			$data['menuTop'] = $this->menuTop;
			$data['menuBottom'] = $this->menuBottom;
			$this->load->view('gallery_view', $data);
	}
	
}