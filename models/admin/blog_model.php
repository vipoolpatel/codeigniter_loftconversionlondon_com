<?php

class Blog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_blog() {
        return $this->db->order_by('date','DESC')->order_by('id','DESC')->get('tbl_blog');
    }

    public function get_total_blogs($tag = "") {
        if($tag){
            $this->db->join('tbl_blog_tags','tbl_blog.id = tbl_blog_tags.blog_id');
            $this->db->where('tbl_blog_tags.tag_id',$tag);
        }
        // $this->db->where(array('is_active' => 1));
        $query = $this->db->get('tbl_blog');
        return $query->num_rows();
    }

    public function fetch_blog($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where("tbl_blog"/*, array('is_active' => 1)*/);

        if ($query->num_rows() > 0) {
            /* foreach ($query->result() as $row) {
              $data[] = $row;
              } */
            return $query->result();
        }
        return false;
    }


    function add_blog() {
        $arr['title'] = $_POST['title'];
        $arr['description'] = $_POST['description'];
        $arr['image'] = $_POST['picture']?$_POST['picture']:$this->generateImage($arr['title']);
        $arr['date'] = date('Y-m-d');
        $arr['page_seo'] = $this->common_lib->slugify($_POST['title']);
        $arr['meta_desc'] = $_POST['meta_desc'];
        $arr['meta_keywords'] = $_POST['meta_tags'];
        $arr['meta_title'] = $_POST['meta_title'];
        if (isset($_POST['is_active']))
            $active = 1;
        else
            $active = 0;
        $arr['is_active'] = $active;
        $this->db->insert('tbl_blog', $arr);
    }

    function edit_blog($id) {
        $arr['title'] = $_POST['title'];
        $arr['description'] = $_POST['description'];
        $arr['image'] = $_POST['picture']?$_POST['picture']:$this->generateImage($arr['title']);
        $arr['date'] = date('Y-m-d');
        $arr['page_seo'] = $this->common_lib->slugify($_POST['title']);
        $arr['meta_desc'] = $_POST['meta_desc'];
        $arr['meta_keywords'] = $_POST['meta_tags'];
        $arr['meta_title'] = $_POST['meta_title'];
        if (isset($_POST['is_active']))
            $active = 1;
        else
            $active = 0;
        $arr['is_active'] = $active;
        $this->db->where('id', $id);
        $this->db->update('tbl_blog', $arr);
    }

    function generateImage($title){
        $file_name = 'filename_' . time() . '.jpeg';

        header('content-type: image/jpeg');
        //Store the values of our date in separate variables 
        //Load our base image 
        $image = imagecreatefrompng(BASEPATH . '../images/blogMainImage.png');
        $image_big = imagecreatefrompng(BASEPATH . '../images/blogMainImageBig.png');
        //$image_width = imagesx($image);
        //Setup colors and font file 
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 61, 59, 54);

        $white_big = imagecolorallocate($image_big, 255, 255, 255);
        $black_big = imagecolorallocate($image_big, 61, 59, 54);


        $font_path = BASEPATH . '../fonts/Franchise-Bold-hinted.ttf';

        //Get the positions of the text string
        $text = wordwrap($title, 25, "\n");
        $text_big = wordwrap($title, 25, "\n");


        //Create Month
        imagettftext($image, 24, 0, 20, 40, $black, $font_path, $text);
        imagettftext($image_big, 44, 0, 40, 80, $black_big, $font_path, $text_big);
        //Create final image 
        imagejpeg($image, BASEPATH . '../images/blog/small/' . $file_name, 100);
        imagejpeg($image_big, BASEPATH . '../images/blog/medium/' . $file_name, 100);
        //Clear up memory;
        imagedestroy($image);
        imagedestroy($image_big);
        /** ********************** */
        return $file_name;
    }

    function get_blog_by_id($id) {
        return $this->db->get_where('tbl_blog', array('id' => $id));
        return true;
    }

    function delete_blog($id) {
        $this->db->delete('tbl_blog', array('id' => $id));
    }

    function delete_comment($id) {
        $this->db->delete('tbl_blog_comment', array('id' => $id));
    }

    function get_comment_per_blog_id($id) {
        return $this->db->get_where('tbl_blog_comment', array('blog_id' => $id));
    }

    function change_status() {
        $this->db->where('id', $_POST['id']);
        $is = $_POST['is_active'];
        if ($is == "1")
            $arr['is_active'] = 0;
        else
            $arr['is_active'] = 1;
        $this->db->update('tbl_blog_comment', $arr);
        return $arr['is_active'];
    }

    public function add_comment($blod_id) {
        $today = date('Y-m-d');
        $form_data = $this->input->post();
        $insert_arr = array(
            'blog_id' => $blod_id,
            'comment' => $form_data['comment'],
            'date' => $today,
            'is_active' => 0
        );
        if ($this->session->userdata('client_id')) {
            $user_info = get_user_details_by_id($this->session->userdata('client_id'));
            $insert_arr['author'] = $user_info->fname . ' ' . $user_info->lname;
            $insert_arr['email'] = $user_info->email;
        } else {
            $insert_arr['author'] = $form_data['name'];
            $insert_arr['email'] = $form_data['email'];
        }
        $this->db->insert('tbl_blog_comment', $insert_arr);
        return true;
    }

    public function get_active_comments_by_blog_id($blog_id) {
        $query = $this->db->get_where('tbl_blog_comment', array('blog_id' => $blog_id, 'is_active' => 1));
        return $query->num_rows() > 0 ? $query->result() : false;
    }
    
    public function get_blog_id_by_slug($slug){
        $query = $this->db->get_where('tbl_blog', array('page_seo' => $slug));
        return $query->row()->id;
        
    }
    public function get_blog_id_by_category($category) {
        $query = $this->db->get_where('tbl_blog', array('category_id' => $category, 'is_active' => 1));
        return $query->num_rows > 0 ? $query->result() : false;
    }
    

}