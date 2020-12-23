<?php

class category extends CI_Controller {

     function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('admin/home_model');
        $this->load->library("user_lib");
		$this->load->model('section_model');
    }

    function index() {
        $data['category'] = $this->db->get('tbl_category')->result();
        $this->load->view('admin/category', $data);
    }

    function add_category() {
        if (isset($_POST['submit'])) {
            $array = array(
                'category_name' => $this->input->post('category_name'),
                'category_slug' => $this->input->post('category_slug'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_desc' => $this->input->post('meta_desc'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'created_date' => date('Y-m-d H:i:s'),
                );
            
           $this->db->insert('tbl_category',$array);
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/category');
        }
        
        $this->load->view('admin/add_category');
    }
    function edit_category($id) {
        if (isset($_POST['submit'])) {
            $array = array(
                'category_name' => $this->input->post('category_name'),
                'category_slug' => $this->input->post('category_slug'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_desc' => $this->input->post('meta_desc'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                );
            
           $this->db->where('category_id',$this->input->post('id'));
           $this->db->update('tbl_category',$array);
            $this->session->set_flashdata('success', 'Data Updated Successfully');
            redirect('admin/category');
        }
        $this->db->where('category_id',$id);
       $data['category'] = $this->db->get('tbl_category')->row();
        $this->load->view('admin/edit_category',$data);
    }
    function delete_category($id) {
        $this->db->where('category_id',$id);
        $this->db->delete('tbl_category');
        $this->session->set_flashdata('success', 'Data Deleted Successfully');
        redirect('admin/category');
    }

  

}
