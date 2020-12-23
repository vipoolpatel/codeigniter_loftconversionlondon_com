<?php

class Features extends CI_Controller{

	function __construct() {
        parent::__construct();
        $this->load->model('features_model', 'feature');
    }

    function index($type=0) {
        $data['features'] = $this->feature->get_features(false,NULL,$type);
        $data['type'] = $type;
        $this->load->view('admin/features', $data);
    }

    function add($type=0) {
        if (isset($_POST['submit'])) {
        	//print_r($_POST);die;
            if($this->feature->add_feature()){
            	$filename = $_POST['picture'];
            	$folders = array('full','main','thumb');
            	if($filename && is_array($folders)){
		            foreach($folders as $folder){
		                if(file_exists(BASEPATH.'../images/temp/'.$folder.'/'.$filename)){
		                    @copy(BASEPATH.'../images/temp/'.$folder.'/'.$filename,BASEPATH.'../images/frontend/'.$folder.'/'.$filename);
		                    @unlink(BASEPATH.'../images/temp/'.$folder.'/'.$filename);
		                }
		            }
		        }
            }
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            if($type == 0){
                $redirect = 'admin/home-features';
            }else if($type==1){
                $redirect = 'admin/seo-package-features';
            }else{
                $redirect = 'admin/seo-service-features';
            }
            redirect($redirect);
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
       
        $data['tot'] = 0;
        $data['type'] = $type;
        $this->load->view('admin/manage_feature', $data);
    }

    function edit($id,$type=0) {
        $data['type'] = $type;
        $data['feature'] = $this->feature->get_feature_by_id($id,$type);
        if($data['feature']->num_rows()<=0){
            show_404();
        }
        $oldImage = $data['feature']->row()->image;
        $data['tot'] = $data['feature']->num_rows();
        
        if (isset($_POST['submit'])) {
            if($this->feature->edit_feature($id)){
                $filename = $_POST['picture'];
                $folders = array('full','main','thumb');
                if($filename && is_array($folders)){
                    foreach($folders as $folder){
                        if(file_exists(BASEPATH.'../images/temp/'.$folder.'/'.$filename)){
                            @copy(BASEPATH.'../images/temp/'.$folder.'/'.$filename,BASEPATH.'../images/frontend/'.$folder.'/'.$filename);
                            @unlink(BASEPATH.'../images/temp/'.$folder.'/'.$filename);
                        }
                    }
                    if($oldImage && $oldImage != $filename){
                        foreach($folders as $folder){
                            if(file_exists(BASEPATH.'../images/temp/'.$folder.'/'.$oldImage)){
                                @unlink(BASEPATH.'../images/temp/'.$folder.'/'.$oldImage);
                            }
                            if(file_exists(BASEPATH.'../images/frontend/'.$folder.'/'.$oldImage)){
                                @unlink(BASEPATH.'../images/frontend/'.$folder.'/'.$oldImage);
                            }
                        }
                    }
                }
            }
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            if($type == 0){
                $redirect = 'admin/home-features';
            }else if($type==1){
                $redirect = 'admin/seo-package-features';
            }else{
                $redirect = 'admin/seo-service-features';
            }
            redirect($redirect);
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
       
        $this->load->view('admin/manage_feature', $data);
    }

    function delete($id,$type=0) {
    	$query = $this->feature->get_feature_by_id($id);
        if($query->num_rows()>0){
        	$feature = $query->row();
        	$filename = $feature->image;
        	$folders = array('full','main','thumb');
        	if($filename && is_array($folders)){
	            foreach($folders as $folder){
	                if(file_exists(BASEPATH.'../images/frontend/'.$folder.'/'.$filename)){
	                    @unlink(BASEPATH.'../images/frontend/'.$folder.'/'.$filename);
	                }
	                if(file_exists(BASEPATH.'../images/temp/'.$folder.'/'.$filename)){
	                    @unlink(BASEPATH.'../images/temp/'.$folder.'/'.$filename);
	                }
	            }
	        }
			$this->feature->delete_feature($id);
        }
        $this->session->set_flashdata('success', 'Feature Deleted Successfully');
        if($type == 0){
            $redirect = 'admin/home-features';
        }else if($type==1){
            $redirect = 'admin/seo-package-features';
        }else{
            $redirect = 'admin/seo-service-features';
        }
        redirect($redirect);
    }

    function upload_photo() {
        $filename = "feature_" . rand(10000, 99999);
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

            /*$config['width'] = 112;
            $config['height'] = 120;*/
            $config['width'] = 300;
            $config['height'] = 210;
           
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
}