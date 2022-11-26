<?php
defined('BASEPATH') OR exit('No direct script access allowed');




$config['base_url'] = isset($_SERVER['HTTP_HOST']) ? 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '').'://'.$_SERVER['HTTP_HOST'].str_replace('//','/',dirname($_SERVER['SCRIPT_NAME']).'/') : dirname($_SERVER['SCRIPT_NAME']);

 

$config['index_page'] = '';


$config['uri_protocol']	= 'REQUEST_URI';


$config['url_suffix'] = '';


$config['language']	= 'english';


$config['charset'] = 'UTF-8';


$config['enable_hooks'] = true;


$config['subclass_prefix'] = 'MY_';


$config['composer_autoload'] = dirname(APPPATH) . '/vendor/autoload.php';


$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-=';


$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

$config['allow_get_array'] = TRUE;

$config['log_threshold'] = array('4','5');

$config['log_path'] = APPPATH.'/logs/';

$config['log_file_extension'] = '';


$config['log_file_permissions'] = 0644;


$config['log_date_format'] = 'Y-m-d H:i:s';


$config['error_views_path'] = '';


$config['cache_path'] = '';


$config['cache_query_string'] = FALSE;


$config['encryption_key'] = '123456789-PSB#YPSA#MEDAN#BY#ESA#SOLUSINDO#PERKASA-123456798';



$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'CRUD_session';
$config['sess_expiration'] = 117200;
$config['sess_save_path'] = APPPATH.'/cache/session/';
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;


$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= FALSE;


$config['standardize_newlines'] = FALSE;


$config['global_xss_filtering'] = FALSE;


$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();


$config['compress_output'] = FALSE;


$config['time_reference'] = 'local';


$config['rewrite_short_tags'] = FALSE;


$config['proxy_ips'] = '';



/*$config['sims_url']         = 'https://sims.ypsa.id';
$config['psb_url']          = 'https://psb.ypsa.id';
$config['finance_url']      = 'https://finance.ypsa.id';
$config['inventory_url']    = 'https://inventory.ypsa.id';
$config['akademik_url']     = 'https://akademik.ypsa.id';
$config['hrd_url']          = 'https://hrd.ypsa.id';
$config['kasir_url']        = 'https://kasir.ypsa.id';
$config['surat_url']        = 'https://surat.ypsa.id';
$config['pr_url']           = 'https://pr.ypsa.id';
$config['foundation_url']   = 'https://foundation.ypsa.id';       
$config['digilib_url']      = 'https://digilib.ypsa.id';*/


$config['sims_url']         = 'http://localhost/ypsa-sims';
$config['psb_url']          = 'http://localhost/ypsa-psb';
$config['finance_url']      = 'http://localhost/ypsa-finance';
$config['inventory_url']    = 'http://localhost/ypsa-inventory';
$config['akademik_url']     = 'http://localhost/ypsa-akademik';
$config['hrd_url']          = 'http://localhost/ypsa-hrd';
$config['kasir_url']        = 'http://localhost/ypsa-kasir';
$config['surat_url']        = 'http://localhost/ypsa-surat';
$config['pr_url']           = 'http://localhost/ypsa-pr';
$config['foundation_url']   = 'http://localhost/ypsa-foundation';
$config['digilib_url']      = 'https://digilib.ypsa.id';