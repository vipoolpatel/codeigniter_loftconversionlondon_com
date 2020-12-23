<?php

class Main_model extends CI_Model {

    /**
     * Main_model::__construct()
     * 
     * @return
     */
    function __construct() {
        $this->load->library('user_lib');
        $this->load->library('session');
    }

    function check_login($user, $pass) {
        $pass = sha1($pass);
        $where = array("username" => $user,
            "password" => $pass,
        );
        $this->db->select('*');
        $this->db->from("tbl_admin");
        $this->db->where($where);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row_array();

            $sess['admin_id'] = $row['id'];
            $sess['admin_username'] = $row['username'];
            $sess['admin_email'] = $row['email'];
            $this->user_lib->set_logged_in_session($sess);
            return $row;
        } else {
            return false;
        }
    }
	
	
	public function get_page_section(){
        $this->db->where('id',1);
        $query = $this->db->get('tbl_page_sections');
        if($query->num_rows()>0){
            $row = $query->row();
            return $row;
        }else{
            return false;
        }
    }
	
	
	

    function log_off() {
        $this->session->sess_destroy();
    }

    function get_news() {
        $query = $this->db->order_by('display_order', 'desc')->get('tbl_news_ticker');
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    function get_featured_news_article($limit) {
        $query = $this->db->order_by('article_id', 'desc')->get('tbl_news_article', $limit);
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    function get_config_values_by_name($name) {
        $query = $this->db->where('config_name', $name)->get('tbl_config');
        $result = $query->row_array();
        if ($query->num_rows() > 0)
            return $result['config_value'];
        else
            return false;
    }

    function update_config_values_by_name($name, $updateArray) {
        $this->db->where('config_name', $name)->update('tbl_config', $updateArray);
    }

    function check_front_login($user, $pass) {
        //$result=$this->check_school_user($user, $pass);
        $pass = sha1($pass);
        $where = array("username" => $user,
            "password " => $pass,
        );
        $this->db->select('*');
        $this->db->from("tbl_users");
        $this->db->where($where);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $sess['user_id'] = $result['id'];
            $sess['user_name'] = $result['username'];
            $sess['user_email'] = $result['email'];
            $this->user_lib->set_logged_in_session($sess);
            return $result;
        } else {
            return false;
        }
    }

    function get_all_countries() {
        $result = $this->db->get('tbl_countries');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function check_user($username) {

        if ($this->db->get_where('tbl_users', array('username' => $username))->num_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function register_user($details, $domain, $keywords) {
        $data = array(
            'first_name' => $details['fname'],
            'last_name' => $details['lname'],
            'username' => $details['username'],
            'password' => sha1($details['password']),
            'password_real' => $details['password'],
            'address' => $details['address'],
            'city' => $details['city'],
            'zipcode' => $details['zip'],
            'country' => $details['country'],
            'state' => $details['state'],
            'phone' => $details['phone'],
            'email' => $details['email'],
            'domain' => $domain,
            'paypal_id' => $details['paypal_id']
        );
        if ($this->db->insert('tbl_users', $data)) {

            $id = $this->db->insert_id();
            if ($keywords) {
                foreach ($keywords as $key) {
                    $keyword_detail = array(
                        'user_id' => $id,
                        'keyword' => $key,
                        'no_of_words' => count(explode(' ', $key))
                    );
                    $this->db->insert('tbl_keywords', $keyword_detail);
                }
            }
            $from_email = $this->config->item('site_email');
            $from = $this->config->item('site_title');
            $email = "";
            $admin_email = $this->db->get('tbl_admin_email')->row();
            if ($admin_email->email1 != "")
                $email.="," . $admin_email->email1;

            if ($admin_email->email2 != "")
                $email.="," . $admin_email->email2;

            if ($admin_email->email3 != "")
                $email.="," . $admin_email->email3;
            if ($admin_email->email4 != "")
                $email.="," . $admin_email->email4;
            if ($admin_email->email5 != "")
                $email.="," . $admin_email->email5;



            $user_details = "<br/><br/>
					<table>
					<tr><td><strong>Name</strong></td><td>: " . ucwords($details['fname'] . " " . $details['lname']) . "</td></tr>
                    <tr><td><strong>Email</strong></td><td>: " . ucwords($details['email']) . "</td></tr>
                    <tr><td><strong>Username</strong></td><td>: " . ucwords($details['username']) . "</td></tr>
                    <tr><td><strong>Phone </strong></td><td>: " . $details['phone'] . "</td></tr>
					<tr><td><strong>Address </strong></td><td>: " . $details['address'] . "</td></tr>
                    <tr><td><strong>City </strong></td><td>: " . $details['city'] . "</td></tr>
                    <tr><td><strong>State </strong></td><td>: " . $details['state'] . "</td></tr>
					<tr><td><strong>Zip Code </strong></td><td>: " . $details['zip'] . "</td></tr>
					<tr><td><strong>Country</strong></td><td>: " . $details['country'] . "</td></tr>
					</table>
					<br/><br/>
					Thank You<br>
                    <a href='" . site_url() . "'><img src='" . base_url('images/email-logo.png') . "' alt='Cheap SEO Services' /></a>";

            $admin_subject = "New Registration on Cheap SEO Services";
            $admin_message = "<div style='border:5px solid #EEE; padding:35px; width:80%; margin:0 auto; color:#222222'>
            			Dear <strong>Admin</strong>, <br /><br /> A new registration has been made by " . ucwords($details['fname'] . " " . $details['lname']) . " with domain " . $domain . ". 
					The details of the registration are as follows:" . $user_details . "</div>";

            $user_subject = "Registration Successful on Cheap SEO Services!";
            $user_message = "<div style='border:5px solid #EEE; padding:35px; width:80%; margin:0 auto; color:#222222'>
            			Dear " . ucwords($details['fname'] . " " . $details['lname']) . ", <br><br>Your request to <a href='" . base_url() . "'>Cheap SEO Services</a> has been received. We will contact you soon. Please view details below:" . $user_details . "<br>";
            
            $message .= "Kind Regards,<br>";
            $message .= "Cheap SEO Services Customer Service<br>";
            $message .= "<a href='" . site_url() . "'>";
            $message .= "<img src='" . base_url('images/email-logo.png') . "' alt='Cheap SEO Services' /></a><br>";
            $message .= "Cheap SEO Services Ltd<br>";
            $message .= "Tel.:  + (44) -2085745043<br>";
            $message .= "Email: sales@cheapseoservice.co.uk<br>";
            $message .= "Web: www.cheapseoservice.co.uk<br>";
            $message .= "Disclaimer: This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this email. Please notify the sender immediately by email if you have received this email by mistake and delete this email from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.";
            $message .= "</div>";
            $this->load->library('email');

            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->email->initialize($config);

            $this->email->clear();
            $this->email->from($from_email, $from);
            $this->email->to($email);
            $this->email->reply_to($details['email'], ucwords($details['fname'] . " " . $details['lname']));

            $this->email->subject($admin_subject);
            $this->email->message($admin_message);
            if ($this->email->send()) {
                $this->email->clear();
                $this->email->from($from_email, $from);
                $this->email->to($details['email']);
                //$this->email->reply_to($details['email'],ucwords($details['fname']." ".$details['lname']));

                $this->email->subject($user_subject);
                $this->email->message($user_message);
                if ($this->email->send()) {
                    return true;
                }
                else
                    return false;
            }
            return TRUE;
        }
        else
            return FALSE;
    }

    public function update_ipn($id) {
        $this->db->where('id', $id);
        $this->db->update('tbl_invoice', array('paid_status' => 1));
        return true;
    }

    public function get_home_section(){
        $this->db->where('id',1);
        $query = $this->db->get('tbl_home_section');
        if($query->num_rows()>0){
            $row = $query->row();
            if($row->bottom_description){
                $row->points = explode("#!#",$row->bottom_description);
            }else{
                $row->points = "";
            }
            return $row;
        }else{
            return false;
        }
    }

}