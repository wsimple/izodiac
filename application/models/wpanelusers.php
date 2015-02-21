<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WpanelUsers extends CI_Model {
	private $last_id;
	//private $fields;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->last_id = '';
		//$this->fields = '';		
	}

	public function get_seek($where="",$limit=" LIMIT 12")
	{
		$query = $this->db->query("
			SELECT 
				a.person_id AS id,
				a.first_name AS first_name,
				a.last_name AS last_name,
				a.phone_number AS phone_number,
				a.email AS email,
				a.address_1 AS address_1,
				a.address_2 AS address_2

			FROM ospos_people a JOIN ospos_customers b ON a.person_id = b.person_id
			$where 
			ORDER BY a.first_name, a.first_name
			$limit
		");
		return $query->result_array();
	}

	public function getRow()
	{
		$user = $this->session->userdata('wp-user');	
		$query = $this->db->query("SELECT * FROM wpanel_users WHERE id = '".$user['id']."' LIMIT 1 ");
		return $query->row();
	}

	public function get_id()
	{
		$user = $this->session->userdata('wp-user');
		return $user['id'];
	}	

	public function get_person($where)
	{
		$query = $this->db->query("SELECT * FROM ospos_people $where LIMIT 1 ");
		return $query->row();
	}





	public function exists($email)
	{
		$query = $this->db->query("
			SELECT email 
			FROM wpanel_users 
			WHERE email LIKE '".$email."'
		");
		return ($query->num_rows()) > 0 ? true : false;
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







	public function insert($array){
		$this->db->insert('wpanel_users',$array);
		$this->last_id = $this->db->insert_id();
	}

	public function update($array, $id){
		$this->db->where('id', $id);
		$this->db->update('wpanel_users', $array);
	}

	public function get_last_id(){
		return $this->last_id;
	}

	public function get_field($field, $where){
		$query = $this->db->query("SELECT $field FROM ospos_people $where LIMIT 1 ");
		$array = $query->row();
		return $array->$field;
	}

	public function full_name($id){ 
		$query = $this->db->query("SELECT first_name, last_name FROM ospos_people WHERE person_id = '".$id."' LIMIT 1 ");
		$array =  $query->row();
		return $array->first_name.' '.$array->last_name; 
	}
}

?>