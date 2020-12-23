<?php

class home_sidebar extends CI_Controller {

     function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('admin/home_model');
        $this->load->library("user_lib");
		$this->load->model('section_model');
    }

    function index() {
        $data['home_sidebar'] = $this->db->get('tbl_home_sidebar')->result();
        $this->load->view('admin/home_sidebar', $data);
    }

    function add() {
        if (isset($_POST['submit'])) {
            $array = array(
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                );
            
           $this->db->insert('tbl_home_sidebar',$array);
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/home_sidebar');
        }
        
        $this->load->view('admin/add_home_sidebar');
    }
    function edit($id) {
        if (isset($_POST['submit'])) {
              $array = array(
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                );
            
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_home_sidebar',$array);
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/home_sidebar');
        }
        $this->db->where('id',$id);
       $data['home_sidebar'] = $this->db->get('tbl_home_sidebar')->row();
        $this->load->view('admin/edit_home_sidebar',$data);
    }
    function delete($id) {
        $this->db->where('id',$id);
        $this->db->delete('tbl_home_sidebar');
        $this->session->set_flashdata('success', 'Data Deleted Successfully');
        redirect('admin/home_sidebar');
    }

  

}
