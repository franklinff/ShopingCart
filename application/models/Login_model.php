<?php

/* Login_model contain user login related data
 * @package    CI
 * @subpackage Model
 * @author  Franklin
 */
class Login_model extends CI_Model{

		// Read data using username and password
		public function login($email,$password) {
		$condition = "email =" . "'" . $email . "' AND " . "password =" . "'" . $password . "'";
		$this->db->select('id,firstname,lastname,email,password,role_type');
		//$this->db->from('users');
		$this->db->where($condition);
		//$this->db->limit(1);
		$query = $this->db->get('users')->row(); //users is db table.
		//echo $this->db->last_query();die();
		//var_dump($query);
		//die();
		return $query;
		}
}
?>


