<?php

class Services extends CI_Controller{

	function __construct() {
        parent::__construct();
        $this->load->model('services_model', 'service');
    }

    function index() {
        $data['services'] = $this->service->get_services();
        $this->load->view('admin/services', $data);
    }

    function add() {
        if (isset($_POST['submit'])) {
        	//print_r($_POST);die;
            if($this->service->add_service()){
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
            redirect('admin/services');
        }
       
        $data['tot'] = 0;
        $this->load->view('admin/manage_service', $data);
    }

    function edit($id) {
        if (isset($_POST['submit'])) {
            if($this->service->edit_service($id)){
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
            redirect('admin/services');
        }
       
        $data['service'] = $this->service->get_service_by_id($id);
        $data['tot'] = $data['service']->num_rows();
        $this->load->view('admin/manage_service', $data);
    }

    function delete($id) {
    	$query = $this->service->get_service_by_id($id);
        if($query->num_rows()>0){
        	$service = $query->row();
        	$filename = $service->image;
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
			$this->service->delete_service($id);
        }
        $this->session->set_flashdata('success', 'Service Deleted Successfully');
        redirect('admin/services');
    }

    function upload_photo() {
        $filename = "service_" . rand(10000, 99999);
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
}