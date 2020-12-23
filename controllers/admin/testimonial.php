<?php

class Testimonial extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->user_lib->is_logged_in()) {
            redirect(site_url("admin/login"));
        }
        $this->load->model('admin/testimonial_model');
    }

    function index() {
        $data['testimonials'] = $this->testimonial_model->get_testimonials();
        $this->load->view('admin/testimonial_main', $data);
    }

    function add() {
        if ($this->input->post('submit')) {

            $photo = $this->input->post('photo');
            if ($photo) {
                if (file_exists(BASEPATH . "../images/temp/full/" . $photo)) {
                    @copy(BASEPATH . "../images/temp/full/" . $photo, BASEPATH . "../images/frontend/full/" . $photo);
                    @copy(BASEPATH . "../images/temp/main/" . $photo, BASEPATH . "../images/frontend/main/" . $photo);
                    @copy(BASEPATH . "../images/temp/thumb/" . $photo, BASEPATH . "../images/frontend/thumb/" . $photo);

                    @unlink(BASEPATH . "../images/temp/full/" . $photo);
                    @unlink(BASEPATH . "../images/temp/main/" . $photo);
                    @unlink(BASEPATH . "../images/temp/thumb/" . $photo);
                }
            }
            $team_id = $this->testimonial_model->add_testimonial();
            $this->session->set_flashdata('message', 'Successfully saved.');
            redirect(site_url('admin/testimonial/'));
        } else {
            $this->load->library('ckeditor');
            $this->load->library('ckFinder');
            //configure base path of ckeditor folder 
            $this->ckeditor->basePath = site_url() . "/js/ckeditor/";
            $this->ckeditor->config['toolbar'] = 'Full';
            $this->ckeditor->config['language'] = 'en';
            $this->ckeditor->config['width'] = '725px';
            $this->ckeditor->config['height'] = '200px';
            //configure ckfinder with ckeditor config 
            $this->ckfinder->SetupCKEditor($this->ckeditor, '../../../js/ckfinder');

            $this->load->view('admin/testimonial_edit');
        }
    }

    function edit() {
        $test_id = $this->uri->segment(4);
        if ($this->input->post('submit')) {
            $photo = $this->input->post('photo');
            if ($photo != "") {
                if (file_exists(BASEPATH . "../images/temp/full/" . $photo)) {
                    @copy(BASEPATH . "../images/temp/full/" . $photo, BASEPATH . "../images/frontend/full/" . $photo);
                    @copy(BASEPATH . "../images/temp/main/" . $photo, BASEPATH . "../images/frontend/main/" . $photo);
                    @copy(BASEPATH . "../images/temp/thumb/" . $photo, BASEPATH . "../images/frontend/thumb/" . $photo);

                    @unlink(BASEPATH . "../images/temp/full/" . $photo);
                    @unlink(BASEPATH . "../images/temp/main/" . $photo);
                    @unlink(BASEPATH . "../images/temp/thumb/" . $photo);
                }
            }
            $this->testimonial_model->update_testimonial($this->input->post(), $test_id);
            $this->session->set_flashdata('message', 'Successfully saved.');
            redirect(site_url('admin/testimonial/edit/' . $test_id));
        }

        $this->load->library('ckeditor');
        $this->load->library('ckFinder');
        //configure base path of ckeditor folder 
        $this->ckeditor->basePath = site_url() . "/js/ckeditor/";
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '725px';
        $this->ckeditor->config['height'] = '200px';
        //configure ckfinder with ckeditor config 
        $this->ckfinder->SetupCKEditor($this->ckeditor, '../../../js/ckfinder');

        $data['details'] = $this->testimonial_model->get_testimonial_details($test_id);
        $this->load->view('admin/testimonial_edit', $data);
    }

    function sort_testimonial() {
        $items = $this->input->get('list');
        $items = explode(',', $items);
        $this->testimonial_model->sort_testimonials($items);
    }

    function delete($id) {
        $this->testimonial_model->delete_testimonial($id);
        redirect('admin/testimonial');
    }

    function upload_image() {
        $filename = time() . "_" . rand(10000, 99999);
        $resize_detail = $this->common_lib->get_resize_details("testimonial");
        $upload_path = BASEPATH . "../images/temp/full";
        $status = $this->common_lib->upload_image('image', $upload_path, $filename, $resize_detail);
        if ($status['status'] == "success") {
            $status['path'] = site_url('images/temp/thumb');
        }

        echo json_encode($status);
    }

}