<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class content extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library("user_lib");
		$this->load->model('admin/content_model');
		if (!$this->user_lib->is_logged_in()) {
			//$this->user_lib->keep_url(current_url());
			redirect(site_url("admin"));
		}
	}

	// upload_image
	
	function upload_image() {
		$pages = $this->db->order_by('id','desc');
		$pages = $this->db->get('tbl_upload_image')->result();
		$data['pages'] = $pages;

		$this->load->view('admin/upload_image_list', $data);
	}


	function upload_image_add() {
		if (!empty($_FILES)) {
			$file_name = date('YmdHis').$_FILES["picture"]["name"];
			move_uploaded_file($_FILES["picture"]["tmp_name"],"upload/" .$file_name);

			$array = array(
				'file_name' => $file_name,
				'created_at' => date('Y-m-d H:i:s'),
			);

			$this->db->insert('tbl_upload_image', $array);

			$this->session->set_flashdata('success', 'Data Saved Successfully');
			redirect(base_url().'admin/upload_image');
		}

		$this->load->view('admin/upload_image_add');

	}

	function delete_upload_image($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_upload_image');
		$this->session->set_flashdata('success', 'Data Deleted Successfully');
		redirect(base_url().'admin/upload_image');
	}

	

	

	// end upload_image

	function index() {

		$data['pages'] = $this->content_model->get_pages();
		$this->load->view('admin/content_main', $data);
	}

	function image($id) {
		$gallery = $this->db->where('gallery_id', $id);
		$gallery = $this->db->get('tbl_content_image')->result();
		$data['gallery'] = $gallery;
		$data['id'] = $id;
		$this->load->view('admin/content_image', $data);
	}

	function delete_image($id, $image_id) {
		$this->db->where('id', $image_id);
		$this->db->delete('tbl_content_image');
		$this->session->set_flashdata('success', 'Data Deleted Successfully');
		redirect('admin/content/image/' . $id);
	}

	function image_add($id) {
		if (isset($_POST['submit'])) {
			$array = array(
				'gallery_id' => $id,
				'title' => $this->input->post('title'),
				'name' => $this->input->post('name'),
				'created_at' => date('Y-m-d H:i:s'),
			);
			$this->db->insert('tbl_content_image', $array);

			$this->session->set_flashdata('success', 'Data Saved Successfully');
			redirect('admin/content/image/' . $id);
		}

		$gallery = $this->db->where('gallery_id', $id);
		$gallery = $this->db->get('tbl_content_image')->result();
		$data['gallery'] = $gallery;
		$data['id'] = $id;
		$this->load->view('admin/content_image_add', $data);
	}

	function edit() {
		$page_id = $this->uri->segment(4);
		if ($this->input->post('submit')) {
			$this->content_model->update_page_content($page_id);
			$data['message'] = 'SUCCESSFULLY SAVED.';
		}
		$data['details'] = $this->content_model->get_page_details($page_id);
		$data['pages'] = $this->content_model->get_pages();
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder
		$this->ckeditor->basePath = base_url() . 'js/ckeditor/';
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['width'] = '710px';
		$this->ckeditor->config['height'] = '200px';
		//configure ckfinder with ckeditor config
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../js/ckfinder');
		$this->load->view('admin/edit_content', $data);
	}

	function delete_background_image($id) {
		$this->db->where('id', $id);
		$this->db->set('background_image', '');
		$this->db->update('tbl_contents');
		redirect(site_url('admin/content/edit/' . $id));
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_contents');
		redirect(site_url('admin/content'));
	}

	function pdf() {
		$page_id = $this->uri->segment(4);
		if ($this->input->post('btnSubmit')) {
			$pdfs = $this->input->post('files');
			$pdf_titles = $this->input->post('titles');
			$parent = $this->input->post('parent');
			if (is_array($pdfs) && !empty($pdfs)) {
				$pdf_arr = array_combine($pdfs, $pdf_titles);
				if (!empty($pdfs)) {
					foreach ($pdfs as $pdf) {
						@copy(BASEPATH . "../files/temp/content_pdf/" . $pdf, BASEPATH . "../files/content_pdf/" . $pdf);
						@unlink(BASEPATH . "../files/temp/content_pdf/" . $pdf);
					}
				}
				if ($this->content_model->add_pdf($pdf_arr, $parent, $page_id)) {
					$data['message'] = 'SUCCESSFULLY SAVED.';
				}
			}
		}
		$data['pdfs'] = $this->content_model->get_pdfs_by_page($page_id);
		$data['details'] = $this->content_model->get_page_details($page_id);
		$data['pages'] = $this->content_model->get_pages();
		$this->load->view('admin/content_pdf', $data);
	}

	function do_upload() {
		$upload_path_url = base_url() . 'files/temp/content_pdf/';

		$config['allowed_types'] = 'pdf';
		$config['upload_path'] = BASEPATH . "../files/temp/content_pdf/";
		$config['max_size'] = '50000';
		$config['overwrite'] = FALSE;
		$config['file_name'] = "content_" . time();

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());
			$info->error = $this->upload->display_errors();
			$this->load->view('add_pdf', $error);
		} else {
			$data = $this->upload->data();

			//set the data for the json array
			$info->original = $_FILES["userfile"]["name"];
			$info->name = $data['file_name'];
			$info->size = $_FILES["userfile"]["size"];
			$info->type = $data['file_type'];
			$info->url = $upload_path_url . $data['file_name'];
			$info->thumbnail_url = $upload_path_url . $data['file_name']; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
			$info->delete_url = base_url() . 'admin/content/deleteFile/' . $data['file_name'];
			$info->delete_type = 'DELETE';

			if (IS_AJAX) {
				//this is why we put this in the constants to pass only json data
				echo json_encode(array($info));
				//this has to be the only the only data returned or you will get an error.
				//if you don't give this a json array it will give you a Empty file upload result error
				//it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
			} else {
				// so that this will still work if javascript is not enabled
				$file_data['upload_data'] = $this->upload->data();
				$this->load->view('admin/upload_success', $file_data);
			}
		}
	}

	public function deleteFile($file) {
//gets the job done but you might want to add error checking and security
		$success = unlink(BASEPATH . '../files/temp/content_pdf/' . $file);
		//info to see if it is doing what it is supposed to
		$info->sucess = $success;
		$info->path = base_url() . 'files/temp/content_pdf/' . $file;
		$info->file = is_file(BASEPATH . '../files/temp/content_pdf/' . $file);
		if (IS_AJAX) {
//I don't think it matters if this is set but good for error checking in the console/firebug
			echo json_encode(array($info));
		} else {
			//here you will need to decide what you want to show for a successful delete
			$file_data['delete_data'] = $file;
			$this->load->view('admin/delete_success', $file_data);
		}
	}

	function delete_pdf() {
		$pdf_id = $this->uri->segment(4);
		$page_id = $this->uri->segment(5);
		if ($this->content_model->delete_pdf_by_id($pdf_id)) {
			redirect(site_url('admin/content/pdf/' . $page_id));
		}
	}

	function sort_pdf() {
		$items = $this->input->get('listitem');
		$this->content_model->sort_pdf($items);
	}

	function add() {

		if ($this->input->post('submit')) {
			$chechpagetitle = $this->db->where('page_seo', $this->input->post('page_seo'));
			$chechpagetitle = $this->db->get('tbl_contents')->num_rows();
			if ($chechpagetitle == '0') {
				$id = $this->content_model->add_page();
				redirect(site_url('admin/content/edit/' . $id));
			}

		}

		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder
		$this->ckeditor->basePath = base_url() . 'js/ckeditor/';
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['width'] = '710px';
		$this->ckeditor->config['height'] = '200px';
		//configure ckfinder with ckeditor config
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../js/ckfinder');
		//$data['parents'] = $this->content_model->get_parent_pages();
		$data['pages'] = $this->content_model->get_pages();
		$this->load->view('admin/add_content', $data);
	}

	function form_recipients() {
		if ($this->input->post('submit')) {
			$this->content_model->update_form_recipients();
		}
		$data['recipients'] = $this->content_model->get_form_recipients();
		$this->load->view('admin/form_recipients', $data);
	}

	function generic_seo() {
		if ($this->input->post('btnSubmit')) {
			$this->content_model->update_generic_seo();
			$data['message'] = 'Successfully saved.';
		}
		$data['details'] = $this->content_model->get_generic_seo();
		$this->load->view('admin/generic_seo', $data);
	}

	function sort_content() {
		$items = $this->input->get('list');
		$items = explode(',', $items);
		$this->content_model->sort_content($items);
	}

	//--slider add/edit functions

	function image_slider() {
		$data['images'] = $this->slider_model->get_slider_images();
		$submit = $this->input->post('submit');
		if ($submit) {
			$slider_images = $this->input->post('slider_image_add');

			if (!empty($slider_images)) {
				foreach ($slider_images as $slider_image) {
					if (!empty($slider_image)) {
						@copy(BASEPATH . "../images/temp/slider/full/" . $slider_image, BASEPATH . "../images/slider/full/" . $slider_image);
						@copy(BASEPATH . "../images/temp/slider/main/" . $slider_image, BASEPATH . "../images/slider/main/" . $slider_image);
						@copy(BASEPATH . "../images/temp/slider/thumb/" . $slider_image, BASEPATH . "../images/slider/thumb/" . $slider_image);

						@unlink(BASEPATH . "../images/temp/slider/full/" . $slider_image);
						@unlink(BASEPATH . "../images/temp/slider/main/" . $slider_image);
						@unlink(BASEPATH . "../images/temp/slider/thumb/" . $slider_image);
					}
				}
				$this->slider_model->add_slider_images($slider_images);
			}
			$data['images'] = $this->slider_model->get_slider_images();
			$data['message'] = 'Successfully saved';
		}
		$img_submit = $this->input->post('img_del');
		if ($img_submit) {
			$images_id = $this->input->post('image_id');
			if (!empty($images_id)) {
				foreach ($images_id as $image_id) {
					$this->slider_model->delete_slider_image_by_id($image_id);
					echo $this->db->last_query();
					die();
				}
			}
			$data['images'] = $this->slider_model->get_slider_images();
		}
		$this->load->view('admin/image_slider_view', $data);
	}

	function preview_article_image($button_id) {
		$resize_detail = $this->common_lib->get_resize_details("slider");
		$file_name = time() . "_" . rand("100000", "999999");
		$status = $this->common_lib->upload_image("myfile", BASEPATH . "/../images/temp/slider/full", $file_name, $resize_detail);
		$this->session->set_userdata(array("slider_image_add" => ""));
		if ($status["status"] == "success") {
			$status["thumb"] = site_url("images/temp/slider/thumb/" . $status["filename"]);

			$this->session->set_userdata(array("slider_image_" . $button_id => $status["filename"]));
			$status["image_name"] = $status["filename"];
			echo json_encode($status);
		} else {
			$status["error_string"] = strip_tags(html_entity_decode($status["error_string"]));
			echo json_encode($status);
		}
	}

	function del_slider_image() {
		$image_id = $this->input->post('image_id');
		$this->slider_model->delete_slider_image_by_id($image_id);
	}

	function sort_slider_images() {
		$items = $this->input->get('list');
		$items = explode(',', $items);
		$this->slider_model->sort_slider_images($items);
		redirect('content/image_slider');
	}

	function upload_photo() {
		$filename = "gallery_" . rand(10000, 99999);
		$config['upload_path'] = BASEPATH . '../images/temp/full/';

		$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
		$config['max_size'] = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$config['file_name'] = $filename;

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('image')) {

			$uploaded_image = $this->upload->data();
			//move_uploaded_file($_FILES["picture"]["tmp_name"],"upload/" . $_FILES["picture"]["name"]);
			$config['image_library'] = 'gd2';
			$config['source_image'] = BASEPATH . '../images/temp/full/' . $uploaded_image['file_name']; //$_FILES['picture']['name'];
			$config['new_image'] = BASEPATH . '../images/temp/main/' . $uploaded_image['file_name']; //$_FILES["picture"]["name"];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = 112;
			$config['height'] = 120;
			$config['width'] = 192;
			$config['height'] = 120;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			//$this->image_lib->clear();
			$config['image_library'] = 'gd2';
			$config['source_image'] = BASEPATH . '../images/temp/full/' . $uploaded_image['file_name']; //$_FILES['picture']['name'];
			$config['new_image'] = BASEPATH . '../images/temp/thumb/' . $uploaded_image['file_name']; //$_FILES["picture"]["name"];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = 56;
			$config['height'] = 60;
			$config['width'] = 96;
			$config['height'] = 60;

			$this->image_lib->initialize($config);
			if ($this->image_lib->resize()) {
				$data['status'] = "success";
				$data['filename'] = $uploaded_image['file_name'];
				$data['path'] = site_url('images/temp/thumb/');
				//$data['original']=$field['tmp_name'];
				$file = explode(".", $data['filename']);
				//$data['thumb'] = $file[0] . "_thumb." . $file[1];
				$data['thumb'] = $data['filename'];
			}
		} else {
			$data['status'] = "error";
			$data['error'] = "Image Upload Error:" . $this->upload->display_errors();
		}
		echo json_encode($data);
	}

	function featured_tabs() {
		if ($this->input->post('submit')) {
			//var_dump($this->input->post());exit;
			$id = $this->input->post('id');
			$featured['title'] = $this->input->post('title');
			$featured['image'] = $this->input->post('image');
			$featured['link'] = $this->input->post('link');
			if ($featured['link'] == 'forklifts' || $featured['link'] == 'material-handling') {
				$featured['type'] = 'products';
			} else {
				$featured['type'] = 'services';
			}

			if (file_exists(BASEPATH . '../images/temp/featured/full/' . $featured['image'])) {
				@copy(BASEPATH . "../images/temp/featured/full/" . $featured['image'], BASEPATH . "../images/featured/full/" . $featured['image']);
			}

			if (file_exists(BASEPATH . '../images/temp/featured/main/' . $featured['image'])) {
				@copy(BASEPATH . "../images/temp/featured/main/" . $featured['image'], BASEPATH . "../images/featured/main/" . $featured['image']);
				@unlink(BASEPATH . '../images/temp/featured/main/' . $featured['image']);
			}
			if (file_exists(BASEPATH . '../images/temp/featured/thumb/' . $featured['image'])) {
				@copy(BASEPATH . "../images/temp/featured/thumb/" . $featured['image'], BASEPATH . "../images/featured/thumb/" . $featured['image']);
				@unlink(BASEPATH . '../images/temp/featured/thumb/' . $featured['image']);
			}

			$this->content_model->update_featured($id, $featured);
			$data['message'] = "SUCCESSFULLY SAVED.";
		}

		$data['featured'] = $this->content_model->get_featured_tabs();
		$this->load->view('admin/featured_tabs', $data);
	}

	function sort_featured() {
		$items = $this->input->get('listitem');
		$this->content_model->sort_featured($items);
	}

	function delete_featured() {
		$featured_id = $this->uri->segment(4);
		$this->content_model->delete_featured($featured_id);
		redirect(site_url('admin/content/featured_tabs'));
	}

	function preview_image() {
		$id = $this->uri->segment(4);
		$file_name = "image_" . time();
		$upload_path = BASEPATH . "../images/temp/featured/full";
		$resize_detail = $this->common_lib->get_resize_details("featured");
		$status = $this->common_lib->upload_image("imageFile", $upload_path, $file_name, $resize_detail);
		if ($status["status"] == "success") {
			$status["full"] = site_url("images/temp/featured/full/" . $status["filename"]);
			$status["main"] = site_url("images/temp/featured/main/" . $status["filename"]);
			$status["image_name"] = $status["filename"];
			$status["upload"] = 1;
			echo json_encode($status);
		} else {
			$status["error_string"] = strip_tags(html_entity_decode($status["error_string"]));
			echo json_encode($status);
		}
	}

	function crop_image() {
		$x = $this->input->post('x');
		$y = $this->input->post('y');
		$width = $this->input->post('w');
		$height = $this->input->post('h');
		$filename = $this->input->post('fname');
		$this->content_model->save_cropping($x, $y, $width, $height, $filename, $type);
	}

	function admin_emails_manager() {
		$data['admin_emails'] = $this->content_model->get_admin_emails();
	}

	// 02/09/2020

	function testimonial_study($id)
	{

		$get = $this->db->order_by('id','desc');
		$get = $this->db->where('content_id',$id);
		$get = $this->db->get('tbl_testimonial_study')->result();
		$data['getRecord'] = $get;

		$data['content_id'] = $id;

		$this->load->view('admin/testimonial_study',$data);
	}
	function testimonial_study_add($id)
	{
		

		if(!empty($_POST))
		{
				if (!empty($_FILES["image_name"]["name"])) {
					$name = $_FILES["image_name"]["name"];

					$ext = end((explode(".", $name)));
					$image_name = date('ymdhis') . 'img.' . $ext;
					$folder = "upload/testimonial/";
					move_uploaded_file($_FILES["image_name"]["tmp_name"], $folder . $image_name);

				    $config['image_library'] 	= 'gd2';
	          	    $config['source_image'] 	= 'upload/testimonial/' . $image_name; //$_FILES['picture']['name'];
	                $config['new_image'] 		= 'upload/testimonial/' . $image_name; //$_FILES["picture"]["name"];
	            	$config['create_thumb'] 	= FALSE;
	            	$config['maintain_ratio'] 	= TRUE;
	            	$config['width'] = 600;
	            	$config['height'] = 400;
	    		    $this->load->library('image_lib', $config);
		            $this->image_lib->initialize($config);

	        		if ($this->image_lib->resize()) {

		            }


				} else {
					$image_name = '';
				}

				$array = array(
				'content_id'        => $id,
				'title'             => $this->input->post('title'),
				'sub_content_id'    => $this->input->post('sub_content_id'),
				'description'       => $this->input->post('description'),
				'image_name'        => $image_name,
				'created_date'      => date('Y-m-d H:i:s'),
			);

				$this->db->insert('tbl_testimonial_study', $array);

			
			redirect(base_url() . 'admin/content/testimonial_study/'.$id);
		}


		$content_list = $this->db->order_by('title', 'asc');
		$content_list = $this->db->get('tbl_contents')->result();		
		$data['content_list'] = $content_list;

		$this->load->view('admin/testimonial_study_add', $data);

	}

	function testimonial_study_edit($id, $content_id)
	{
		if(!empty($_POST))
		{
			if (!empty($_FILES["image_name"]["name"])) {

				if(file_exists('upload/testimonial/'.$this->input->post('old_image_name'))) {
                    unlink('upload/testimonial/'.$this->input->post('old_image_name'));
	             }


				$name = $_FILES["image_name"]["name"];

				$ext = end((explode(".", $name)));
				$image_name = date('ymdhis') . 'img.' . $ext;
				$folder = "upload/testimonial/";
				move_uploaded_file($_FILES["image_name"]["tmp_name"], $folder . $image_name);





 			    $config['image_library'] 	= 'gd2';
          	    $config['source_image'] 	= 'upload/testimonial/' . $image_name; //$_FILES['picture']['name'];
                $config['new_image'] 		= 'upload/testimonial/' . $image_name; //$_FILES["picture"]["name"];
            	$config['create_thumb'] 	= FALSE;
            	$config['maintain_ratio'] 	= TRUE;
            	$config['width'] = 600;
            	$config['height'] = 400;
    		    $this->load->library('image_lib', $config);
	            $this->image_lib->initialize($config);

        		if ($this->image_lib->resize()) {

	            }






            } else {
                $image_name = $this->input->post('old_image_name');
            }


			$array = array(
				'title'             => $this->input->post('title'),
				'sub_content_id'    => $this->input->post('sub_content_id'),
				'description'       => $this->input->post('description'),
				'image_name'        => $image_name,
			);

			$this->db->where('id', $id);
			$this->db->update('tbl_testimonial_study', $array);

			
			redirect(base_url() . 'admin/content/testimonial_study/'.$content_id);
		}
		
		$content_list = $this->db->order_by('title', 'asc');
		$content_list = $this->db->get('tbl_contents')->result();		
		$data['content_list'] = $content_list;

		$get = $this->db->where('id',$id);
		$get = $this->db->get('tbl_testimonial_study')->row();
		$data['getRecord'] = $get;

		$this->load->view('admin/testimonial_study_edit', $data);
	}

	public function testimonial_study_delete($id, $content_id)
	{
		


        $get_del =  $this->db->where('id',$id);
        $get_del =  $this->db->get('tbl_testimonial_study')->row();

         if (unlink('upload/testimonial/'.$get_del->image_name)) {
              echo "The file has been deleted";
          } else {
              echo "The file was not found";
          }

        $this->db->where('id', $id);
		$this->db->delete('tbl_testimonial_study');


		redirect(base_url() . 'admin/content/testimonial_study/'.$content_id);
	}

	
	public function content_type($id)
	{
		$get = $this->db->order_by('id','desc');
		$get = $this->db->where('content_id',$id);
		$get = $this->db->get('tbl_content_type')->result();
		$data['getRecord'] = $get;

		$data['content_id'] = $id;

		$this->load->view('admin/content_type_list',$data);
	}
	
	public function content_type_add($id)
	{


		if(!empty($_POST))
		{
				if (!empty($_FILES["image_name"]["name"])) {
					$name = $_FILES["image_name"]["name"];

					$ext = end((explode(".", $name)));
					$image_name = date('ymdhis') . 'img.' . $ext;
					$folder = "images/type/";
					move_uploaded_file($_FILES["image_name"]["tmp_name"], $folder . $image_name);

				    $config['image_library'] 	= 'gd2';
	          	    $config['source_image'] 	= 'images/type/' . $image_name; //$_FILES['picture']['name'];
	                $config['new_image'] 		= 'images/type/' . $image_name; //$_FILES["picture"]["name"];
	            	$config['create_thumb'] 	= FALSE;
	            	$config['maintain_ratio'] 	= FALSE;
	            	$config['width'] = 350;
	            	$config['height'] = 240;
	    		    $this->load->library('image_lib', $config);
		            $this->image_lib->initialize($config);

	        		if ($this->image_lib->resize()) {

		            }


				} else {
					$image_name = '';
				}

				$array = array(
				'content_id'        => $id,
				'title'             => $this->input->post('title'),
				'description'       => $this->input->post('description'),
				'default_image'     => $this->input->post('default_image'),
				'image_name'        => $image_name,
				'created_date'      => date('Y-m-d H:i:s'),
			);

				$this->db->insert('tbl_content_type', $array);

			
			redirect(base_url() . 'admin/content/content_type/'.$id);
		}

		$this->load->view('admin/content_type_add', $data);
	}

	public function content_type_edit($id, $content_id)
	{
		if(!empty($_POST))
		{
			if (!empty($_FILES["image_name"]["name"])) {

				if(file_exists('images/type/'.$this->input->post('old_image_name'))) {
                    unlink('images/type/'.$this->input->post('old_image_name'));
	             }


				$name = $_FILES["image_name"]["name"];

				$ext = end((explode(".", $name)));
				$image_name = date('ymdhis') . 'img.' . $ext;
				$folder = "images/type/";
				move_uploaded_file($_FILES["image_name"]["tmp_name"], $folder . $image_name);





 			    $config['image_library'] 	= 'gd2';
          	    $config['source_image'] 	= 'images/type/' . $image_name; //$_FILES['picture']['name'];
                $config['new_image'] 		= 'images/type/' . $image_name; //$_FILES["picture"]["name"];
            	$config['create_thumb'] 	= FALSE;
            	$config['maintain_ratio'] 	= FALSE;
            	$config['width'] = 350;
            	$config['height'] = 240;
    		    $this->load->library('image_lib', $config);
	            $this->image_lib->initialize($config);

        		if ($this->image_lib->resize()) {

	            }

            } else {
                $image_name = $this->input->post('old_image_name');
            }


			$array = array(
				'title'             => $this->input->post('title'),
				'description'       => $this->input->post('description'),
				'default_image'     => $this->input->post('default_image'),
				'image_name'        => $image_name,
			);

			$this->db->where('id', $id);
			$this->db->update('tbl_content_type', $array);

			
			redirect(base_url() . 'admin/content/content_type/'.$content_id);
		}
		

		$get = $this->db->where('id',$id);
		$get = $this->db->get('tbl_content_type')->row();
		$data['getRecord'] = $get;

		$this->load->view('admin/content_type_edit', $data);
	}
	public function content_type_delete($id, $content_id)
	{

        $get_del =  $this->db->where('id',$id);
        $get_del =  $this->db->get('tbl_content_type')->row();

         if (unlink('images/type/'.$get_del->image_name)) {
              echo "The file has been deleted";
          } else {
              echo "The file was not found";
          }

        $this->db->where('id', $id);
		$this->db->delete('tbl_content_type');


		redirect(base_url() . 'admin/content/content_type/'.$content_id);
	}


	// Question Section  Start

	public function question($id)
	{
		$get = $this->db->order_by('id', 'desc');
		$get = $this->db->where('content_id', $id);
		$get = $this->db->get('tbl_content_question')->result();
		$data['getRecord'] = $get;
		// print_r($data);
		// die();
		$data['content_id'] = $id;

		$this->load->view('admin/question_list', $data);
	}

	
	public function question_add($id) {

		if(!empty($_POST))
		    {
				if (!empty($_FILES["image_name"]["name"])) {
					$name = $_FILES["image_name"]["name"];

					$ext = end((explode(".", $name)));
					$image_name = date('ymdhis') . 'img.' . $ext;
					$folder = "upload/question/";
					move_uploaded_file($_FILES["image_name"]["tmp_name"], $folder . $image_name);

				    $config['image_library'] 	= 'gd2';
	          	    $config['source_image'] 	= 'upload/question/' . $image_name; //$_FILES['picture']['name'];
	                $config['new_image'] 		= 'upload/question/' . $image_name; //$_FILES["picture"]["name"];
	            	$config['create_thumb'] 	= FALSE;
	            	$config['maintain_ratio'] 	= FALSE;
	            	$config['width'] = 350;
	            	$config['height'] = 240;
	    		    $this->load->library('image_lib', $config);
		            $this->image_lib->initialize($config);

	        		if ($this->image_lib->resize()) {

		            }


				} else {
					$image_name = '';
				}

				$array = array(
				'content_id'        => $id,
				'title'             => $this->input->post('title'),
				'description'     => $this->input->post('description'),
				'image_name'        => $image_name,
				'order_by'       => $this->input->post('order_by'),
				'is_full_screen' => !empty($this->input->post('is_full_screen')) ? '1' : '0',
				'created_date'      => date('Y-m-d H:i:s'),
			);

				$this->db->insert('tbl_content_question', $array);

			
			redirect(base_url() . 'admin/content/question/'.$id);
		}

		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder
		$this->ckeditor->basePath = base_url() . 'js/ckeditor/';
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['width'] = '710px';
		$this->ckeditor->config['height'] = '200px';
		//configure ckfinder with ckeditor config
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../js/ckfinder');
		//$data['pages'] = $this->content_model->get_question();
		$this->load->view('admin/question_add');
	}

	public function question_edit($id, $content_id)
	{
		if(!empty($_POST))
		{
			if (!empty($_FILES["image_name"]["name"])) {

				if(file_exists('upload/question/'.$this->input->post('old_image_name'))) {
                    unlink('upload/question/'.$this->input->post('old_image_name'));
	             }

				$name = $_FILES["image_name"]["name"];

				$ext = end((explode(".", $name)));
				$image_name = date('ymdhis') . 'img.' . $ext;
				$folder = "upload/question/";
				move_uploaded_file($_FILES["image_name"]["tmp_name"], $folder . $image_name);

 			    $config['image_library'] 	= 'gd2';
          	    $config['source_image'] 	= 'upload/question/' . $image_name; //$_FILES['picture']['name'];
                $config['new_image'] 		= 'upload/question/' . $image_name; //$_FILES["picture"]["name"];
            	$config['create_thumb'] 	= FALSE;
            	$config['maintain_ratio'] 	= FALSE;
            	$config['width'] = 350;
            	$config['height'] = 240;
    		    $this->load->library('image_lib', $config);
	            $this->image_lib->initialize($config);

        		if ($this->image_lib->resize()) {

	            }

            } else {
                $image_name = $this->input->post('old_image_name');
            }


			$array = array(
				'title'             => $this->input->post('title'),
				'description'       => $this->input->post('description'),
				'order_by'       => $this->input->post('order_by'),
				'image_name'        => $image_name,
				'is_full_screen' => !empty($this->input->post('is_full_screen')) ? '1' : '0',
			);

			$this->db->where('id', $id);
			$this->db->update('tbl_content_question', $array);

			
			redirect(base_url() . 'admin/content/question/'.$content_id);
		}
		

		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder
		$this->ckeditor->basePath = base_url() . 'js/ckeditor/';
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['width'] = '710px';
		$this->ckeditor->config['height'] = '200px';
		//configure ckfinder with ckeditor config
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../../../js/ckfinder');
		
		$get = $this->db->where('id',$id);
		$get = $this->db->get('tbl_content_question')->row();
		$data['getRecord'] = $get;

		$this->load->view('admin/question_edit', $data);
	}

	public function question_delete($id, $content_id)
	{

        $get_del =  $this->db->where('id',$id);
        $get_del =  $this->db->get('tbl_content_question')->row();

        if(!empty($get_del->image_name))
        {
    		unlink('upload/question/'.$get_del->image_name);
        }

        $this->db->where('id', $id);
		$this->db->delete('tbl_content_question');


		redirect(base_url() . 'admin/content/question/'.$content_id);
	}

	// Question Section End


}

?>