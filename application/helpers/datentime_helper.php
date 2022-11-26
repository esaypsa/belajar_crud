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
if (! function_exists('datetimenow'))
{
    function datetimenow() { 
        return date("Y-m-d H:i:s");
    }
} 

if (! function_exists('totalDaysOfDate'))
{
    function totalDaysOfDate($start, $end) { 
       $earlier = new DateTime($start);
       $later = new DateTime($end);

        return $later->diff($earlier)->format("%a"); //3
    }
} 

//date from string locale
/*
$string = '15 SEPTEMBER 2022 15:23:10';

//$date="01/02/2015"; //1th Feb
$formatter  =  new IntlDateFormatter("id_ID", IntlDateFormatter::MEDIUM, IntlDateFormatter::MEDIUM);
$unixtime   =  $formatter->parse($string);

$datetime   =  new DateTime();
$datetime->setTimestamp($unixtime);
echo $datetime->format('Y-m-d H:i:s'); //2022-09-15 15:23:10



*/

if (! function_exists('fullAge'))
{
    function fullAge($dob) { 
        $datetime1 = new DateTime();

        $datetime2 = new DateTime($dob);

        $difference = $datetime1->diff($datetime2);

        return $difference->y.' Tahun, ' 
                   .$difference->m.' Bulan, ' 
                   .$difference->d.' Hari';

    }
} 

if (! function_exists('dateYmd'))
{
    function dateYmd($date='0000-00-00') { 
        if($date == '0000-00-00' || $date == null || $date == '' || $date == '00-00-0000'){
            $ret = '0000-00-00';
        }
        
        else{
               $ret = date('Y-m-d', strtotime($date)); 
         }   
    
    return $ret;    

    }
}


if (! function_exists('dateDmy'))
{
    function dateDmy($date='0000-00-00') { 
        if($date == '0000-00-00' || $date == null || $date == '' || $date == '00-00-0000'){
            $ret = '00-00-0000';
        }
        
        else{
               $ret = date('d-m-Y', strtotime($date)); 
         }   
    
    return $ret;    

    }
}




if (! function_exists('add1month'))
{
	function add1month($date)
	{
		$dt = new DateTime($date); // "2016-01-31"

		$oldDay = $dt->format("d");
		$dt->add(new DateInterval("P1M")); // 2016-03-02
		$newDay = $dt->format("d");

		if($oldDay != $newDay) {
		    // Check if the day is changed, if so we skipped to the next month.
		    // Substract days to go back to the last day of previous month.
		    $dt->sub(new DateInterval("P" . $newDay . "D"));
		}

		//echo $dt->format("Y-m-d"); // 2016-02-29
		return $dt->format('Y-m-d');
	}
}
if (! function_exists('dateMailFormat'))
{
 function dateMailFormat($d){
        $now        = new dateTime('now');
        $nowYear    = $now->format('Y');
        $nowMonth   = $now->format('m');
        $nowDate    = $now->format('d');
        if(strtotime($d)){
            $fd = new dateTime($d);
            $year = $fd->format('Y') == $nowYear ? '' : $fd->format('y');

            $DateMonth = $fd->format('Y-m-d') == $now->format('Y-m-d') ? $fd->format('H:i') :  $fd->format('d').' '.$fd->format('M');
            $ret = $DateMonth.' '.$year;
        }
        else {
            $ret= '';
        }

        return $ret;

    }
}

#1. Default date, dengan format (’5 September 2017’).

#2. Short date, dengan format (‘5/09/2017’).

#3. Medium date, dengan format (‘5-Sep-2017’).

#4. Long date, dengan format (‘Selasa, 5 September 2017’).
      
    if ( ! function_exists('date_indo'))
    {
        function date_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.' '.$bulan.' '.$tahun;
        }
    }
      
    if ( ! function_exists('bulan'))
    {
        function bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "Januari";
                    break;
                case 2:
                    return "Februari";
                    break;
                case 3:
                    return "Maret";
                    break;
                case 4:
                    return "April";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Juni";
                    break;
                case 7:
                    return "Juli";
                    break;
                case 8:
                    return "Agustus";
                    break;
                case 9:
                    return "September";
                    break;
                case 10:
                    return "Oktober";
                    break;
                case 11:
                    return "November";
                    break;
                case 12:
                    return "Desember";
                    break;
            }
        }
    }
 
    //Format Shortdate
    if ( ! function_exists('shortdate_indo'))
    {
        function shortdate_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = short_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'/'.$bulan.'/'.$tahun;
        }
    }
      
    if ( ! function_exists('short_bulan'))
    {
        function short_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "01";
                    break;
                case 2:
                    return "02";
                    break;
                case 3:
                    return "03";
                    break;
                case 4:
                    return "04";
                    break;
                case 5:
                    return "05";
                    break;
                case 6:
                    return "06";
                    break;
                case 7:
                    return "07";
                    break;
                case 8:
                    return "08";
                    break;
                case 9:
                    return "09";
                    break;
                case 10:
                    return "10";
                    break;
                case 11:
                    return "11";
                    break;
                case 12:
                    return "12";
                    break;
            }
        }
    }
 
    //Format Medium date
    if ( ! function_exists('mediumdate_indo'))
    {
        function mediumdate_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = medium_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'-'.$bulan.'-'.$tahun;
        }
    }
      
    if ( ! function_exists('medium_bulan'))
    {
        function medium_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "Jan";
                    break;
                case 2:
                    return "Feb";
                    break;
                case 3:
                    return "Mar";
                    break;
                case 4:
                    return "Apr";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Jun";
                    break;
                case 7:
                    return "Jul";
                    break;
                case 8:
                    return "Ags";
                    break;
                case 9:
                    return "Sep";
                    break;
                case 10:
                    return "Okt";
                    break;
                case 11:
                    return "Nov";
                    break;
                case 12:
                    return "Des";
                    break;
            }
        }
    }
     
    //Long date indo Format
    if ( ! function_exists('longdate_indo'))
    {
        function longdate_indo($tanggal)
        {
            $ubah = gmdate($tanggal, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tgl = $pecah[2];
            $bln = $pecah[1];
            $thn = $pecah[0];
            $bulan = bulan($pecah[1]);
      
            $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
            $nama_hari = "";
            if($nama=="Sunday") {$nama_hari="Minggu";}
            else if($nama=="Monday") {$nama_hari="Senin";}
            else if($nama=="Tuesday") {$nama_hari="Selasa";}
            else if($nama=="Wednesday") {$nama_hari="Rabu";}
            else if($nama=="Thursday") {$nama_hari="Kamis";}
            else if($nama=="Friday") {$nama_hari="Jumat";}
            else if($nama=="Saturday") {$nama_hari="Sabtu";}
            return $nama_hari.','.$tgl.' '.$bulan.' '.$thn;
        }
    }