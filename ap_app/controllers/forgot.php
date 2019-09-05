<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forgot extends CI_Controller {
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
		
		$data['title'] = SITE_NAME.' Recover Password';
		
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|strip_all_tags');
		$this->form_validation->set_rules('captcha', 'code', 'trim|required|validate_ml_spam');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$data['title'] = SITE_NAME.' Forgot Password';
			$data['cpt_code'] = create_ml_captcha();
			$data['news_result'] = $this->news_resultset;
			$data['common_row'] = $this->common_row;
			$data['menuTop'] = $this->menuTop;
			$data['menuBottom'] = $this->menuBottom;
			$this->load->view('forgot_view',$data);
			return;
		}
		
		//Check DB
		$row = $this->jobseeker_model->get_record_by_email($this->input->post('email'));
		
		if($row)
		{
		
		$body='<table width="581" border="0" cellspacing="5" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">
  <tr>
    <td colspan="2" align="left">Dear User,</td>
  </tr>
  <tr>
  <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="2">Your account details are given below:</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="129" align="left">URL:</td>
    <td width="442" align="left"><a href="'.base_url('register').'" target="_blank">'.base_url('register').'</a></td>
  </tr>
  <tr>
    <td width="129" align="left">Email Address:</td>
    <td width="442" align="left">'.$this->input->post('email').'</td>
  </tr>
  <tr>
    <td width="129" align="left">Password:</td>
    <td width="442" align="left">'.$row->passcode.'</td>
  </tr>
  <tr>
  <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="2">Regards,</td>
  </tr>
  <tr>
  <td colspan="2">'.SITE_NAME.'</td>
  </tr>
  
</table>';
		$config = array();
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
	
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from(SITE_EMAIL, SITE_NAME);
		$this->email->to($this->input->post('email'));
		$this->email->subject(SITE_NAME.': Password Recovery');
		$this->email->message($body);
		@$this->email->send();
		
		$this->session->set_flashdata('msg', 'We have sent you an email with password.');
		redirect(base_url('register'));
		}
		else
		{
			$this->session->set_flashdata('msg', 'The email address does not exist.');
			redirect(base_url('forgot'));
		}
	}
}