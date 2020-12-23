<?php

class Seo extends CI_Controller{

	function __construct() {
        parent::__construct();
        $this->load->model('seo_model', 'seo');
    }

    function index() {
        $data['seos'] = $this->seo->get_all_seos();
        $this->load->view('admin/seo_view', $data);
    }

    function add() {
        if (isset($_POST['submit'])) {
        	//print_r($_POST);die;
        	if($_POST['path']=='generic'){
                $_POST['path']=='generic'.rand(10,99);
            }
            if($this->seo->add_seo()){
                $this->session->set_flashdata('success', 'Seo Saved Successfully');
            }
            redirect('admin/seo');
        }
       
        $data['tot'] = 0;
        $this->load->view('admin/seo_manage', $data);
    }

    function edit($id) {
        if($id==1){
            redirect('admin/seo');
        }
        if (isset($_POST['submit'])) {
            if($_POST['path']=='generic'){
                $_POST['path']=='generic'.rand(10,99);
            }
            if($this->seo->edit_seo($id)){
                $this->session->set_flashdata('success', 'Seo Saved Successfully');
            }
            redirect('admin/seo');
        }
       
        $data['seo'] = $this->seo->get_seo_by_id($id);
        $data['tot'] = $data['seo']->num_rows();
        $this->load->view('admin/seo_manage', $data);
    }

    function delete($id) {
    	$query = $this->seo->get_seo_by_id($id);
        if($query->num_rows()>0){
        	$seo = $query->row();
			$this->seo->delete_seo($id);
        }
        $this->session->set_flashdata('success', 'Seo Deleted Successfully');
        redirect('admin/seo');
    }

    function generic_seo() {
        if ($this->input->post('btnSubmit')) {
            $this->seo->update_generic_seo();
            $data['message'] = 'Successfully saved.';
        }
        $data['details'] = $this->seo->get_generic_seo();
        $this->load->view('admin/generic_seo', $data);
    }

}