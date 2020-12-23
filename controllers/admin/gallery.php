<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class gallery extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("user_lib");
        $this->load->model('admin/content_model');
        if (!$this->user_lib->is_logged_in()) {
            redirect(site_url("admin"));
        }
    }

    function index() {
        $data['tbl_gallery'] = $this->db->get('tbl_gallery')->result();
        $this->load->view('admin/gallery_main', $data);
    }
    
    function image($id) {
        $gallery = $this->db->where('gallery_id',$id);
        $gallery = $this->db->get('tbl_gallery_image')->result();
        $data['gallery'] = $gallery;
        $data['id'] = $id;
        $this->load->view('admin/gallery_main_image', $data);
    }
    
    function delete_image($id, $image_id)
    {
        $this->db->where('id',$image_id);
        $this->db->delete('tbl_gallery_image');
        $this->session->set_flashdata('success', 'Data Deleted Successfully');
        redirect('admin/gallery/image/'.$id);
    }
    
    function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('tbl_gallery');
        
        $delete = $this->db->where('gallery_id',$id);
        $delete = $this->db->delete('tbl_gallery_image');

        $this->session->set_flashdata('success', 'Data Deleted Successfully');
        redirect('admin/gallery');
    }
    
    function image_add($id) {
        if (isset($_POST['submit'])) {
            $array  = array(
                'gallery_id' => $id,
                'title' => $this->input->post('title'),
                'name' => $this->input->post('name'),
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('tbl_gallery_image',$array);
            
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/gallery/image/'.$id);
        }
        
        
        $gallery = $this->db->where('gallery_id',$id);
        $gallery = $this->db->get('tbl_gallery_image')->result();
        $data['gallery'] = $gallery;
        $data['id'] = $id;
        $this->load->view('admin/gallery_main_image_add', $data);
    }

    function add() {
        if (isset($_POST['submit'])) {
            $array  = array(
                'title' => $this->input->post('title'),
                'created_date' => date('Y-m-d H:i:s')
            );
            
            $this->db->insert('tbl_gallery',$array);
            
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/gallery');
        }
        $this->load->view('admin/add_gallery');
    }
    
    function edit($id) {
        if (isset($_POST['submit'])) {
            $array  = array(
                'title' => $this->input->post('title'),
            );
            
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_gallery',$array);
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/gallery');
        }
        
        
        $gallery = $this->db->where('id',$id);
        $gallery = $this->db->get('tbl_gallery')->row();
        $data['gallery'] = $gallery;
        $this->load->view('admin/edit_gallery',$data);
    }
    
    
    
    function upload_photo() {
        $filename = "gallery_soft_" . rand(10000, 99999);
        $config['upload_path'] = BASEPATH . '../images/temp/full/';

        $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['file_name'] = $filename;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {


            $uploaded_image = $this->upload->data();
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
                $file = explode(".", $data['filename']);
                $data['thumb'] = $data['filename'];
            }
        } else {
            $data['status'] = "error";
            $data['error'] = "Image Upload Error:" . $this->upload->display_errors();
        }
        echo json_encode($data);
    }

  
   
}

?>