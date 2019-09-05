<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller {
	
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
	
	public function index($news_slug=''){
		if($news_slug!=''){
			$news_id = $this->get_id_from_slug($news_slug);
			$row = $this->news_model->get_record_by_id($news_id);
			if(!$row){
				$this->all_news();
				return;	
			}
			
			$data['news_result']=$this->news_resultset;
			$data['meta_title'] = $row->news_title;
			$data['meta_keyword'] = 'Tech, Future, '.$row->news_title;
			$data['meta_description'] = ellipsize(strip_tags($row->news_details),80,1);
			$data['row'] = $row;
			$data['common_row'] = $this->common_row;
			$data['menuTop'] = $this->menuTop;
			$data['menuBottom'] = $this->menuBottom;
			$this->load->view('news_view', $data);
			return;
		}
		redirect(base_url());
	}
	
	public function all_news(){
			$result = $this->news_model->get_all_records_front_end();
			$data['news_result']=$this->news_resultset;
			$data['meta_title'] = SITE_NAME.': News';
			$data['meta_keyword'] = 'Tech, Future, news, Tech Future';
			$data['meta_description'] = 'Tech Future News';
			$data['result'] = $result;
			$data['common_row'] = $this->common_row;
			$data['menuTop'] = $this->menuTop;
			$data['menuBottom'] = $this->menuBottom;
			$this->load->view('all_news_view', $data);
	}
	
	private function get_id_from_slug($slug){
		$data = explode('-',$slug);
		$data = array_reverse($data);
		return intval($data[0],10);
	}
}