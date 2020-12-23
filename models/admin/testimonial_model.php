<?php

class Testimonial_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('user_lib');
        $this->load->library('common_lib');
        $this->load->database();
    }

    function get_testimonials() {
        $query = $this->db->order_by('display_order', 'asc')->get('tbl_testimonials');
        $result = $query->result_array();
        return $result;
    }

    function sort_testimonials($items) {
        if (is_array($items)) {
            foreach ($items as $position => $item) {
                $position++;
                $sql = "UPDATE `tbl_testimonials` SET `display_order` = $position WHERE `id` = $item";
                $this->db->query($sql);
            }
            echo '<div id="successmsg" class="messagesuccess">SUCCESSFULLY SAVED.</div>';
            //echo '<script>$(document).ready(function(){ $("#successmsg").fadeOut(2000); });</script>';
        }
    }

    function add_testimonial() {
        $data = array(
            'name' => $this->input->post('name'),
            'company' => $this->input->post('company'),
            'position' => $this->input->post('position'),
            'description' => $this->input->post('description'),
            'image' => $this->input->post('photo'),
            'display_order' => $this->get_max_display_order(),
        );

        $this->db->insert('tbl_testimonials', $data);
        return $this->db->insert_id();
    }

    function update_testimonial($postArray, $id) {
        $insertArray = array('name' => $postArray['name'],
            'company' => $postArray['company'],
            'position' => $postArray['position'],
            'description' => $postArray['description']);

        if ($postArray['photo'] != "") {
            $insertArray['image'] = $this->input->post('photo');
        }
        $this->db->where('id', $id);
        $this->db->update('tbl_testimonials', $insertArray);
        return $this->db->insert_id();
    }

    function get_max_display_order() {
        $sql = "SELECT max(display_order) as max_order FROM tbl_testimonials ";
        $result = $this->db->query($sql);
        $row = $result->row_array($result);
        return $row['max_order'] + 1;
    }

    function get_testimonial_details($id) {
        $query = $this->db->where('id', $id)->get('tbl_testimonials');
        return $query->row_array();
    }

    function delete_testimonial($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tbl_testimonials');
    }

}