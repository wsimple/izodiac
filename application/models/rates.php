<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rates extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
	}

	public function getRows($where='', $limit='', $order=' ORDER BY id')
	{
		$query = $this->db->query("SELECT * FROM rates $where $order $limit");
        return $query->result_array();
	}	

	public function getRow($content)
	{
		$query = $this->db->query("SELECT * FROM rates ".$this->get_where($content)." LIMIT 1 ");
		return $query->row();
	}

	public function getField($field, $content){
		$query = $this->db->query("SELECT $field FROM rates ".$this->get_where($content)." LIMIT 1 ");
		$array = $query->row();
		return $array->$field;
	}	

	public function insert($data)
	{
		return $this->db->insert('rates', $data) ? 1 : 0;
	}

	public function update($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('rates', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('rates');
	}

	public function exists($where)
	{
		$query = $this->db->query("
			SELECT id 
			FROM rates 
			$where
		");
		return ($query->num_rows()) > 0 ? true : false;
	}
}