<?php
class User_lib {

    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library("session");
        //$this->CI->load->library("database");
    }

    
   
    /**
     * User_lib::log_off()
     * 
     * @return
     */
     
    function log_off($section='admin')
    {
        //destry the session variables.
        //$this->CI->session->sess_destroy();
        if($section=='frontend')// destroy frontend session
        {
             $this->CI->session->unset_userdata('user_id');
             $this->CI->session->unset_userdata('user_name'); 
             $this->CI->session->unset_userdata('user_email'); 
        }
        else //destroy admin session
        {
            $this->CI->session->unset_userdata('admin_id');
            $this->CI->session->unset_userdata('admin_username');
            $this->CI->session->unset_userdata('admin_email'); 
        }
    }
    
    /**
     * User_lib::is_logged_in()
     * 
     * @return true: if any of the user is logged in
     * @return false: if none of the user is logged in
     */
    function is_logged_in($section='admin') //default logged in status for admin
    {
        //returns false if sesson is not set
        if($section=='frontend')return $this->CI->session->userdata('user_id');
        else return $this->CI->session->userdata('admin_id'); // admin end user session
    }
    
    /**
     * Main_model::set_logged_in_session()
     * 
     * @param mixed $associated_array
     * @return
     */
    public function set_logged_in_session($associated_array)
    {
        $this->CI->session->set_userdata($associated_array);
    }
    
    /**
     * Main_model::is_admin_user()
     * 
     * @return: true is super_user is logged in
     * @return: false if supr_user is not logged in
     */
    function is_admin(){
        //echo $this->session->userdata('user_type');
        if ($this->CI->session->userdata('user_type') === '0' && $this->is_logged_in())
		{
		    return true;
		}
        else
            return false;
    }
   	
	function get_user_id () {
		return $this->CI->session->userdata('user_id');
	}
	
	function set_transaction_id ($tran_id) {
		$this->CI->session->set_userdata('tran_id' , $tran_id);
	}
	
	function get_transaction_id () {
		return $this->CI->session->userdata('tran_id');
	}
	
	function  is_transaction_on_progress () {
		if ($this->get_transaction_id ())
			return true;
		else
			return false;
	}
	
	function clear_transcation() {
		$this->CI->session->unset_userdata('tran_id');
	}
	
	function getSchoolInfo($id)
    {
        return $this->CI->db->get_where('tbl_school',array('id'=>$id))->row();
    } 
	function getTeacherInfo($id)
    {
        return $this->CI->db->get_where('tbl_teacher',array('id'=>$id))->row();
    }
	
	function keep_url($url)
	{
		$this->CI->session->set_userdata('go_url',$url);
	}
	function keep_product_url($url)
	{
		$this->CI->session->set_userdata('product_url',$url);
	}
	function keep_shopping_url($url)
	{
		$this->CI->session->set_userdata('shop_list_url',$url);
	}
	
	function keep_searched_school_id($school_id)
	{
		$this->CI->session->set_userdata('searched_school_id',$school_id);
	}
}
?>
