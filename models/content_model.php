<?php

class Content_model extends CI_Model {

	/**
	 * content_model::__construct()
	 *
	 * @return
	 */
	function __construct() {
		$this->load->library('user_lib');
	}

	function get_content_by_slug($slug) {
		$result = $this->db->where('page_seo', $slug)->get('tbl_contents');
		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return false;
		}
	}
        
        
        function get_testimonials($limit = "", $offset = "") {
            if ($limit != "") {
                $this->db->limit($limit, $offset);
            }
            $result = $this->db->get('tbl_testimonials');
            if ($result->num_rows > 0) {
                return $result->result();
            } else {
                return false;
            }
        }

	public function send_contact_email() {
		$values = $this->input->post();

		$from_email = $this->config->item('site_email');
		$from = $this->config->item('site_title');

		$email = "";
		$name = ucwords($values['first_name'] . " " . $values['last_name']);

		$admin_email = $this->db->get('tbl_admin_email')->row();
		if ($admin_email->email1 != "") {
			$email .= "," . $admin_email->email1;
		}

		if ($admin_email->email2 != "") {
			$email .= "," . $admin_email->email2;
		}

		if ($admin_email->email3 != "") {
			$email .= "," . $admin_email->email3;
		}

		if ($admin_email->email4 != "") {
			$email .= "," . $admin_email->email4;
		}

		if ($admin_email->email5 != "") {
			$email .= "," . $admin_email->email5;
		}

		$subject = "Contact Form Submission by " . $name;
		$message = "<div style='border:5px solid #EEE; padding:35px; width:80%; margin:0 auto; color:#222222'>
        		Dear <strong>Admin</strong>, <br /><br /> The contact has been made by " . $name . ".
				The details of the message are as follows:
				<br/><br/>
				<table>
				<tr><td><strong>Name</strong>:</td><td>" . $name . "</td></tr>
                <tr><td><strong>Company</strong>:</td><td>" . $values['company'] . "</td></tr>
				<tr><td><strong>Email address</strong>:</td><td>" . $values['email'] . "</td></tr>
                <tr><td><strong>Number</strong>:</td><td>" . ($values['number'] ? $values['number'] : 'N/A') . "</td></tr>
                <tr><td><strong>Address</strong>:</td><td>" . ($values['address'] ? $values['website'] : 'N/A') . "</td></tr>
				<tr><td><strong>Message</strong>:</td><td>" . nl2br($values['message']) . "</td></tr>
				</table>";

		$message .= "Kind Regards,<br>";
		$message .= "Loft Conversion Customer Service<br>";
		$message .= "<a href='" . site_url() . "'>";
		$message .= "<img style='height: 26px;'  src='" . base_url('images/logo/loftconversionlondonlogo.png') . "' alt='Loft Conversion' /></a><br>";
		$message .= "Loft Conversion (Part of Webmax Ltd)<br>";
		$message .= "Tel.:  + (44) -2085745043<br>";
		$message .= "Email: info@loftconversionlondon.com<br>";
		$message .= "Web: www.loftconversionlondon.com<br>";
		$message .= "<div style='color:#555;font-size:12px;padding-top:10px;'>Disclaimer: This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this email. Please notify the sender immediately by email if you have received this email by mistake and delete this email from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div>";
		//print_r($values);die();
		$message .= "</div>";

		$this->load->library('email');

		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$this->email->initialize($config);

		$this->email->clear();
		$this->email->from($from_email, $from);
		$this->email->to($email);
		$this->email->reply_to($values['email'], $name);

		$this->email->subject($subject);
		$this->email->message($message);
		if ($this->email->send()) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	public function send_project_email() {

		$values = $this->input->post();

		$from_email = $this->config->item('site_email');
		$from = $this->config->item('site_title');

		$email = "";
		$name = ucwords($values['full_name']);

		$admin_email = $this->db->get('tbl_admin_email')->row();
		if ($admin_email->email1 != "") {
			$email .= "," . $admin_email->email1;
		}

		if ($admin_email->email2 != "") {
			$email .= "," . $admin_email->email2;
		}

		if ($admin_email->email3 != "") {
			$email .= "," . $admin_email->email3;
		}

		if ($admin_email->email4 != "") {
			$email .= "," . $admin_email->email4;
		}

		if ($admin_email->email5 != "") {
			$email .= "," . $admin_email->email5;
		}

		$subject = "Project Info Submission by " . $name;
		$message = "<div style='border:5px solid #EEE; padding:35px; width:80%; margin:0 auto; color:#222222'>
                Dear <strong>Admin</strong>, <br /><br /> The project information  has been submitted by " . $name . ".
                The details of the message are as follows:
                <br/><br/>
                <table>
                <tr><td><strong>Name</strong></td><td>: " . $name . "</td></tr>
                <tr><td><strong>Email address</strong></td><td>: " . $values['email'] . "</td></tr>
                <tr><td><strong>Telephone No.</strong></td><td>: " . ($values['telephone'] ? $values['telephone'] : 'N/A') . "</td></tr>
                <tr><td><strong>Address</strong></td><td>: " . $values['address'] . "</td></tr>
                <tr><td><strong>Message</strong></td><td>: " . ($values['message'] ? $values['message'] : 'N/A') . "</td></tr>
                <tr><td><strong>Property Type</strong></td><td>: " . $values['your_property_type'] . "</td></tr>
                </table><br/>";

		$message .= "Kind Regards,<br>";
		$message .= "Loft Conversion Customer Service<br>";
		$message .= "<a href='" . site_url() . "'>";
		$message .= "<img style='height: 26px;' src='" . base_url('images/logo/loftconversionlondonlogo.png') . "' alt='Loft Conversion' /></a><br>";
		$message .= "Loft Conversion (Part of Webmax Ltd)<br>";
		$message .= "Tel.:  + (44) -2085745043<br>";
		$message .= "Email: info@loftconversionlondon.com<br>";
		$message .= "Web: www.loftconversionlondon.com<br>";
		$message .= "<div style='color:#555;font-size:12px;padding-top:10px;'>Disclaimer: This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this email. Please notify the sender immediately by email if you have received this email by mistake and delete this email from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div>";
		$message .= "</div>";

		/** client message **/
		$client_subject = "Confirmation Email";
		$client_message = "<div style='border:5px solid #EEE; padding:35px; width:80%; margin:0 auto; color:#222222'>
                Dear <strong>" . $name . "</strong>, <br /><br />
                Thank you for contacting us with regards to your Loft Conversion services.<br />
                Your project information has been received by our team and we will endeavour to get in touch with you as soon as possible. <br /> <br /> ";

		$client_message .= "Kind Regards,<br>";
		$client_message .= "Customer Service Team<br>";
		$client_message .= "<a href='" . site_url() . "'>";
		$client_message .= "<img style='height: 26px;' src='" . base_url('images/logo/loftconversionlondonlogo.png') . "' alt='Loft Conversion' /></a><br>";
		$client_message .= "Loft Conversion (Part of Webmax Ltd)<br>";
		$client_message .= "Tel.:  + (44) -2085745043<br>";
		$client_message .= "Email: info@loftconversionlondon.com<br>";
		$client_message .= "Web: www.loftconversionlondon.com<br>";
		$client_message .= "<div style='color:#555;font-size:12px;padding-top:10px;'>Disclaimer: This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this email. Please notify the sender immediately by email if you have received this email by mistake and delete this email from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div>";
		$client_message .= "</div>";
		//echo $message."<div style='margin-bottom:100px'>&nbsp;</div>".$client_message;die;
		$this->load->library('email');
		//$email = "shreyata.k@gmail.com";
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$this->email->initialize($config);

		/** first, send the email to the admin **/
		$this->email->clear();
		$this->email->from($from_email, $from);
		$this->email->to($email);
		$this->email->reply_to($values['email'], $name);

		$this->email->subject($subject);
		$this->email->message($message);
		//return true;
		if ($this->email->send()) {
			/** now, send email to client **/
			$this->email->clear();
			$this->email->from($from_email, $from);
			$this->email->to($values['email']);
			//$this->email->reply_to($email, "Loft Conversion");

			$this->email->subject($client_subject);
			$this->email->message($client_message);
			$this->email->send();

			return TRUE;
		} else {
			return FALSE;
		}

	}
}