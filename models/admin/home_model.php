<?php

class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_home_section() {
    	$this->db->where('id',1);
        return $this->db->get('tbl_home_section');
    }

    function edit_home_section($data) {
    	$arr = array();
    	if(isset($data['points']) && $data['points']){
    		$arr['bottom_description'] = implode('#!#',$data['points']);
    	}else{
    		$arr['bottom_description'] = "";
    	}
        $arr['main_title'] = $data['main_title'];
        $arr['main_sub_title'] = $data['main_sub_title'];
        $arr['main_caption'] = $data['main_caption'];
		
		$arr['middle_title'] = $data['middle_title'];
        $arr['middle_sub_title'] = $data['middle_sub_title'];
			$arr['middle_caption'] = $data['middle_caption'];
		
		$arr['bottom_title'] = $data['bottom_title'];
        $arr['bottom_button_caption'] = $data['bottom_button_caption'];
    	if($this->db->get_where('tbl_home_section', array('id' => 1))->num_rows()>0){
    		$this->db->where('id', 1);
        	return $this->db->update('tbl_home_section', $arr);
    	}else{

        	return $this->db->insert('tbl_home_section', $arr);
    	}

    }

}