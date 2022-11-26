<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Theme 
{
	
	public $CI; 

	
	public function dashboard_theme($data=null){
		$CI =& get_instance();
		
		//$CI->load->view('dashboardTheme');
		$username 	= $CI->session->userdata('username');
		$level 	= $CI->session->userdata('level');
		$nama 		= $CI->session->userdata('nama');
		$isLogin 	= $CI->session->userdata('isLogin');

		if ($level == '1') {
			$data['menu'] = 'menu/menu_admin';
		}
		else if($level == '2'){
			$data['menu'] = 'menu/menu_operator';
		}

		if($isLogin == 'yes'){
			$data['nama'] 	= $nama;
			$data['username'] 	= $username;
			$CI->load->view('dashboardTheme',$data);
		}
		else{
			redirect('login/Login/index','refresh');
		}
		       
	}

	

    
}