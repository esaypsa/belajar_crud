<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth
{
	public $CI;
	
	
	public function __construct()
	{	
		$CI =& get_instance();
		//parent::__construct();
		$this->SIMS_API_URL 	= $CI->config->item('sims_auth_api');
		$this->SIMS_API_USER 	= $CI->config->item('sims_api_user');
		$this->SIMS_API_PASS 	= $CI->config->item('sims_api_pass');
		$this->SIMS_API_KEY		= $CI->config->item('sims_api_key');
	}

	public function setUserSession(){
		$cook['at'] = $CI->input->cookie('ypsa-at', TRUE);
		$cook['rt'] = $CI->input->cookie('ypsa-rt', TRUE);
	}


	//eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjAwMjk0MjQsImlzcyI6InNpbXMueXBzYS5pZCIsIm5iZiI6MTY2MDAyOTQyNCwiZXhwIjoxNjYwMDcyNjI0LCJ1aWQiOiIxIiwidXNlcm5hbWUiOiJhZG1pbiJ9.Zp8pfBYPVsQlXggI7QiBn_IPcZsRnj9RZ-KRwiZltuA

	public function isLogin(){
		
		 $CI =& get_instance();
		$UID = $CI->session->userdata('uid');
		//log_message('debug','$UID = '. $UID);
		if($UID > 0){
			//session masih ada
			return true;
		}
		else{
			// ambil cookie ypsa-rt
			$RT =  $CI->input->cookie('ypsa-rt', TRUE);
			//log_message('debug','$RT = '.$RT);
			if($RT){
				$client = new \GuzzleHttp\Client([
			    'auth' => [$this->SIMS_API_USER, $this->SIMS_API_PASS]
				]);
				$headers = [
				  'SIMS-API-KEY' => $this->SIMS_API_KEY,
				  'Content-Type' => 'application/x-www-form-urlencoded'
				  
				];
				$url = 'https://sims.ypsa.id/api/jwttoken/newtoken';
				$response = $client->post($this->SIMS_API_URL,[
								'form_params' => ['rt' => $RT],
								'headers' => $headers	


				]);

				$res = json_decode(  $response->getBody()->getContents() );
				$exp = date('d-m-Y H:i:s', $res->exp);
				//log_message('debug','$exp = '.print_r($exp,true));
				log_message('debug','$res = '.print_r($res,true));
				if( $res->status ){

					$username = $res->data;
					$cek = $CI->db->get_where('user_akun',array('username'=>$username));
						if ($cek->num_rows()) {
							$data = $cek->row(); 
							$sess['ulevel'] 		= $data->level_user_id;
							$sess['uid'] 			= $data->id;
							$sess['username'] 		= $data->username;
							$sess['nama']			= $data->nama;
							
							$sess['defaultPage']	= 'admin/dashboard';
							//log_message('debug','sess = '. print_r($sess, true));
							$CI->session->set_userdata($sess);

							$this->USER			= $CI->session->userdata('username');
					    	$this->UNAME		= $CI->session->userdata('nama');
					    	$this->UID			= $CI->session->userdata('uid');
					    	$this->ULEVEL 		= $data->level_user_id;
					    	redirect(currentClass().'/'.currentMethod());
							//return true;
						}
						else{
							//data ga ada di DB
							redirect('https://sims.ypsa.id/');
							exit();
						}
				}
				else{
					//RT tidak valid
					redirect('https://sims.ypsa.id/');
					exit();
				}

			 
			 

			}
			else{
				// session habis kembalikan ke login sims.ypsa
				redirect('https://sims.ypsa.id/');
				exit();
			}
		}
	}

	public function ceklogin(){
		 $CI =& get_instance();
		$RT =  $CI->input->cookie('ypsa-rt');

		$client = new \GuzzleHttp\Client([
			    'auth' => ['SimsAdmin', 'simsypsa']
				]);
				$headers = [
				  'SIMS-API-KEY' => 'd4968961160065727c85f4ac6c6138fc033417ef',
				  'Content-Type' => 'application/x-www-form-urlencoded'
				  
				];
				$url = 'https://sims.ypsa.id/api/jwttoken/newtoken';
				$response = $client->post($url,[
								'form_params' => ['rt' => $RT],
								'headers' => $headers	


				]);
				$res =  $response->getBody()->getContents();

				$data['rt']=$RT;
				$data['res']=  $res;
			 
			  return  $data;
	}

		

}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */
