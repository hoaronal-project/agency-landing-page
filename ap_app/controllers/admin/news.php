<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage News';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->news_model->record_count('tbl_news');
		$config = pagination_configuration(base_url("admin/news"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->news_model->get_all_records($config["per_page"], $page);
		$data['result'] = $obj_result;
		$data["total_rows"] = $total_rows;
		$this->load->view('admin/news/news_view', $data);
		return;
	}
	
	public function add(){
		$data['msg'] = '';
		
		$this->form_validation->set_rules('news_title', 'news title', 'trim|required');
		$this->form_validation->set_rules('editor1', 'news details', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$form_data =$this->load->view('admin/news/news_add_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(), 'form_data'=>$form_data));
			exit;
		}
		
		$data_array = array(
							'news_title' => $this->input->post('news_title'),
							'news_details' => $this->input->post('editor1'),
							'dated' => date("Y-m-d H:i:s")
		);
		
		if (!empty($_FILES['news_image']['name'])){
			$real_path = realpath(APPPATH . '../public/uploads/news/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['overwrite'] = false;
			$config['max_size'] = 12000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('news_image')){
				$data['msg'] = strip_tags($this->upload->display_errors());
				echo json_encode(array('msg'=>strip_tags($this->upload->display_errors())));
				exit;
			}
			
			$image = array('upload_data' => $this->upload->data());	
			$image_name = $image['upload_data']['file_name'];
			$thumb_config['image_library'] = 'gd2';
			$thumb_config['source_image']	= $real_path.'/'.$image_name;
			$thumb_config['new_image']	= $real_path.'/'.$image_name;
			$thumb_config['maintain_ratio'] = TRUE;
			$thumb_config['height']	= 500;
			$thumb_config['width']	 = 500;
			
			$this->image_lib->initialize($thumb_config);
			$this->image_lib->resize();
	
			$file_name = $image['upload_data']['file_name'];
			$data_array['news_image'] = $file_name;
			
		}
		$this->news_model->add($data_array);
		echo json_encode(array('msg'=>'done'));
	}
		
	public function update($id=''){
		
		if($id==''){
			echo json_encode(array('msg'=>'ID is missing. Please refresh the page and try again.'));
			exit;
		}
		$row = $this->news_model->get_record_by_id($id);
		$data['row']=$row ;
		$data['msg'] = '';
		
		$this->form_validation->set_rules('news_title', 'news title', 'trim|required');
		$this->form_validation->set_rules('editor1', 'news details', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$form_data =$this->load->view('admin/news/news_edit_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(), 'form_data'=>$form_data));
			exit;
		}
		
		$data_array = array(
							'news_title' => $this->input->post('news_title'),
							'news_details' => $this->input->post('editor1')
		);
		
		if (!empty($_FILES['news_image']['name'])){
			$real_path = realpath(APPPATH . '../public/uploads/news/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['overwrite'] = false;
			$config['max_size'] = 12000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('news_image')){
				$data['msg'] = strip_tags($this->upload->display_errors());
				echo json_encode(array('msg'=>strip_tags($this->upload->display_errors())));
				exit;
			}
			
			$image = array('upload_data' => $this->upload->data());	
			$image_name = $image['upload_data']['file_name'];
			$thumb_config['image_library'] = 'gd2';
			$thumb_config['source_image']	= $real_path.'/'.$image_name;
			$thumb_config['new_image']	= $real_path.'/'.$image_name;
			$thumb_config['maintain_ratio'] = TRUE;
			$thumb_config['height']	= 500;
			$thumb_config['width']	 = 500;
			
			$this->image_lib->initialize($thumb_config);
			$this->image_lib->resize();
	
			$file_name = $image['upload_data']['file_name'];
			$data_array['news_image'] = $file_name;
			
		}
		$this->news_model->update($id, $data_array);
		echo json_encode(array('msg'=>'done'));
	}
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->news_model->delete($id);
		echo 'done';
		exit;
	}
}