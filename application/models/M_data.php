
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	public function cek_login($table, $where){
		return $this->db->get_where($table,$where);
	}

}

/* End of file M_data.php */
/* Location: ./application/models/M_data.php */