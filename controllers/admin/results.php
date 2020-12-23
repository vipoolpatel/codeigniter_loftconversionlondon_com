<?php

class Results    extends CI_Controller {

    function __construct() {
        parent::__construct();
      
        if (!$this->session->userdata('admin_id')) {
            redirect('admin/login');
        }
        if ($this->session->userdata('admin_role') == 'reporter') {
            redirect('admin/dashboard');
        }
        $this->load->model('results_model', 'results');
    }

    function index() {
        $data['result'] = $this->results->get_result();
        $this->load->view('admin/seo_results', $data);
    }
	
 
	
	
	
    function add_result() {
        if (isset($_POST['submit'])) {
            $this->results->add_result();
            $this->session->set_flashdata('success', 'SEO Result Saved Successfully');
            redirect('admin/results');
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
        
        $data['result'] = "";
        $this->load->view('admin/manage_results', $data);
    }

    function edit_result($id) {
        if (isset($_POST['submit'])) {
            $this->results->edit_result($id);
            $this->session->set_flashdata('success', 'SEO Result Saved Successfully');
            redirect('admin/results');
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

        $data['result'] = $this->results->get_result_by_id($id);
        $this->load->view('admin/manage_results', $data);
    }

    function delete_result($id) {
        $this->results->delete_result($id);
        $this->session->set_flashdata('success', 'SEO Result Deleted Successfully');
        redirect('admin/results');
    }
	


}
