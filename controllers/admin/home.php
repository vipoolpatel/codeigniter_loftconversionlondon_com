<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('admin/home_model');
        $this->load->library("user_lib");
		$this->load->model('section_model');
    }

    public function index() {
        redirect('admin/login');
    }

    public function login() {
        if ($this->user_lib->is_logged_in())
            redirect('admin/dashboard');
        $submit = $this->input->post('btn_submit');
        if ($submit) {
            $data['user_name'] = $this->input->post('user_name');
            $valid = $this->main_model->check_login($data['user_name'], $this->input->post('user_password'));
            if ($valid) {
                /* if($this->session->userdata('go_url'))
                  {
                  $go_url=$this->session->userdata('go_url');
                  $this->session->unset_userdata('go_url');
                  redirect($go_url);
                  } */
                redirect('admin/dashboard');
            } else {
                $data['message'] = "Invalid user name and password.";
                $this->load->view('admin/landing_view', $data);
            }
        }
        else
            $this->load->view('admin/landing_view');
    }
	
	


    public function logout() {
        $this->user_lib->log_off();
        redirect(site_url('admin'));
    }

    public function dashboard() {
        if (!$this->user_lib->is_logged_in())
            redirect(site_url("admin/login"));
        $this->load->view('admin/dashboard_view');
    }

    public function section(){
         if (!$this->user_lib->is_logged_in())
            redirect(site_url("admin/login"));

        if($this->input->post('submit')){
            $input = $this->input->post();
            $this->home_model->edit_home_section($input);
            $this->session->set_flashdata('success', 'Home Sections Updated Successfully!');
            redirect('admin/home/section');
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
		
        $data['homesection'] = $this->home_model->get_home_section();
        $this->load->view('admin/homesection_view',$data);
    }

}

/* End of file landing.php */
/* Location: ./application/controllers/admin/landing.php */