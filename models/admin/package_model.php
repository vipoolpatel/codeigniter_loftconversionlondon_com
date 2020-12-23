<?php

class Package_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_package() {
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('tbl_package');
        if($result->num_rows()>0){
        	return $result->result();
        }else{
        	return false;
        }
    }
    
    function get_seo_package() {
        $result = $this->db->get('tbl_seo_package');
        return $result->result();
    }

    public function get_total_packages() {
        $query = $this->db->get('tbl_package');
        return $query->num_rows();
    }

    public function fetch_package($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where("tbl_blog", array('is_active' => 1));

        if ($query->num_rows() > 0) {
            /* foreach ($query->result() as $row) {
              $data[] = $row;
              } */
            return $query->result();
        }
        return false;
    }

    function add_package() {
        
        
        if(!empty($_FILES["image"]["name"]))
        {
            $uploadfile=$_FILES["image"]["tmp_name"];
            $folder="images/package/";
            $image = $_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"],$folder.$image);
            $arr['image'] = $image;
        }
        
        
        $arr['name'] = $_POST['name'];
        $arr['description'] = $_POST['description'];
        $arr['price_text'] = $_POST['price_text'];
        $arr['short_description'] = $_POST['short_description'];
        $arr['extra_description'] = $_POST['extra_description'];
//        $arr['rate'] = $_POST['rate'];

        $this->db->insert('tbl_package', $arr);
    }


    function edit_package($id) {
          
        if(!empty($_FILES["image"]["name"]))
        {
            $uploadfile=$_FILES["image"]["tmp_name"];
            $folder="images/package/";
            $image = $_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"],$folder.$image);
            $arr['image'] = $image;
        }
        
        $arr['name'] = $_POST['name'];
        $arr['description'] = $_POST['description'];
        $arr['price_text'] = $_POST['price_text'];
        $arr['short_description'] = $_POST['short_description'];
        $arr['extra_description'] = $_POST['extra_description'];
//        $arr['rate'] = $_POST['rate'];

        $this->db->where('id', $id);
        $this->db->update('tbl_package', $arr);
    }

    function delete_package($id) {
        $this->db->delete('tbl_package', array('id' => $id));
    }

    function get_package_by_id($id) {
        $package =  $this->db->get_where('tbl_package', array('id' => $id));
        if($package->num_rows()>0){
        	return $package->row();
        }else{
        	return false;
        }
    }

}