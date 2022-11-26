 <?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 /**
 * Function Name
 *
 * Function description
 *
 * @access	public
 * @param	type	name
 * @return	type	
 */
 
if (! function_exists('sendtext'))
{
	function sendtext($number,$text,$apikey=null)
	{
       $API_KEY = $apikey ? $apikey : 'e06ff4b72915a8d440502e7890c8d688b801341c'; //ambulan

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://starsender.online/api/sendText?message='.rawurlencode($text).'&tujuan='.rawurlencode($number.'@s.whatsapp.net'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_HTTPHEADER => array(
            'apikey: '.$API_KEY
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       return $response;
    }
}

if (! function_exists('msgTemplate'))
{
  function msgTemplate($nama='')
  {

    $ret = '';

    $ret .= 'Terima kasih kepada bapak/ibu '.$nama.' yang telah menggunakan layanan Ambulan Hidayatullah, Dukung kami agar terus bermanfaat untuk semua.';
    return $ret;


  }
}