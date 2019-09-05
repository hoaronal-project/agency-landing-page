<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Content extends CI_Controller {
	
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
	
	public function index($page_slug=''){
		if($page_slug!=''){
			$row = $this->pages_model->get_active_record_by_slug($page_slug);
			if(!$row){
				redirect(base_url('404'));
				return;	
			}
			$data['page_gallery_result'] = $this->pages_gallery_model->get_record_by_page_id($row->pageID);
			$data['news_result']=$this->news_resultset;
			$data['meta_title'] = $row->seoMetaTitle;
			$data['meta_keyword'] = $row->seoMetaKeyword;
			$data['meta_description'] = $row->seoMetaDescription;
			$data['common_row'] = $this->common_row;
			$data['row'] = $row;
			$data['menuTop'] = $this->menuTop;
			$data['menuBottom'] = $this->menuBottom;
			$this->load->view('content_view', $data);
			return;
		}
		redirect(base_url());
	}
}