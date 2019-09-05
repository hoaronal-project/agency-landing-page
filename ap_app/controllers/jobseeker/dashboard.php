<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	
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
		$data = array();
		
		//Pagination starts
		$total_rows = $this->jobs_model->record_count('tbl_jobs');
		$config = pagination_configuration(base_url("jobseeker/dashboard"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->jobs_model->get_all_active_records($config["per_page"], $page);
		$data['news_result']=$this->news_resultset;
		$data['is_already_applied']='';
		$data['meta_title']=SITE_NAME.': Member Panel';
		$data['common_row'] = $this->common_row;
		$data['result'] = $obj_result;
		$data['menuTop'] = $this->menuTop;
		$data['menuBottom'] = $this->menuBottom;
		$this->load->view('jobseeker/dashboard_view', $data);
		return;
	}
}