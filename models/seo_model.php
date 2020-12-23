<?php

class Seo_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_seos() {
        $result = $this->db->where('id <>',1)->get('tbl_seo');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function get_AI(){
        $table = $this->db->query("SHOW TABLE STATUS LIKE 'tbl_seo'");
        $row = $table->row();
        return $row->Auto_increment;
    }

    function add_seo() {
        if($this->get_AI()==1){
            $this->load->dbforge();
            $this->db->query("ALTER TABLE tbl_seo AUTO_INCREMENT = 2");
        }
        $arr['page'] = $_POST['page'];
        $arr['meta_title'] = $_POST['meta_title'];
        $arr['meta_desc'] = $_POST['meta_desc'];
        $arr['meta_key'] = $_POST['meta_key'];
        $arr['path'] = $_POST['path'];
        return $this->db->insert('tbl_seo', $arr);
    }

    function edit_seo($id) {
        $arr['page'] = $_POST['page'];
        $arr['meta_title'] = $_POST['meta_title'];
        $arr['meta_desc'] = $_POST['meta_desc'];
        $arr['meta_key'] = $_POST['meta_key'];
        $arr['path'] = $_POST['path'];

        $this->db->where('id', $id);
        return $this->db->update('tbl_seo', $arr);
    }

    function get_seo_by_id($id) {
        return $this->db->get_where('tbl_seo', array('id' => $id));
    }

    function get_seo_by_path($path) {
        $query =  $this->db->get_where('tbl_seo', array('path' => $path));
        if($query->num_rows() >0){
            return $query->row();
        }else{
            return false;
        }
    }

    function delete_seo($id) {
        return $this->db->delete('tbl_seo', array('id' => $id));
    }

    function get_generic_seo() {
        $query =  $this->db->get_where('tbl_seo', array('id' => 1));
        if($query->num_rows() >0){
            return $query->row_array();
        }else{
            if($this->db->insert('tbl_seo', array('id'=>1,'page'=>'Generic','path'=>'generic'))){
                return $this->get_generic_seo();
            }
        }    
    }

    function update_generic_seo() {
        $values = $this->input->post();

        $update_data = array(
            'meta_title' => $values['meta_title'],
            'meta_desc' => $values['meta_desc'],
            'meta_key' => $values['meta_tags'],
            'page'=>'Generic',
            'path'=>'generic'
        );

        $this->db->where('id', '1');
        $this->db->update('tbl_seo', $update_data);
    }


}

?>