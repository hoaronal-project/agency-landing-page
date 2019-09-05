<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends CI_Controller {
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
		
		$data['title'] = 'Welcome to '.SITE_NAME;
		
		$this->form_validation->set_rules('fullname', 'full name', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|strip_all_tags');
		$this->form_validation->set_rules('address', 'address', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('city', 'city', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('zip', 'zip', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric|strip_all_tags');
		$this->form_validation->set_rules('website', 'website', 'trim|strip_all_tags');
		$this->form_validation->set_rules('comment', 'comment', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('captcha', 'code', 'trim|required|validate_ml_spam');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$data['title'] = SITE_NAME.' Contact Us';
			$data['cpt_code'] = create_ml_captcha();
			$data['news_result'] = $this->news_resultset;
			$data['common_row'] = $this->common_row;
			$data['menuTop'] = $this->menuTop;
			$data['menuBottom'] = $this->menuBottom;
			$this->load->view('contact_us_view',$data);
			return;
		}
		$body='<table width="581" border="0" cellspacing="5" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">
  <tr>
    <td colspan="2" align="left">Contact form submitted. Details are given below:</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="129" align="left">Date/Time:</td>
    <td width="442" align="left">'.date("m/d/Y H:i A").'</td>
  </tr>
  <tr>
    <td width="129" align="left">IP Address:</td>
    <td width="442" align="left">'.$this->input->ip_address().'</td>
  </tr>
  <tr>
    <td width="129" align="left">Full Name:</td>
    <td width="442" align="left">'.$this->input->post('fullname').'</td>
  </tr>
  <tr>
    <td width="129" align="left">Email Address:</td>
    <td width="442" align="left">'.$this->input->post('email').'</td>
  </tr>
  <tr>
    <td width="129" align="left">Street Address:</td>
    <td width="442" align="left">'.$this->input->post('address').'</td>
  </tr>
  <tr>
    <td width="129" align="left">Phone:</td>
    <td width="442" align="left">'.$this->input->post('phone').'</td>
  </tr>
  <tr>
    <td width="129" align="left">City:</td>
    <td width="442" align="left">'.$this->input->post('city').'</td>
  </tr>
  <tr>
    <td align="left">Zip Code:</td>
    <td align="left">'.$this->input->post('zip').'</td>
  </tr>
  <tr>
    <td align="left">Website:</td>
    <td align="left">'.$this->input->post('website').'</td>
  </tr>
  <tr>
    <td align="left">Comments:</td>
    <td align="left">'.$this->input->post('comment').'</td>
  </tr>
</table>';
		$config = array();
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
	
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from($this->input->post('email'), $this->input->post('fullname'));
		$this->email->to(SITE_EMAIL);
		$this->email->subject(SITE_NAME.': Contact Form has been submitted');
		$this->email->message($body);
		@$this->email->send();
		
		$this->session->set_flashdata('msg', 'Form has been submitted successfully.');
		redirect(base_url('contact'));
	}
}