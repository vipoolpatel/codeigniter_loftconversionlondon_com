<?php

class Section_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_home_section() {
    	$this->db->where('id',1);
        $query = $this->db->get('tbl_page_sections');
        if($query->num_rows()>0){
        	return $query->row();
        }else{
        	return false;
        }
    }

	
	function SEOCaseStudy() {
    	$arr = array();
        $arr['case_study_title'] = $this->input->post('case_study_title');
        $arr['case_study_button_name'] = $this->input->post('case_study_button_name');
        $arr['case_study_description'] = $this->input->post('case_study_description');
		
		if(!empty($_FILES["case_study_image"]["name"]))
		{
			$uploaddir = 'images/study/';
			$uploadfilecar = date('ymd').time().time().$arraycar.$_FILES['case_study_image']['name'];
			copy($_FILES['case_study_image']['tmp_name'], $uploaddir.$uploadfilecar);
			$arr['case_study_image'] = $uploadfilecar;
		}
		else
		{
			$arr['case_study_image'] = $this->input->post('old_case_study_image');;
		}
        
    	if($this->db->get_where('tbl_page_sections', array('id' => 1))->num_rows()>0){
    		$this->db->where('id', 1);
        	return $this->db->update('tbl_page_sections', $arr);
    	}else{

        	return $this->db->insert('tbl_page_sections', $arr);
    	}

    }

   

}