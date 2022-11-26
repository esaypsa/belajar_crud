<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This function used to generate Log of user activity like add, edit, delete, etc
 * @param {string} 
 */
if(!function_exists('write_log')){


    function write_log($tipe = "", $str = ""){
        $CI =& get_instance();
     
        if (strtolower($tipe) == "login"){
            $log_tipe   = 0;
        }
        elseif(strtolower($tipe) == "logout")
        {
            $log_tipe   = 1;
        }
        elseif(strtolower($tipe) == "add"){
            $log_tipe   = 2;
        }
        elseif(strtolower($tipe) == "edit"){
            $log_tipe  = 3;
        }
        elseif(strtolower($tipe) == "delete"){
            $log_tipe  = 4;
        }
        else{
            $log_tipe  = 5;
        }
         //load model log
        $CI->load->model('Mlog');
        // paramter
        $param['userid']            = $CI->session->userdata('id');
        $param['username']          = $CI->Mlog->getusername($param['userid']);
        $param['tipe']              = $log_tipe;
        $param['des']               = $str;
        $param['request_uri']       = $CI->input->server('REQUEST_URI');
        $param['client_ip']         = $CI->input->server('REMOTE_ADDR');
        $param['client_user_agent'] = $CI->agent->agent_string();
        $param['referer_page']      = $CI->agent->referrer();
        
        
     
        //save to database
        $CI->Mlog->savelog($param);
 
    }
}