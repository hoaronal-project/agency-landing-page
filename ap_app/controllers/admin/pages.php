<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Page Management';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->pages_model->record_count('tbl_page');
		$config = pagination_configuration(base_url("admin/pages"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->pages_model->get_all_records($config["per_page"], $page);
		$data['result'] = $obj_result;
		$data["total_rows"] = $total_rows;
		$this->load->view('admin/pages/pages_view', $data);
		return;
	}
	
	
	public function add(){
		$data['title'] = SITE_NAME.': Content Management';
		$data['msg'] = '';
		$data_array = array();
		$this->form_validation->set_rules('pageTitle', 'Heading', 'trim|required');
		$this->form_validation->set_rules('pageSlug', 'Page Slug', 'trim|required');
		$this->form_validation->set_rules('seoMetaTitle', 'Meta Title', 'trim|required|max_length[65]');
		$this->form_validation->set_rules('seoMetaKeyword', 'Meta Keywords', 'trim');
		$this->form_validation->set_rules('seoMetaDescription', 'Meta Description', 'trim|max_length[150]');	
		$this->form_validation->set_rules('editor1', 'Page Content', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$form_data =$this->load->view('admin/pages/pages_add_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(), 'form_data'=>$form_data));
			exit;
		}
		$page_slug = (stristr($this->input->post('pageSlug'),'.html')?$this->input->post('pageSlug'):$this->input->post('pageSlug').'.html');
		$data_array = array(
							'pageTitle' => $this->input->post('pageTitle'),
							'pageSlug' => $page_slug,
							'seoMetaTitle' => $this->input->post('seoMetaTitle'),
							'seoMetaKeyword' => $this->input->post('seoMetaKeyword'),
							'seoMetaDescription' => $this->input->post('seoMetaDescription'),
							'pageContent' => $this->input->post('editor1'),
							'menuTop' => $this->input->post('menuTop'),
							'menuBottom' => $this->input->post('menuBottom'),
							'dated' => date("Y-m-d H:i:s")
		);
		if (!empty($_FILES['pageImage']['name'])){
			$real_path = realpath(APPPATH . '../public/uploads/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['overwrite'] = false;
			$config['max_size'] = 12000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('pageImage')){
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
			$data_array['pageImage'] = $file_name;
		}
		
		$this->pages_model->add($data_array);
		echo json_encode(array('msg'=>'done'));
	}
		
	public function update($id=''){
		
		if($id==''){
			echo json_encode(array('msg'=>'Page ID is missing. Please refresh the page and try again.'));
			exit;
		}
		$row = $this->pages_model->get_record_by_id($id);
		$data['page_gallery_result'] = $this->pages_gallery_model->get_record_by_page_id($id);
		$data['row']=$row ;
		$data['msg'] = '';
		
		$this->form_validation->set_rules('pageTitle', 'Heading', 'trim|required');
		$this->form_validation->set_rules('pageSlug', 'Page Slug', 'trim|required');
		$this->form_validation->set_rules('seoMetaTitle', 'Meta Title', 'trim|required|max_length[65]');
		$this->form_validation->set_rules('seoMetaKeyword', 'Meta Keywords', 'trim');
		$this->form_validation->set_rules('seoMetaDescription', 'Meta Description', 'trim|max_length[150]');	
		$this->form_validation->set_rules('editor1', 'Page Content', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$form_data = $this->load->view('admin/pages/pages_edit_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(),'form_data'=>$form_data));
			exit;
		}
		
		$page_slug = (stristr($this->input->post('pageSlug'),'.html')?$this->input->post('pageSlug'):$this->input->post('pageSlug').'.html');
		
		$data_array = array(
							'pageTitle' => $this->input->post('pageTitle'),
							'pageSlug' => $page_slug,
							'seoMetaTitle' => $this->input->post('seoMetaTitle'),
							'seoMetaKeyword' => $this->input->post('seoMetaKeyword'),
							'seoMetaDescription' => $this->input->post('seoMetaDescription'),
							'menuTop' => $this->input->post('menuTop'),
							'menuBottom' => $this->input->post('menuBottom'),
							'pageContent' => $this->input->post('editor1')
		);
		if (!empty($_FILES['pageImage']['name'])){
			$real_path = realpath(APPPATH . '../public/uploads/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['overwrite'] = false;
			$config['max_size'] = 12000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('pageImage')){
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
			$data_array['pageImage'] = $file_name;
		}
		$this->pages_model->update($id, $data_array);
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
		
		if($current_staus=='Published')
			$new_status= 'Inactive';
		else
			$new_status= 'Published';
		
		$data = array (
						'pageStatus' => $new_status
		);
		
		$this->pages_model->update($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete($id=''){
		
		if($id==''){
			echo json_encode(array('msg'=>'Oops! page ID is missing. Please refresh the page and try again.'));
			exit;
		}
		
		$this->pages_model->delete($id);
		//$this->menu_pages_model->delete_by_page_id($id);
		echo 'done';
		exit;
	}
	
//For Page Gallery
	public function upload_gallery_image($id=''){
		
		if (!$this->input->is_ajax_request()) {
   			echo json_encode(array('msg'=>'Wrong request.'));
			exit;
		}
		
		if($id==''){
			echo json_encode(array('msg'=>'Page ID is missing. Please refresh the page and try again.'));
			exit;
		}
		$row = $this->pages_model->get_record_by_id($id);
		if(!$row){
			echo json_encode(array('msg'=>'Wrong Page ID provided'));
			exit;
		}
		if (empty($_FILES['galleryImageFile']['name'])){
			echo json_encode(array('msg'=>'Please select image file to upload.'));
			exit;
		}
		$data_array = array('pageID' => $id);
		if (!empty($_FILES['galleryImageFile']['name'])){
			$real_path = realpath(APPPATH . '../public/uploads/page_gallery/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['overwrite'] = false;
			$config['max_size'] = 12000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('galleryImageFile')){
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
			$data_array['galleryImageFile'] = $file_name;
		}
		$this->pages_gallery_model->add($data_array);
		$gallery_data='';
		$gallery_data_result = $this->pages_gallery_model->get_record_by_page_id($id);
		if($gallery_data_result){
			foreach($gallery_data_result as $row){
				$gallery_data.='<div style="position:relative; display:inline-block; padding:10px;" id="pg'.$row->pageGalleryID.'">
        <img src="'.base_url("public/uploads/page_gallery/".$row->galleryImageFile).'" style="max-width:100px;" /> <a href="javascript:;" onclick="remove_page_gallery_image('.$row->pageGalleryID.');" class="close" aria-label="close" style="color:#F00; opacity:0.8;">&times;</a>
        </div>';	
			}
		}
		echo json_encode(array('msg'=>'done', 'gallery_data'=>$gallery_data));
		exit;
	}
	
	public function remove_page_gallery_image($id=''){
		$row = $this->pages_gallery_model->get_record_by_id($id);
		$this->pages_gallery_model->delete($id);
		$real_path = realpath(APPPATH . '../public/uploads/page_gallery/');
		@unlink($real_path.'/'.$row->galleryImageFile);
		echo 'done';
		exit;
	}
	
}