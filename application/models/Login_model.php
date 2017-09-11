<?php
class Login_model extends CI_Model{ //backend login

		public function login($email,$password) {
		$condition = "email =" . "'" . $email . "' AND " . "password =" . "'" . $password . "'";
		$this->db->select('id,firstname,lastname,email,password,role_type');

		$this->db->where($condition);

		$query = $this->db->get('users')->row(); 
		return $query;
		}		
}
?>


