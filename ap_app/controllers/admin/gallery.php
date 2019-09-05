<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Photo Gallery Management';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->gallery_model->record_count('tbl_gallery');
		$config = pagination_configuration(base_url("admin/gallery"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->gallery_model->get_all_records($config["per_page"], $page);
		$data['result'] = $obj_result;
		$data["total_rows"] = $total_rows;
		$this->load->view('admin/gallery/gallery_view', $data);
		return;
	}
	
	public function add(){
		$data['title'] = SITE_NAME.': Gallery Mangement';
		$data['msg'] = '';
		$data_array = array();	
		$this->form_validation->set_rules('image_caption', 'Caption', 'trim');
		if (empty($_FILES['image_name']['name'])){
			$this->form_validation->set_rules('image_name', 'image', 'trim|required');
		}
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$form_data =$this->load->view('admin/gallery/gallery_add_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(), 'form_data'=>$form_data));
			exit;
		}
		$data_array = array(
							'image_caption' => $this->input->post('image_caption'),
							'dated' => date("Y-m-d H:i:s")
		);
		if (!empty($_FILES['image_name']['name'])){
			$real_path = realpath(APPPATH . '../public/uploads/gallery/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['overwrite'] = false;
			$config['max_size'] = 12000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image_name')){
				echo json_encode(array('msg'=>strip_tags($this->upload->display_errors())));
				exit;
			}
			
			$image = array('upload_data' => $this->upload->data());	
			$image_name = $image['upload_data']['file_name'];
			$thumb_config['image_library'] = 'gd2';
			$thumb_config['source_image']	= $real_path.'/'.$image_name;
			$thumb_config['new_image']	= $real_path.'/thumb/'.$image_name;
			$thumb_config['maintain_ratio'] = TRUE;
			$thumb_config['height']	= 400;
			$thumb_config['width']	 = 400;
			
			$this->image_lib->initialize($thumb_config);
			$this->image_lib->resize();
	
			$file_name = $image['upload_data']['file_name'];
			$data_array['image_name'] = $file_name;
		}
		
		$this->gallery_model->add($data_array);
		echo json_encode(array('msg'=>'done'));
	}
		
	public function update($id=''){
		
		if($id==''){
			echo json_encode(array('msg'=>'ID is missing. Please refresh the page and try again.'));
			exit;
		}
		$row = $this->gallery_model->get_record_by_id($id);
		$data['row']=$row ;
		$data['msg'] = '';
		$data['title'] = SITE_NAME.': Gallery Mangement';
		$data_array = array();
			
		$this->form_validation->set_rules('image_caption', 'Caption', 'trim');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$form_data =$this->load->view('admin/gallery/gallery_edit_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(), 'form_data'=>$form_data));
			exit;
		}
		$data_array = array(
							'image_caption' => $this->input->post('image_caption')
		);
		if (!empty($_FILES['image_name']['name'])){
			
			$real_path = realpath(APPPATH . '../public/uploads/gallery/');
			
			//Deleting previous file.
			@unlink($real_path.'/'.$row->image_name);
			@unlink($real_path.'/thumb/'.$row->image_name);
			
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['overwrite'] = false;
			$config['max_size'] = 12000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image_name')){
				echo json_encode(array('msg'=>strip_tags($this->upload->display_errors())));
				exit;
			}
			
			$image = array('upload_data' => $this->upload->data());	
			$image_name = $image['upload_data']['file_name'];
			$thumb_config['image_library'] = 'gd2';
			$thumb_config['source_image']	= $real_path.'/'.$image_name;
			$thumb_config['new_image']	= $real_path.'/thumb/'.$image_name;
			$thumb_config['maintain_ratio'] = TRUE;
			$thumb_config['height']	= 400;
			$thumb_config['width']	 = 400;
			
			$this->image_lib->initialize($thumb_config);
			$this->image_lib->resize();
	
			$file_name = $image['upload_data']['file_name'];
			$data_array['image_name'] = $file_name;
		}
		$this->gallery_model->update($id, $data_array);
		echo json_encode(array('msg'=>'done'));
		exit;
	}
	
	public function status($id='', $current_staus=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		if($current_staus==''){
			echo 'invalid current status provided.';
			exit;
		}
		
		if($current_staus=='active')
			$new_status= 'inactive';
		else
			$new_status= 'active';
		
		$data = array (
						'sts' => $new_status
		);
		
		$this->gallery_model->update($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete($id=''){
		
		if($id==''){
			echo json_encode(array('msg'=>'Oops! ID is missing. Please refresh the page and try again.'));
			exit;
		}
		
		$row = $this->gallery_model->get_record_by_id($id);
		$this->gallery_model->delete($id);
		
		//Deleting previous file.
		$real_path = realpath(APPPATH . '../public/uploads/gallery/');
		@unlink($real_path.'/'.$row->image_name);
		@unlink($real_path.'/thumb/'.$row->image_name);
		echo 'done';
		exit;
	}
}