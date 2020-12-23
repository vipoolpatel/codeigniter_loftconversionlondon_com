<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("user_lib");
        $this->load->model('admin/content_model', 'content');
        if (!$this->user_lib->is_logged_in()) {
            redirect(site_url("admin"));
        }
    }

    function index() {
        $data['list'] = $this->content->get_email_list();
        if ($data['list']->num_rows() > 0)
            $data['count'] = 1;
        else
            $data['count'] = 0;
        if ($this->input->post('btnsubmit')) {
            if ($this->content->update_admin_email()) {
                $this->session->set_flashdata('msg', 'Emails list has been saved successfully');
                redirect('admin/settings');
            } else {
                $this->session->set_flashdata('msg', 'Emails could not be saved. Please try again');
                $this->load->view('admin/settings_view', $data);
            }
        }
        else
            $this->load->view('admin/settings_view', $data);
    }

}

?>