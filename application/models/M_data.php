
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {


	//FUNGSI CRUD

	public function cek_login($table, $where){
		return $this->db->get_where($table,$where);
	}

	public function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function get_data($table)
	{
		return $this->db->get($table);
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function edit_data($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	public function delete_data($where, $table)
	{
		$this->db->delete($table, $where);
	}

	//AKHIR FUNGSI CRUD
}

/* End of file M_data.php */
/* Location: ./application/models/M_data.php */