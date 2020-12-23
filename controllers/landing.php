<?php

class Landing extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['hello'] = "test";
        $data['template'] = "home_view";
        $this->load->view('main_template_view', $data);
    }

    public function keywords() {
        $website_name = $this->input->post() ? $this->input->post('web_url') : false;
        if ($website_name == false)
            redirect();
        $data['template'] = "keyword_view";
        $this->load->view('main_template_view', $data);
    }

    public function blog($slug = '') {
        $this->load->model('admin/blog_model');
        if ($slug != '') {
            $blog_id = $this->blog_model->get_blog_id_by_slug($slug);
            if ($this->input->post()) {
                $this->blog_model->add_comment($blog_id);
                $data['msg'] = "Your comment is awaiting for moderation and will be published soon.";
            }
            $blog = $this->blog_model->get_blog_by_id($blog_id);
            $data['comments'] = $this->blog_model->get_active_comments_by_blog_id($blog_id);
            $data['blog'] = $blog->num_rows() > 0 ? $blog->row() : false;
            $this->load->view('single_blog_view', $data);
            return;
        } else {
            /*$blogs = $this->blog_model->get_blog();
            $data['blogs'] = $blogs->num_rows() > 0 ? $blogs->result() : false;*/
            $this->load->library('pagination');
            $config = array();
            $config["base_url"] = base_url() . "marketing";
            $config["total_rows"] = $this->blog_model->get_total_blogs();
            $config["per_page"] = 10;
            $config["uri_segment"] = 2;
            $config['first_link'] = ' &laquo;';
            $config['last_link'] = ' &raquo;';

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $data['blogs'] = $this->blog_model->fetch_blog($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();

            $this->load->view('blog_view', $data);
        }
    }
    
    
      
    public function category($slug = '')
    {   $this->load->model('admin/blog_model');
       $this->db->where('category_slug',$slug);
       $getno = $this->db->get('tbl_category');
       if($getno->num_rows() > 0)        
       {
           $category_id =   $getno->row()->category_id;
           $data['category_name'] =   $getno->row()->category_name;
           $data['blogs'] = $this->blog_model->get_blog_id_by_category($category_id);
           $this->load->view('category_view', $data);
       }
       else
       {
            show_404();
       }
    }
    

    public function ipn_update($id) {
        $this->load->model('main_model');
        $this->main_model->update_ipn($id);
    }

    public function paypal_success() {
        $this->session->set_flashdata('pp_msg', 'Payment successfull.');
        redirect('user/dashboard');
    }

    public function cancel_paypal() {
        $this->session->set_flashdata('pp_msg', 'Payment cancelled.');
        redirect('user/dashboard');
    }

}

?>
