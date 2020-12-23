<?php

class Features_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_features($active = false, $limit = NULL, $type=NULL) {
    	if($active == true){
    		$this->db->where('is_active',1);
    	}
        if($limit){
            $this->db->limit($limit);
        }
        if($type!==NULL){
            $this->db->where('type',$type);
        }
        $query = $this->db->get('tbl_features');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    function add_feature() {
        $arr['title'] = $_POST['title'];
        $arr['description'] = $_POST['description'];
        $arr['image'] = $_POST['picture'];
        $arr['type'] = $_POST['type'];
        $arr['created_at'] = date('Y-m-d');
        
        if (isset($_POST['is_active']))
            $arr['is_active'] = 1;
        else
            $arr['is_active'] = 0;
        return $this->db->insert('tbl_features', $arr);
    }

    function edit_feature($id) {
        $arr['title'] = $_POST['title'];
        $arr['description'] = $_POST['description'];
        $arr['image'] = $_POST['picture'];
        $arr['type'] = $_POST['type'];
        $arr['created_at'] = date('Y-m-d');
        
        if (isset($_POST['is_active']))
            $arr['is_active'] = 1;
        else
            $arr['is_active'] = 0;

        $this->db->where('id', $id);
        return $this->db->update('tbl_features', $arr);
    }

    function get_feature_by_id($id,$type=NULL) {
        if($type!==NULL){
            $this->db->where('type',$type);
        }
        return $this->db->get_where('tbl_features', array('id' => $id));
    }

    function delete_feature($id) {
        return $this->db->delete('tbl_features', array('id' => $id));
    }

}