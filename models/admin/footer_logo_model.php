<?php

class Footer_logo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_footer_logo() {
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('tbl_footer_logo');
        if($result->num_rows()>0){
        	return $result->result();
        }else{
        	return false;
        }
    }
  

    function add_footer_logo() {
        
        
        if(!empty($_FILES["logo"]["name"]))
        {
            $uploadfile=$_FILES["logo"]["tmp_name"];
            $folder="images/";
            $logo = $_FILES["logo"]["name"];
            move_uploaded_file($_FILES["logo"]["tmp_name"],$folder.$logo);
            $arr['logo'] = $logo;
        }
        
        $arr['name'] = $_POST['name'];
        $arr['url'] = $_POST['url'];
        $arr['created_at'] = date('Y-m-d H:i:s');
     
        $this->db->insert('tbl_footer_logo', $arr);
    }


    function edit_footer_logo($id) {
          
        if(!empty($_FILES["logo"]["name"]))
        {
            $uploadfile=$_FILES["logo"]["tmp_name"];
            $folder="images/";
            $logo = $_FILES["logo"]["name"];
            move_uploaded_file($_FILES["logo"]["tmp_name"],$folder.$logo);
            $arr['logo'] = $logo;
        }
        
        $arr['name'] = $_POST['name'];
        $arr['url'] = $_POST['url'];
        $arr['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->where('id', $id);
        $this->db->update('tbl_footer_logo', $arr);
    }

    function delete_footer_logo($id) {
        $this->db->delete('tbl_footer_logo', array('id' => $id));
    }

    function get_footer_logo_by_id($id) {
        $package =  $this->db->get_where('tbl_footer_logo', array('id' => $id));
        if($package->num_rows()>0){
        	return $package->row();
        }else{
        	return false;
        }
    }

}