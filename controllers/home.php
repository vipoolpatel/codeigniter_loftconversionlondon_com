<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('content_model');
        $this->load->model('services_model');
        $this->load->model('loft_conversions_model');
        $this->load->model('results_model');
        $this->load->model('features_model');
        $this->load->model('admin/package_model', 'package');
    }

    // public function testing() {
        
    //     $getresult = $this->db->where('on_footer',1);
    //     $getresult = $this->db->get('tbl_contents')->result();
    //     foreach($getresult as $value)
    //     {
    //         $areaName = str_replace("Loft Conversion ", "", $value->title);

    //         $title1 = "Hip to Gable Loft Conversion ".$areaName;

    //         $description1 = "<a href='https://loftconversionlondon.com/hip-to-gable-loft-conversions'>Hip to Gable Loft Conversion</a> extends your house on the sloping side by replacing the roof with a vertical wall called the Gable. This gives maximum internal head height and floor space. Hip to Gable loft conversions are ideal for ".$areaName." homeowners with semi-detached, end of terraced, bungalows or detached properties. We provide full planning, design to build service.";

    //         $insert1  = array(
    //             'content_id' => $value->id,
    //             'title' => $title1,
    //             'description' => $description1,
    //             'default_image' => 'Dormer-Conversion.jpg',
    //         );
            
    //         $this->db->insert('tbl_content_type',$insert1);
            
    //         $title2 = "Dormer Loft Conversion ".$areaName;

    //         $description2 = "<a href='https://loftconversionlondon.com/dormer-loft-conversion'>Dormer Loft Conversion</a> is the most popular type of Loft Conversion undertaken by ".$areaName." homeowners. This is simply the extension of the existing roof vertically that allows extra additional floor space and headroom. There are height requirements of at least two metres or higher, with no need for planning permission in many cases.";

    //         $insert2  = array(
    //             'content_id' => $value->id,
    //             'title' => $title2,
    //             'description' => $description2,
    //             'default_image' => 'Gable-Conversion.jpg',
    //         );
            
    //         $this->db->insert('tbl_content_type',$insert2);

    //         $title3 = "Velux Loft Conversion ".$areaName;

    //         $description3 = "<a href='https://loftconversionlondon.com/velux-loft-conversion'>Velux or Roof Light Loft Conversion</a> is the simplest and economical of all Loft Conversions in ".$areaName.". The roof of your house remains unchanged, we only install attractive Velux windows that bring in plenty of natural light. As the roof structure remains intact, no planning is required. Velux Loft Conversions require considerably less construction work compared to the others and are less disruptive too. ";

            
    //         $insert3  = array(
    //             'content_id' => $value->id,
    //             'title' => $title3,
    //             'description' => $description3,

    //             'default_image' => 'Velux-Conversion.jpg',
    //         );
            
    //         $this->db->insert('tbl_content_type',$insert3);
            
    //     }
    // }

    public function index() {
        $data['package'] = $this->package->get_package();
        $data['seo_results'] = $this->results_model->get_result(3);
        $data['home_content'] = $this->content_model->get_content_by_slug('home');
        $data['features'] = $this->features_model->get_features(true,null,0);
        $data['home_section'] = $this->main_model->get_home_section();
        $data['section'] = $this->main_model->get_page_section();
        $data['services'] = $this->services_model->get_services(true);
        $data['loft_conversions_type'] = $this->loft_conversions_model->get_services(true);
        $data['home_sidebar'] = $this->db->get('tbl_home_sidebar')->result();
        $data['testimonials'] = $this->content_model->get_testimonials(5);
        $data['footer_logo'] = $this->db->get('tbl_footer_logo')->result();
        
        $data['home_city'] =  $this->db->get_where('tbl_contents', array('on_footer' => 1, 'status' => 1))->result();
        $data['home_gallery'] =  $this->db->get_where('tbl_contents', array('gallery' => 1, 'status' => 1))->result();
        
        $this->load->helper('captcha');
        $vals = array(
            'word'=>$this->common_lib->generate_captcha_word(),
            'img_path' => 'images/captcha/',
            'img_url' => base_url().'images/captcha/',
            'font_path'=>'fonts/PT_Sans-Web-Bold.ttf',
            'color'=>'#FFF'
        );
        
        $data['captcha'] = create_captcha($vals);
        $this->session->set_userdata('captchaWord', $data['captcha']['word']);
        $this->session->set_userdata('captcha', $data['captcha']);
        
        
        $this->load->view('home_view', $data);
    }

    public function content($slug) {
        $data['details'] = $this->content_model->get_content_by_slug($slug);
        if(!$data['details'] || $data['details']->status==0){
            show_404();
        }
        
        
          $this->load->helper('captcha');
        $vals = array(
            'word'=>$this->common_lib->generate_captcha_word(),
            'img_path' => 'images/captcha/',
            'img_url' => base_url().'images/captcha/',
            'font_path'=>'fonts/PT_Sans-Web-Bold.ttf',
            'color'=>'#FFF'
        );
        $data['captcha'] = create_captcha($vals);
        $this->session->set_userdata('captchaWord', $data['captcha']['word']);
        $this->session->set_userdata('captcha', $data['captcha']);
        
        
        
        $getImageGallery = $this->db->where('gallery_id',$data['details']->id);
        $getImageGallery = $this->db->get('tbl_content_image')->result();
        $data['getImageGallery'] = $getImageGallery;
        $data['home_city'] =  $this->db->get_where('tbl_contents', array('on_footer' => 1, 'status' => 1))->result();

    
        $getContentQuestion = $this->db->where('content_id',$data['details']->id);
        $getContentQuestion = $this->db->order_by('order_by','asc');
        $getContentQuestion = $this->db->get('tbl_content_question')->result();
        $data['getContentQuestion'] = $getContentQuestion;
        
        $getTestimonialStudy = $this->db->select('tbl_testimonial_study.*,tbl_contents.page_seo');
        $getTestimonialStudy = $this->db->from('tbl_testimonial_study');
        $getTestimonialStudy = $this->db->join('tbl_contents','tbl_contents.id = tbl_testimonial_study.sub_content_id');
        $getTestimonialStudy = $this->db->where('tbl_testimonial_study.content_id',$data['details']->id);
        $getTestimonialStudy = $this->db->get()->result();
        $data['getTestimonialStudy'] = $getTestimonialStudy;


        $getContentType = $this->db->select('*');
        $getContentType = $this->db->from('tbl_content_type');
        $getContentType = $this->db->where('content_id',$data['details']->id);
        $getContentType = $this->db->get()->result();
        $data['getContentType'] = $getContentType;
        

        if($slug == 'loft-conversion-gallery')
        {
            $data['getGallery'] = $this->db->get('tbl_gallery')->result();
            $this->load->view('loft_conversion_gallery', $data);
        }
        elseif($slug == 'work-with-us')
        {
            if (!empty($_POST)) {
                $this->load->library('form_validation');
       
                $this->form_validation->set_rules('first_name', 'First Name', 'required');
                $this->form_validation->set_rules('last_name', 'Last Name', 'required');
                $this->form_validation->set_rules('company', 'Company', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('number', 'Number', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('message', 'Message', 'required');
                $this->form_validation->set_rules('captcha', 'Captcha', 'required|matches[currentcaptcha]');

                if($this->form_validation->run() == true)
                {
                    $from_email = $this->config->item('site_email');
                    $from       = $this->config->item('site_title');

                    $email = "";

                    $admin_email = $this->db->get('tbl_admin_email')->row();

                    if($admin_email->email1 != "") {
                        $email .= "," . $admin_email->email1;
                    }

                    if($admin_email->email2 != "") {
                        $email .= "," . $admin_email->email2;
                    }

                    if($admin_email->email3 != "") {
                        $email .= "," . $admin_email->email3;
                    }

                    if($admin_email->email4 != "") {
                        $email .= "," . $admin_email->email4;
                    }

                    if($admin_email->email5 != "") {
                        $email .= "," . $admin_email->email5;
                    }


                    $all_send = $this->load->view('mail/work_with_us', $data, true);

                    $subject = 'Work with us - Loft Conversion London';

                    $this->load->library('email');

                    $config['mailtype'] = 'html';
                    $config['charset'] = 'utf-8';
                    $this->email->initialize($config);

                    $this->email->clear();
                    $this->email->from($from_email, $from);
                    $this->email->to($email);
                    $this->email->reply_to($this->input->post("email"), $this->input->post("first_name"));
                    $this->email->subject($subject);
                    $this->email->message($all_send);
                    $this->email->send();
                  
                    $this->session->set_flashdata('success',"Thank you. Your information successfully send.");
                    redirect('work-with-us');
                    
                }
            }
        
            $this->load->view('work_with_us', $data);
        }
        else
        {
            $this->load->view('content_view', $data);
        }
    }

    public function contact() {
        if(!empty($_POST))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name', 'Your first name', 'required');
            $this->form_validation->set_rules('last_name', 'Your last name', 'required');
            $this->form_validation->set_rules('company', 'Your company');
            $this->form_validation->set_rules('email', 'Your email address', 'required');
            $this->form_validation->set_rules('number', 'Your number');
            $this->form_validation->set_rules('address', 'Your address', 'required');
            $this->form_validation->set_rules('message', 'Your message', 'required');
            $this->form_validation->set_rules('captcha', 'Captcha', 'required');
            $this->form_validation->set_rules('current_captcha', 'Current Captcha', 'required|matches[captcha]');
            
            if ($this->form_validation->run() == TRUE) {
                if ($this->content_model->send_contact_email()) {
                    $this->session->set_flashdata('status', 'success');
                    // $this->session->set_flashdata('message',"Your message was sent successfully!");
                } else {
                    $this->session->set_flashdata('status', 'failed');
                    //$this->session->set_flashdata('message',"Your message could not be sent. Please Try Again!");
                }
                redirect('contact-us');
                
            }
        }
        $this->load->view('contact_view');
    }

    function send_project(){
        $this->load->helper('captcha');
        if ($this->input->post('submit')) {
            $userCaptcha = $this->input->post('captcha');
            $word = $this->session->userdata('captchaWord');
              if($userCaptcha == $this->input->post('current_captcha')){
                if ($this->content_model->send_project_email()) {
                    $this->session->set_flashdata('status', 'success');
                    redirect(base_url().'#contact-project-form');
                } else {
                    $this->session->set_flashdata('status', 'failed');
                }
              }
              else
              {
                 $this->session->set_flashdata('status', 'failed');
                $this->session->set_flashdata('captcha_message', 'The verification code did not match. Please enter the captcha again!');
              }
            redirect(site_url('#contact-project-form'));
        }
    }



    public function SendEmailContact()
    {

        $name               = $this->input->post('name');
        $address            = $this->input->post('address');
        $customer_email     = $this->input->post('email');
        $phone_number       = $this->input->post('telephone');
        $enquiry_details    = $this->input->post('enquiry_details');
        $your_property_type = $this->input->post('your_property_type');
        $contact_type       = $this->input->post('contact_type');
        $message            = $this->input->post('message');
        
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

        $subject = "Contact Form Submission by " . $name;
        $message = "<div style='border:5px solid #EEE; padding:35px; width:80%; margin:0 auto; color:#222222'>
                Dear <strong>Admin</strong>, <br /><br /> The contact has been made by " . $name . ". 
                The details of the message are as follows:
                <br/><br/>
                <table>
                <tr><td><strong>Name</strong>:</td><td>" . $name . "</td></tr>
                                <tr><td><strong>Address</strong>:</td><td>" . $address . "</td></tr>
                                <tr><td><strong>Email address</strong>:</td><td>" . $customer_email . "</td></tr>
                                <tr><td><strong>Phone Number</strong>:</td><td>" . ($phone_number?$phone_number:'N/A') . "</td></tr>
                                <tr><td><strong>Enquiry Details</strong>:</td><td>" . ($enquiry_details?$enquiry_details:'N/A') . "</td></tr>
                                <tr><td><strong>Your Property Type</strong>:</td><td>" . ($your_property_type?$your_property_type:'N/A') . "</td></tr>
                                <tr><td><strong>Contact Type</strong>:</td><td>" . ($contact_type?$contact_type:'N/A') . "</td></tr>
                                <tr><td><strong>Message</strong>:</td><td>" . nl2br($message) . "</td></tr>
                </table>";
        
        $message .= "Kind Regards,<br>";
        $message .= "Loft Conversion<br>";
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
        $this->email->reply_to($customer_email, $name);
        
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send())
              $json['success'] =  true;
        else
               $json['error'] =  true;
        
        
        echo json_encode($json);
        
    }
    

}

?>