<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model','LM');
		

	}

	// List all your items
	public function index()
	{
		$this->load->view('loginTheme');
	}

	public function do_login(){
		$user = $this->input->post('username'); //admin
		$pass = $this->input->post('password'); //1234

		$cek = $this->LM->cekLogin($user,$pass);

		if($cek->num_rows()){
			$row = $cek->row();
			$level = $row->level;
			$nama = $row->nama;

			$data['level'] 		= $level;
			$data['nama'] 		= $nama;
			$data['username'] 	= $user;
			$data['isLogin'] 	= 'yes';

			$this->session->set_userdata($data);

			$ret['status'] = true;
			$ret['msg'] = 'login berhasil';
		}
		else{
			$ret['status'] = false;
			$ret['msg'] = 'user atau password salah';
		}

		echo json_encode($ret);


	}

	// Add a new item
	public function add()
	{

	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Login.php */
/* Location: ./application/modules/login/controllers/Login.php */
