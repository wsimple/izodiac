<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelRates extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($data)
	{
		if ($this->exists($data['id_service'])){
			$this->update($data, $data['id_service']);
		}else{
			$this->db->insert('rates', $data);	
		}
	}

	public function update($data,$id)
	{
		$this->db->where('id_service', $id);
		$this->db->update('rates', $data);
	}

	public function exists($serv)
	{
		$query = $this->db->query("SELECT id FROM rates WHERE id_service = '".$serv."'");
		return ($query->num_rows()) > 0 ? true : false;
	}

	public function getRow($serv)
	{
		$query = $this->db->query("SELECT * FROM rates WHERE id_service = '".$serv."' ");
		return $query->row();
	}

	public function getRows($where='', $limit='', $order=' ORDER BY id')
	{
		$query = $this->db->query("SELECT * FROM rates $where $order $limit");
        return $query->result_array();
	}

}
?>