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

	function get_pages() {
		$result = $this->db->order_by('id', 'asc')->get('tbl_contents');
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return false;
		}
	}

	function get_page_details($page_id) {
		$result = $this->db->where('id', $page_id)->get('tbl_contents');
		return $result->row_array();
	}

	function update_page_content($page_id) {
		$background_image = $this->input->post('old_background_image');
		if (!empty($_FILES['background_image']['name'])) {
			$tmpFilePath = $_FILES['background_image']['tmp_name'];
			$background_image = date('YmdHis') . $_FILES['background_image']['name'];
			$filePath = "images/background/" . $background_image;
			move_uploaded_file($tmpFilePath, $filePath);
		}

		$page_name = $this->input->post('title');
		$page_desc = $this->input->post('txtPageDes');
		$desc_more = $this->input->post('more_info');
		$meta_tags = $this->input->post('meta_tags');
		$meta_title = $this->input->post('meta_title');
		$meta_desc = $this->input->post('meta_desc');
		$page_status = $this->input->post('page_status');
		$google_map_url = $this->input->post('google_map_url');

		$sub_title = $this->input->post('sub_title');
		$main_title_1 = $this->input->post('main_title_1');
		$main_title_2 = $this->input->post('main_title_2');
		$on_footer = !empty($this->input->post('on_footer')) ? 1 : 0;
		$on_contact = !empty($this->input->post('on_contact')) ? 1 : 0;
		$gallery = !empty($this->input->post('gallery')) ? 1 : 0;
		$page_seo = $this->input->post('page_seo');
		$image_name = $this->input->post('image_name');

		if ($page_status == "") {
			$page_status = 0;
		}

		if ($meta_title == "") {
			$meta_title = $page_name;
		}
		$meta_desc = $this->input->post('meta_desc');
		if ($meta_desc == "") {
			$meta_desc = substr(trim(strip_tags($page_desc)), 0, 160);
		}

		$update_data = array(
			'title' => $page_name,
			'background_image' => $background_image,
			'desc' => $page_desc,
			'desc_more' => $desc_more,
			'meta_title' => $meta_title,
			'meta_desc' => $meta_desc,
			'meta_keywords' => $meta_tags,
			'status' => $page_status,
			'sub_title' => $sub_title,
			'google_map_url' => $google_map_url,
			'main_title_1' => $main_title_1,
			'main_title_2' => $main_title_2,
			'on_footer' => $on_footer,
			'on_contact' => $on_contact,
			'page_seo' => $page_seo,
			'gallery' => $gallery,
			'image_name' => $image_name,
			'updated' => date('Y-m-d'),
		);

		$this->db->where('id', $page_id);
		$this->db->update('tbl_contents', $update_data);
	}
	function add_page() {
		$page_name = $this->input->post('title');
		$page_desc = $this->input->post('txtPageDes');
		$desc_more = $this->input->post('more_info');
		$meta_tags = $this->input->post('meta_tags');
		$meta_title = $this->input->post('meta_title');
		$google_map_url = $this->input->post('google_map_url');
		$meta_desc = $this->input->post('meta_desc');
		$page_status = !empty($this->input->post('page_status')) ? 1 : 0;
		$on_contact = !empty($this->input->post('on_contact')) ? 1 : 0;
		$gallery = !empty($this->input->post('gallery')) ? 1 : 0;

		$sub_title = $this->input->post('sub_title');
		$main_title_1 = $this->input->post('main_title_1');
		$main_title_2 = $this->input->post('main_title_2');
		$on_footer = !empty($this->input->post('on_footer')) ? 1 : 0;
		$page_seo = $this->input->post('page_seo');

		if ($meta_title == "") {
			$meta_title = $page_name;
		}
		$meta_desc = $this->input->post('meta_desc');
		if ($meta_desc == "") {
			$meta_desc = substr(trim(strip_tags($page_desc)), 0, 160);
		}

		$update_data = array(
			'title' => $page_name,
			'desc' => $page_desc,
			'desc_more' => $desc_more,
			'meta_title' => $meta_title,
			'meta_desc' => $meta_desc,
			'meta_keywords' => $meta_tags,
			'status' => $page_status,
			'sub_title' => $sub_title,
			'main_title_1' => $main_title_1,
			'main_title_2' => $main_title_2,
			'google_map_url' => $google_map_url,
			'on_footer' => $on_footer,
			'on_contact' => $on_contact,
			'page_seo' => $page_seo,
			'gallery' => $gallery,
			'updated' => date('Y-m-d'),
		);

		$this->db->insert('tbl_contents', $update_data);
		return $this->db->insert_id();
	}

	function get_admin_emails() {
		$result = $this->db->select('email')->get('tbl_users');
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return false;
		}
	}

	function get_generic_seo() {
		$sql = "SELECT  * FROM tbl_generic_seo";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->row_array();
		} else {
			return false;
		}
	}

	function update_generic_seo() {
		$meta_keywords = $this->input->post('meta_tags');
		$meta_title = $this->input->post('meta_title');
		$meta_desc = $this->input->post('meta_desc');

		$update_data = array(
			'meta_title' => $meta_title,
			'meta_desc' => $meta_desc,
			'meta_keywords' => $meta_keywords,
		);

		$this->db->where('id', '1');
		$this->db->update('tbl_generic_seo', $update_data);
	}

	function get_email_list() {
		return $this->db->get('tbl_admin_email');
	}

	function update_admin_email() {
		$post = $this->input->post();
		//var_dump($post);die();
		if ($this->db->get('tbl_admin_email')->num_rows() > 0) {

			$update = array(
				'email1' => $post['email1'],
				'email2' => $post['email2'],
				'email3' => $post['email3'],
				'email4' => $post['email4'],
				'email5' => $post['email5'],
			);

			if ($this->db->update('tbl_admin_email', $update)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			$insert = array(
				'email1' => $post['email1'],
				'email2' => $post['email2'],
				'email3' => $post['email3'],
				'email4' => $post['email4'],
				'email5' => $post['email5'],
			);

			if ($this->db->insert('tbl_admin_email', $insert)) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

}

/* End of admin/content_model.php */
?>