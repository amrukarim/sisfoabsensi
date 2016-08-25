<?php
class Login_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function periksa_dataguru($email, $password)
	{
		$this->db->where('guru_email', $email);
		$this->db->where('guru_pass', $password);

		return $this->db->get('guru');
	}

}