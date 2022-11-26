<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 /**
 * Function Name
 *
 * Function description
 *
 * @access  public
 * @param int/string  $id
 * @return  string  $act
 */

if (! function_exists('getTransaction'))
{
  function getTransaction($pageSize='10', $page='1', $startTime='', $endTime='',$terminalSN='')
  {
  
 $url = 'http://150.107.137.151:1111/iclock/api/transactions/?page_size='.$pageSize.'&page='.$page.'&start_time='.urlencode($startTime).'&end_time='.urlencode($endTime);
   
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL             => $url ,
      CURLOPT_RETURNTRANSFER  => true,
      CURLOPT_ENCODING        => '',
      CURLOPT_MAXREDIRS       => 10,
      CURLOPT_TIMEOUT         => 0,
      CURLOPT_FOLLOWLOCATION  => true,
      CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST   => 'GET',
      CURLOPT_HTTPHEADER      => array(
        'Content-Type: application/json',
        'Authorization: Token 5f100ce0c2f6ea1aaca68885220f46c73a213de1'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //print_r($response);

    return $response;

  }
}

if (! function_exists('getTransactionByURL'))
{
  function getTransactionByURL($url)
  {
     
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL             => $url ,
      CURLOPT_RETURNTRANSFER  => true,
      CURLOPT_ENCODING        => '',
      CURLOPT_MAXREDIRS       => 10,
      CURLOPT_TIMEOUT         => 0,
      CURLOPT_FOLLOWLOCATION  => true,
      CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST   => 'GET',
      CURLOPT_HTTPHEADER      => array(
        'Content-Type: application/json',
        'Authorization: Token 5f100ce0c2f6ea1aaca68885220f46c73a213de1'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //print_r($response);

    return $response;

  }
}
