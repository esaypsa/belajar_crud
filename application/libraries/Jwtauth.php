<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class Jwtauth 
{
	public $CI;
	public $SecretKey = '123456789';

	public function generateToken($uid, $username){
		//$key = '123456789';
		$issuedAt   = new DateTimeImmutable();
		$expire     = $issuedAt->modify('+60 minutes')->getTimestamp();      // Add 60 seconds
		$serverName = "sims.ypsa.id";

        $payload = array(
           	'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
    		'iss'  => $serverName,                       // Issuer
    		'nbf'  => $issuedAt->getTimestamp(),         // Not before
    		'exp'  => $expire,                           // Expire
            "uid" => $uid,
            "username" => $username
        );
 
        $token = JWT::encode($payload, $this->SecretKey,'HS256');
        return $token;
	} 
	public function decodedJwt($jwt){
		$key = '123456789';
		$decoded = $jwt ? JWT::decode($jwt, new Key($this->SecretKey, 'HS256')) : false;

		return $decoded;
	}

	public function getKeyFromCookie(){
		$CI =& get_instance();
		$cook = $CI->input->cookie('sims-token', TRUE);

		return $cook ? $cook : false;
	}

	public function setUserAuth(){
		$CI =& get_instance();
		$key = $this->getKeyFromCookie();
		$token = $this->decodedJwt($key);
		//"uid" => $uid,
        //"username" => $username

       /* $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
		$token = JWT::decode($jwt, $secretKey, ['HS512']);
		$now = new DateTimeImmutable();
		$serverName = "your.domain.name";

		if ($token->iss !== $serverName ||
		    $token->nbf > $now->getTimestamp() ||
		    $token->exp < $now->getTimestamp())
		{
		    header('HTTP/1.1 401 Unauthorized');
		    exit;
		}
		*/

		$now = new DateTimeImmutable();
		$serverName = "sims.ypsa.id";

		if($token){
			if ( $token->iss !== $serverName ||
			    $token->nbf > $now->getTimestamp() ||
			    $token->exp < $now->getTimestamp())
			{
			   /* header('HTTP/1.1 401 Unauthorized');
			    exit;*/
			    return false;
			}
			else{
				$id = $token->uid;
				$username = $token->username;

				$cek = $CI->db->get_where('user_akun',array('username'=>$username));
				if ($cek->num_rows()) {
					$data = $cek->row(); 
					$sess['ulevel'] 		= $data->level_user_id;
					$sess['uid'] 			= $data->id;
					$sess['username'] 		= $data->username;
					$sess['nama']			= $data->nama;
					
					$sess['defaultPage']	= 'admin/dashboard';
					$CI->session->set_userdata($sess);
					return true;
				}
				else{
					// header('HTTP/1.1 401 Unauthorized');
			    	 //exit;
					return false;
				}
			}

		}
		else{
			return false;
		}
		
	}


/*
try {

$decoded = JWT::decode($jwt, $key, array('HS256'));
$refresh_token=$decoded->data->refresh_token;

}

catch (Exception $e){

if($e->getMessage() == "Expired token"){
    list($header, $payload, $signature) = explode(".", $jwt);
    $payload = json_decode(base64_decode($payload));
    $refresh_token = $payload->data->refresh_token;

} else {

    // set response code
    http_response_code(401);

    // show error message
    echo json_encode(array(
        "message" => "Access denied.",
        "error" => $e->getMessage()
    ));
    die();
    }



*/

}

