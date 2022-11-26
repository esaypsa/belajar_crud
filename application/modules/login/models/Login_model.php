<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends MY_Model
{

public function __construct()
{
	parent::__construct();
	//Do your magic here
}

						
public function cekLogin($user,$pass){
	$query = $this->db->get_where('user_akun', array('username'=>$user, 'password'=>$pass));
	return $query;
}


}