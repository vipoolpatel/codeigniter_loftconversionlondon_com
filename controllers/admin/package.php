<?php

class Package extends CI_Controller {

    function __construct() {
        parent::__construct();
      
        if (!$this->session->userdata('admin_id')) {
            redirect('admin/login');
        }
        if ($this->session->userdata('admin_role') == 'reporter') {
            redirect('admin/dashboard');
        }
        $this->load->model('admin/package_model', 'package');
    }

    function index() {
        $data['package'] = $this->package->get_package();
        $this->load->view('admin/package_view', $data);
    }

    function add_package() {
        if (isset($_POST['submit'])) {
            $this->package->add_package();
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/package');
        }
        $this->load->library('ckeditor');
        $this->load->library('ckFinder');
        //configure base path of ckeditor folder 
        $this->ckeditor->basePath = base_url() . 'js/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '550px';
        $this->ckeditor->config['height'] = '200px';
        //configure ckfinder with ckeditor config 
        $this->ckfinder->SetupCKEditor($this->ckeditor, '../../../js/ckfinder');
        
        $data['package'] = "";
        $this->load->view('admin/add_package', $data);
    }

    function edit_package($id) {
        if (isset($_POST['submit'])) {
            $this->package->edit_package($id);
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/package');
        }
        $this->load->library('ckeditor');
        $this->load->library('ckFinder');
        //configure base path of ckeditor folder 
        $this->ckeditor->basePath = base_url() . 'js/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '550px';
        $this->ckeditor->config['height'] = '200px';
        //configure ckfinder with ckeditor config 
        $this->ckfinder->SetupCKEditor($this->ckeditor, '../../../js/ckfinder');

        $data['package'] = $this->package->get_package_by_id($id);
        $this->load->view('admin/add_package', $data);
    }

    function delete_package($id) {
        $this->package->delete_package($id);
        $this->session->set_flashdata('success', 'Data Deleted Successfully');
        redirect('admin/package');
    }

}
