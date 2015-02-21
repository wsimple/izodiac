<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelWpanel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_user($login, $pass)
	{
		$query = $this->db->query("
			SELECT * 
			FROM wpanel_users 
			WHERE email LIKE '".$login."' AND password LIKE '".$pass."'
			LIMIT 1 
		");

		return $query->num_rows() > 0 ? $query->row() : 0;
	}
}
?>