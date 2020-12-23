<?php

class Results_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	

    function get_result($limit = NULL) {
        $this->db->order_by('id', 'desc');
        if($limit){
            $this->db->limit($limit);
        }
        $result = $this->db->get('tbl_seo_results');
        if($result->num_rows()>0){
        	return $result->result();
        }else{
        	return false;
        }
    }


	
	
    function add_result() {
        $arr['title'] = $_POST['title'];
        $arr['domain'] = $_POST['domain'];
        $arr['keyword'] = $_POST['keyword'];
        $arr['competition'] = $_POST['competition'];
        $arr['search_engine'] = $_POST['search_engine'];
        $arr['time_scale'] = $_POST['time_scale'];
        $arr['detail'] = $_POST['detail'];
		$arr['button_name'] = $_POST['button_name'];
		
        $this->db->insert('tbl_seo_results', $arr);
    }


    function edit_result($id) {
        $arr['title'] = $_POST['title'];
        $arr['domain'] = $_POST['domain'];
        $arr['keyword'] = $_POST['keyword'];
        $arr['competition'] = $_POST['competition'];
        $arr['search_engine'] = $_POST['search_engine'];
        $arr['time_scale'] = $_POST['time_scale'];
        $arr['detail'] = $_POST['detail'];
        $arr['button_name'] = $_POST['button_name'];


        $this->db->where('id', $id);
        $this->db->update('tbl_seo_results', $arr);
    }
	
	
    
    function delete_result($id) {
        $this->db->delete('tbl_seo_results', array('id' => $id));
    }
	
	
	

    function get_result_by_id($id) {
        $result =  $this->db->get_where('tbl_seo_results', array('id' => $id));
        if($result->num_rows()>0){
        	return $result->row();
        }else{
        	return false;
        }
    }
	
    function get_question_by_id($id) {
        $result =  $this->db->get_where('tbl_seo_question', array('id' => $id));
        if($result->num_rows()>0){
        	return $result->row();
        }else{
        	return false;
        }
    }

}