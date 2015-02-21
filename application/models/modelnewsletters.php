<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelNewsletters extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($name, $email)
	{
		$data = array(
			'name' => formatString($name,3),
			'email' => formatString($email,3)
		);

		$this->db->insert('newsletters', $data);
	}

	public function exists($email)
	{
		$query = $this->db->query("SELECT email FROM newsletters WHERE email LIKE '".$email."'");
		return ($query->num_rows()) > 0 ? true : false;
	}
}
?>