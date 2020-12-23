<?php

class footer_logo extends CI_Controller {

       function __construct() {
        parent::__construct();
      
        if (!$this->session->userdata('admin_id')) {
            redirect('admin/login');
        }
        if ($this->session->userdata('admin_role') == 'reporter') {
            redirect('admin/dashboard');
        }
        $this->load->model('admin/Footer_logo_model', 'footer_logo');
    }

    function index() {
        $data['footer_logo'] = $this->footer_logo->get_footer_logo();
        $this->load->view('admin/footer_logo', $data);
    }

    function add() {
        if (isset($_POST['submit'])) {
            $this->footer_logo->add_footer_logo();
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/footer_logo');
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
        
        $data['footer_logo'] = "";
        $this->load->view('admin/add_footer_logo', $data);
    }


    function edit($id) {
       if (isset($_POST['submit'])) {
            $this->footer_logo->edit_footer_logo($id);
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/footer_logo');
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

        $data['footer_logo'] = $this->footer_logo->get_footer_logo_by_id($id);
        $this->load->view('admin/add_footer_logo', $data);
    }
 

    function delete($id) {
        $this->footer_logo->delete_footer_logo($id);
        $this->session->set_flashdata('success', 'Data Deleted Successfully');
        redirect('admin/footer_logo');
    }
  

}
