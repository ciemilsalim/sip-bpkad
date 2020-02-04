<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
* 
*/
class Pengguna_model extends CI_Model
{
	public function getPengguna()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_role', 'user_role.id = user.role_id');
		$this->db->where('role_id!=',1);
		// $query = $this->db->get();
		// $query = "SELECT * from user join user_role on user_role.id=user.role_id";
		return $this->db->get()->result_array();
	}
}

?>