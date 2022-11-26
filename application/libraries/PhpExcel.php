<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(dirname(APPPATH).'/excel/autoload.php');
		use PhpOffice\PhpSpreadsheet\Helper\Sample;
		use PhpOffice\PhpSpreadsheet\IOFactory;
		use PhpOffice\PhpSpreadsheet\Spreadsheet;

class PhpExcel
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function standardExport($docProperty,$headerData,$bodyData){

	}

}

/* End of file PhpExcel.php */
/* Location: ./application/libraries/PhpExcel.php */
