<?php

class Blog extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/blog_model', 'blog');
    }

    function index() {
        $data['blog'] = $this->blog->get_blog();
        $data['category'] = $this->db->get('tbl_category')->result();
        // echo $this->db->last_query();exit;
        $this->load->view('admin/blog', $data);
    }

    function add_blog() {
        if (isset($_POST['submit'])) {
            $this->blog->add_blog();
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/blog');
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
        $data['tot'] = 0;
        $this->load->view('admin/add_blog', $data);
    }

    function edit_blog($id) {
        if (isset($_POST['submit'])) {
            $this->blog->edit_blog($id);
            $this->session->set_flashdata('success', 'Data Saved Successfully');
            redirect('admin/blog');
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
        $data['blog'] = $this->blog->get_blog_by_id($id);
        $data['tot'] = $data['blog']->num_rows();
        $this->load->view('admin/add_blog', $data);
    }
    
    
    function changeCategory()
    {
        $value = $this->input->post('value');
        $id = $this->input->post('id');
        $this->db->set('category_id',$value);
        $this->db->where('id',$id);
        $this->db->update('tbl_blog');
        $json['success'] = true;
        echo json_encode($json);
    }

    function delete_blog($id) {
        $this->blog->delete_blog($id);
        $this->session->set_flashdata('success', 'Data Deleted Successfully');
        redirect('admin/blog');
    }
    
    function delete_comment($id) {
        $this->blog->delete_comment($id);
        $this->session->set_flashdata('success', 'Data Deleted Successfully');
        redirect('admin/blog');
    }
    
    function upload_photo() {
        $filename = "blog_" . rand(10000, 99999);
        $config['upload_path'] = BASEPATH . '../images/blog/full/';

        $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['file_name'] = $filename;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {


            $uploaded_image = $this->upload->data();
            //move_uploaded_file($_FILES["picture"]["tmp_name"],"upload/" . $_FILES["picture"]["name"]);
            $config['image_library'] = 'gd2';
            $config['source_image'] = BASEPATH . '../images/blog/full/' . $uploaded_image['file_name']; //$_FILES['picture']['name'];
            $config['new_image'] = BASEPATH . '../images/blog/medium/' . $uploaded_image['file_name']; //$_FILES["picture"]["name"];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;

            $config['width'] = 635;
            $config['height'] = 408;


            $this->load->library('image_lib', $config);
            // BASEPATH.'../assets/temp/'.$uploaded_image['file_name'];
            $this->image_lib->resize();
            //$this->image_lib->clear();
            $config['image_library'] = 'gd2';
            $config['source_image'] = BASEPATH . '../images/blog/full/' . $uploaded_image['file_name']; //$_FILES['picture']['name'];
            $config['new_image'] = BASEPATH . '../images/blog/small/' . $uploaded_image['file_name']; //$_FILES["picture"]["name"];
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;

            $config['width'] = 357;
            $config['height'] = 223;


            $this->image_lib->initialize($config);
            if ($this->image_lib->resize()) {
                $data['status'] = "success";
                $data['filename'] = $uploaded_image['file_name'];
                $data['path'] = site_url('images/blog/small/');
                //$data['original']=$field['tmp_name'];
                $file = explode(".", $data['filename']);
                //$data['thumb'] = $file[0] . "_thumb." . $file[1];
                $data['thumb'] = $data['filename'];
            }
        } else {
            $data['status'] = "error";
            $data['error'] = "Image Upload Error:" . $this->upload->display_errors();
        }
        echo json_encode($data);
    }

    function blog_comment($id) {
        $data['comment'] = $this->blog->get_comment_per_blog_id($id);
        $this->load->view('admin/blog_comments', $data);
    }

    function change_status() {
        $a = $this->blog->change_status();
        echo $a;
    }

    function delete_photo(){
        if($this->input->post('image')){
            $img = $this->input->post('image');
            if($img){
                if(file_exists(BASEPATH . '../images/blog/full/' . $img)){
                    @unlink(BASEPATH . '../images/blog/full/' . $img);
                }
                if(file_exists(BASEPATH . '../images/blog/medium/' . $img)){
                    @unlink(BASEPATH . '../images/blog/medium/' . $img);
                }
                if(file_exists(BASEPATH . '../images/blog/small/' . $img)){
                    @unlink(BASEPATH . '../images/blog/small/' . $img);
                }
            }
            echo 1;
        }
    }

}