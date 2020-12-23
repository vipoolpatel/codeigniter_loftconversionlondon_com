<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_Lib {

    function __construct() {
        $this->CI = & get_instance();
    }






    function upload_image($fld_name, $full_image_path, $file_name, $resize_detail) {
        $this->CI->load->library('upload');
        $this->CI->load->library('image_lib');
        $config['allowed_types'] = 'png|gif|jpeg|jpg|pjpeg|bmp';
        $config['upload_path'] = $full_image_path;
        $config['max_size'] = '4024';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $file_name;
        $this->CI->upload->initialize($config);
        if ($this->CI->upload->do_upload($fld_name)) {
            $uploaded_image = $this->CI->upload->data();
            if (is_array($resize_detail)) {
                foreach ($resize_detail as $resize_item) {
                    if (($resize_item["crop"] == "true")) {
                        list($width, $height) = getimagesize($full_image_path . "/" . $uploaded_image['file_name']);
                        list($resize_width, $resize_height) = $this->get_precrop_size($width, $height, $resize_item["width"], $resize_item["height"]);
                    } else {
                        list($width, $height) = getimagesize($full_image_path . "/" . $uploaded_image['file_name']);
                        if ($width > $resize_item["width"] || $height > $resize_item["height"]) {
                            if ($width > $height) {
                                $resize_width = $resize_item["width"];
                                $resize_height = (($resize_item["width"] / $width) * $height);
                            } else {
                                $resize_height = $resize_item["height"];
                                $resize_width = (($resize_item["height"] / $height) * $width);
                            }
                        } else {
                            $resize_width = $width;
                            $resize_height = $height;
                        }
                    }
                    //echo $width. ''. $resize_item["width"];
                    if ($width < $resize_item["width"]) {
                        $resize_item["crop"] = false;
                        $resize_width = $width;
                        $resize_height = $height;
                    }
                    $resize_config['image_library'] = 'gd2';
                    $resize_config['source_image'] = $full_image_path . "/" . $uploaded_image["file_name"];
                    $resize_config['new_image'] = $resize_item["new_path"];
                    $resize_config['maintain_ratio'] = TRUE;
                    $resize_config['width'] = $resize_width;
                    $resize_config['height'] = $resize_height;

                    $this->CI->image_lib->initialize($resize_config);
                    if (!$this->CI->image_lib->resize()) {
                        return array("status" => "error", "error_string" => $this->CI->image_lib->display_errors());
                    }

                    if ($resize_item["crop"] == "true") {
                        list($width, $height) = getimagesize($full_image_path . "/" . $uploaded_image['file_name']);
                        switch ($resize_item["crop_type"]) {
                            case "center":
                                $center_crop_coordinates = $this->get_center_crop_coordinates($resize_width, $resize_height, $resize_item["width"], $resize_item["height"]);
                                $x = $center_crop_coordinates["x"];
                                $y = $center_crop_coordinates["y"];
                                break;
                            case "top_left":
                                $x = 0;
                                $y = 0;
                                break;
                        }
                        //$this->CI->image_lib->clear();

                        $crop_config['image_library'] = 'gd2';
                        $crop_config['source_image'] = $resize_item["new_path"] . "/" . $uploaded_image["file_name"];
                        //$config['new_image'] = $resize_item["new_path"];
                        $crop_config['x_axis'] = $x;
                        $crop_config['y_axis'] = $y;
                        $crop_config['height'] = $resize_item["height"];
                        $crop_config['width'] = $resize_item["width"];
                        $crop_config['maintain_ratio'] = FALSE;
                        $this->CI->image_lib->initialize($crop_config);

                        if (!$this->CI->image_lib->crop()) {
                            return array("status" => "error", "error_string" => $this->CI->image_lib->display_errors());
                        }
                    }
                }
            }
            return array("status" => "success", "filename" => $uploaded_image["file_name"], "original" => $_FILES[$fld_name]['name']);
        } else {
            return array("status" => "error", "error_string" => strip_tags(html_entity_decode($this->CI->upload->display_errors())));
        }
    }

    function get_resize_details($case) {
        switch ($case) {
            case "testimonial":
                return array(
                    0 => array(
                        "width" => "100",
                        "height" => "100",
                        "new_path" => BASEPATH . "../images/temp/thumb",
                        "crop" => "true",
                        "crop_type" => "center",
                    ),
                    1 => array(
                        "width" => "500",
                        "height" => "500",
                        "new_path" => BASEPATH . "../images/temp/main",
                        "crop" => "true",
                        "crop_type" => "center",
                    ),
                    2 => array(
                        "width" => "600",
                        "height" => "600",
                        "new_path" => BASEPATH . "../images/temp/full",
                        "crop" => "false"
                    )
                );
                break;
        }
    }

    function get_precrop_size($width, $height, $resize_width, $resize_height) {
        if ($width < $height) {
            $new_width = $resize_width;
            $new_height = ($new_width / $width) * $height;
            if ($new_height > $height) {
                $new_height = $height;
                $new_width = ($new_height / $height) * $width;
            }
        } else if ($width == $height) {
            if ($resize_width > $resize_height) {
                $new_width = $resize_width;
                $new_height = ($new_width / $width) * $height;
            } else {
                $new_height = $resize_height;
                $new_width = ($new_height / $height) * $width;
            }
        } else {
            $new_height = $resize_height;
            $new_width = ($new_height / $height) * $width;
            if ($new_width < $resize_width) {
                $new_height = ($resize_width / $new_width) * $new_height;
                $new_width = $resize_width;
            }
        }
        return array($new_width, $new_height);
    }

    function get_center_crop_coordinates($width, $height, $rwidth, $rheight) {
        if ($width > $height) {
            $x = ($width / 2) - ($rwidth / 2);
            $y = 0;
        } else {
            $y = ($height / 2) - ($rheight / 2);
            $x = 0;
        }
        return array("x" => $x, "y" => $y);
    }

    
    
    function get_site_meta(){
        $row = "";
        if ($this->CI->uri->segment(1) == 'marketing' && $this->CI->uri->segment(2) != '' && !is_numeric($this->CI->uri->segment(2))) {
            $slug = $this->CI->uri->segment(2);
            $row = $this->get_blog_seo($slug);
        }
        else if ($this->CI->uri->segment(1) == 'category' && $this->CI->uri->segment(2) != '' && !is_numeric($this->CI->uri->segment(2))) {
            $slug = $this->CI->uri->segment(2);
            $row = $this->get_category_seo($slug);
            
        }
        else if ($this->CI->uri->rsegment(2) == 'content') {
            $slug = $this->CI->uri->segment(1);
            $row = $this->get_page_seo($slug);
        }else if($this->CI->uri->segment(1) == ''){
            
            $row = $this->get_all_seo('home');
        }else {
            
            $uri = $this->CI->uri->uri_string();
            $row = $this->get_all_seo($uri);
        }
        if(!$row || ($row && $row->meta_title=='')){
            $row = $this->get_all_seo('generic');
        }
        return $row;
    }
    
    
    function get_category_seo($category_slug) {
       
        $query = $this->CI->db->get_where('tbl_category', array('category_slug' => $category_slug));
        return $query->num_rows() > 0 ? $query->row() : $this->get_generic_seo();
    }

    
    function get_all_seo($uri) {
        $query =  $this->CI->db->get_where('tbl_seo', array('path' => $uri));
        if($query->num_rows() >0){
            $row = $query->row();
            $row->meta_keywords = $row->meta_key;
            return $row;
        }else{
            return false;
        }
    }

    function get_page_title() {
        $this->CI->load->database();
        //$title = $this->CI->config->item('site_title');
        $title = "";
        $generic = $this->CI->db->where('path','generic')->get('tbl_seo')->row();
        $page = $this->CI->uri->segment(1);
        if ($page == 'content') {
            $page = $this->CI->uri->segment(2);
        }
        else if ($this->CI->uri->segment(1) == 'faqs') {
            $title = "FAQs ";
        } else {
            $sql = "  SELECT meta_title
                    FROM `tbl_contents`
                    WHERE page_seo = '$page'";

            $result = $this->CI->db->query($sql);
            if ($result->num_rows() > 0) {
                $row = $result->row_array();
                $page_title = $row['meta_title'];
                if ($page_title != "")
                    $title = "$page_title ";
                else
                    $title = $generic->meta_title;
            }
            else {
                $title = $generic->meta_title;
            }
        }

        return $title;
    }

    function get_page($rank) {
        if ($rank == 0) {
            return '0';
        } else if ($rank / 10 <= 1) {
            return 'page1';
        } else if (($rank / 10) <= 2) {
            return 'page2';
        } else if (($rank / 10) <= 3) {
            return 'page3';
        } else {
            return 'top30';
        }
    }

    function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    function content_limiter($text, $length = 64, $tail = "") {
        $text = trim($text);
        $txtl = strlen($text);
        if ($txtl > $length) {
            for ($i = 1; $text[$length - $i] != " "; $i++) {
                if ($i == $length) {
                    return substr($text, 0, $length) . $tail;
                }
            }
            $text = substr($text, 0, $length - $i + 1) . $tail;
        }
        return $text;
    }

    function get_5_recent_posts() {
        $this->CI->db->limit(5);
        $this->CI->db->order_by('id', 'desc');
        $query = $this->CI->db->get('tbl_blog');
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    function get_latest_from_blog(){
        $this->CI->db->limit(2);
        // $this->CI->db->order_by('id', 'desc');
        $this->CI->db->order_by('rand()');
        $query = $this->CI->db->get('tbl_blog');
        return $query->num_rows() > 0 ? $query->result() : false;
    }



    function get_total_comment_by_id($id) {
        $query = $this->CI->db->get_where('tbl_blog_comment', array('blog_id' => $id));
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    function get_total_comment_num_by_id($id) {
        $query = $this->CI->db->get_where('tbl_blog_comment', array('blog_id' => $id));
        return $query->num_rows() > 0 ? $query->num_rows() : 0;
    }

    function is_approved($user_id) {
        $query = $this->CI->db->get_where('tbl_users', array('id' => $user_id));
        if ($query->num_rows > 0) {
            $result = $query->row();
            return $result->domain_approved;
        } else {
            return false;
        }
    }

    function get_meta_package($slug = '') {
        if ($this->CI->uri->segment(1) == 'marketing' && $this->CI->uri->segment(2) != '') {
            return $this->get_blog_seo($slug);
        } elseif($this->CI->uri->segment(1) == ''){
            return $this->get_page_seo('home');
        }elseif ($this->CI->uri->rsegment(2) == 'content') {
            return $this->get_page_seo($slug);
        } else {
            return $this->get_generic_seo();
        }
    }

    function get_generic_seo() {
        $query = $this->CI->db->get('tbl_generic_seo');
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    function get_page_seo($page_slug) {
        $query = $this->CI->db->get_where('tbl_contents', array('page_seo' => $page_slug));
        return $query->num_rows() > 0 ? $query->row() : $this->get_generic_seo();
    }

    function get_blog_seo($blog_slug) {
        $query = $this->CI->db->get_where('tbl_blog', array('page_seo' => $blog_slug));
        return $query->num_rows() > 0 ? $query->row() : $this->get_generic_seo();
        print_r($query->row());
    }

    function check_if_invoice_is_paid_by_id($id) {
        $query = $this->CI->db->get_where('tbl_invoice', array('paid_status' => 1, 'id' => $id));
        return $query->num_rows() > 0 ? true : false;
    }

    function generate_captcha_word(){
        $pool = '23456789abcdefghklmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';

        $str = '';
        for ($i = 0; $i < 8; $i++)
        {
            $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
        }

        return $str;
    }

}

?>