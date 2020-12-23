<?php

class User_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_user_details($id) {
        $result = $this->db->get('tbl_users');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function get_user_detail_by_id($id) {
        $result = $this->db->where('id', $id)->get('tbl_users');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    function get_keywords_by_user_id($user_id) {
        $result = $this->db->where('user_id', $user_id)->get('tbl_keywords');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function save_settings($user_id, $values) {

        $update = array(
            'first_name' => $values['fname'],
            'last_name' => $values['lname'],
            'email' => $values['email'],
            'phone' => $values['phone'],
            'address' => $values['address'],
            'city' => $values['city'],
            'zipcode' => $values['zipcode'],
            'state' => $values['state'],
            'country' => $values['country'],
        );

        if ($values['changePassword'] == "1") {
            $update['password_real'] = $values['password'];
            $update['password'] = sha1($values['password']);
        }

        $this->db->where('id', $user_id);
        if ($this->db->update('tbl_users', $update))
            return TRUE;
        else
            return FALSE;
    }

    function save_payment_settings($user_id, $values) {
        $update = array(
            'card_no' => $values['card_no'],
            'cvv' => $values['cvv'],
            'expiry_date' => $values['expiry_date'],
        );


        $this->db->where('id', $user_id);
        if ($this->db->update('tbl_users', $update))
            return TRUE;
        else
            return FALSE;
    }

    public function get_reports_by_user_id($user_id) {
        $result = $this->db->where('user_id', $user_id)->get('tbl_reports');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

}

?>