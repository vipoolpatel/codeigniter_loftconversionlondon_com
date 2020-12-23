<?php

class Loft_conversions_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_services($active = false) {
    	if($active == true){
    		$this->db->where('is_active',1);
    	}
        return $this->db->get('tbl_services_loft_conversions_type');
    }

    function add_service() {
        $arr['title'] = $_POST['title'];
        $arr['description'] = $_POST['description'];
        $arr['image'] = $_POST['picture'];
        $arr['created_at'] = date('Y-m-d');
        
        if (isset($_POST['is_active']))
            $arr['is_active'] = 1;
        else
            $arr['is_active'] = 0;
        return $this->db->insert('tbl_services_loft_conversions_type', $arr);
    }

    function edit_service($id) {
        $arr['title'] = $_POST['title'];
        $arr['description'] = $_POST['description'];
        $arr['image'] = $_POST['picture'];
        $arr['created_at'] = date('Y-m-d');
        
        if (isset($_POST['is_active']))
            $arr['is_active'] = 1;
        else
            $arr['is_active'] = 0;

        $this->db->where('id', $id);
        return $this->db->update('tbl_services_loft_conversions_type', $arr);
    }

    function get_service_by_id($id) {
        return $this->db->get_where('tbl_services_loft_conversions_type', array('id' => $id));
    }

    function delete_service($id) {
        return $this->db->delete('tbl_services_loft_conversions_type', array('id' => $id));
    }

}