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

 
if (! function_exists('jsbyEnv'))
{
	 $jspath;
	function jsbyEnv($namafile)
	{

		$ci =& get_instance();
		$filepath = ENVIRONMENT == 'production' ? 'vendor/libjs/min/' : 'vendor/libjs/'; 
		$extfile = ENVIRONMENT ==  'production' ? '.min.js?v='.time() : '.js?v='.strtotime(date('Ymd H:i:s'));
		
		if ($namafile == '' OR $namafile == null) {
			$jspath = '';
		}
		elseif (is_array($namafile)) {
			if (count($namafile)) {
				$jspath = '';
				foreach ($namafile as $nama) {
					$jspath .= '<script src="'.base_url().$filepath.$nama.$extfile.'"></script>';
					
				}	
			}
			else{
				$jspath = '';
			}

		}
		else{
 		$jspath = '<script src="'.base_url().$filepath.$namafile.$extfile.'"></script>';
		}
		return $jspath;
	}
}

if (! function_exists('cssbyEnv'))
{
	 $csspath;
	function cssbyEnv($namafile)
	{

		$ci =& get_instance();
		$filepath = ENVIRONMENT == 'production' ? 'vendor/libcss/min/' : 'vendor/libcss/'; 
		$extfile = ENVIRONMENT ==  'production' ? '.min.css?v='.time() : '.css?v='.time();
		
		if ($namafile == '' OR $namafile == null) {
			$csspath = '';
		}
		elseif (is_array($namafile)) {
			if (count($namafile)) {
				$csspath = '';
				foreach ($namafile as $nama) {
					$csspath .= '<link href="'.base_url().$filepath.$nama.$extfile.'" rel="stylesheet">';
					
				}	
			}
			else{
				$csspath = '';
			}

		}
		else{
 		$csspath = '<link href="'.base_url().$filepath.$namafile.$extfile.'" rel="stylesheet">';
		}
		return $csspath;
	}
}

if(!function_exists('jsArray')){
	function jsArray($jsfile){
		
	$ret = '';
	if (ENVIRONMENT == 'production'){
		$b = '';	
		$jsArr = array (
			
			'bootstrap4.3.1' 		=> 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
			'datatables'			=> 'https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js',
			'bs4-datatables'		=> 'https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
			'chartjs'				=> 'https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js',
			'daterangepicker'		=> 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js',
			'fontawesome5.10-12'	=> 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-12/js/all.min.js',
			'fullcalendar-core'		=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css',
			'fullcalendar-daygrid'	=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css',
			'fullcalendar-timegrid'	=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.css',
			'fullcalendar-google-calendar' => 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/google-calendar/main.min.js',
			'fullcalendar-list'		=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/list/main.min.js',
			'fullcalendar-luxon'	=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/luxon/main.min.js',
			'fullcalendar-rrule'	=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/rrule/main.min.js',
			'fullcalendar-bootstrap'=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js',
			'jquery3.4.1'			=> 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js',
			'moment2.24'			=> 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
			'pace-progress'			=> 'https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
			'popperjs'				=> 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
			'sweetalert2.1.2'		=> 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js',
			'select2'				=> 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js',
			'jquery-file-upload'	=> 'vendor/plugin/jquery-file-upload/js/jquery.fileupload.js',
			'fileupload-process'	=> 'vendor/plugin/jquery-file-upload/js/jquery.fileupload-process.js',
			'fileupload-ui'			=> 'vendor/plugin/jquery-file-upload/js/jquery.fileupload-ui.js',
			'fileupload-image'		=> 'vendor/plugin/jquery-file-upload/js/jquery.fileupload-image.js',
			'fileupload-validate'	=> 'vendor/plugin/jquery-file-upload/js/jquery.fileupload-validate.js',
			'fileupload-tmpl'		=> 'vendor/plugin/jquery-file-upload/js/tmpl.min.js',
			'jquery-ui-widget'		=> 'vendor/plugin/jquery-file-upload/js/vendor/jquery.ui.widget.js',
			'jstree'				=> 'vendor/plugin/jstree/dist/jstree.min.js',
			'multi-select'			=> 'vendor/plugin/multi-select/js/jquery.multi-select.js',
			'morris'				=> 'vendor/plugin/morrisjs/morris.min.js',
			'raphael'				=> 'vendor/plugin/raphael/raphael.min.js'

		);
	}
	else {
		$b	= base_url('');
		$jsArr = array(
			'bootstrap4.3.1' 			=> 'vendor/plugin/bootstrap/4.3.1/js/bootstrap.min.js',
			'datatables'				=> 'vendor/plugin/bs4-datatable/DataTables-1.10.18/js/jquery.dataTables.min.js',
			'bs4-datatables'			=> 'vendor/plugin/bs4-datatable/datatables.min.js',
			'chartjs'					=> 'vendor/plugin/chart.js/dist/chart.min.js',
			'daterangepicker'			=> 'vendor/plugin/daterangepicker/min/daterangepicker.min.js',
			'fontawesome5.10-12'		=> 'vendor/plugin/font-awesome/js/all.min.js',
			'fullcalendar-core'			=> 'vendor/plugin/fullcalendar/core/main.min.js',
			'fullcalendar-daygrid'		=> 'vendor/plugin/fullcalendar/daygrid/main.min.js',
			'fullcalendar-timegrid'		=> 'vendor/plugin/fullcalendar/timegrid/main.min.js',
			'fullcalendar-google-calendar' => 'vendor/plugin/fullcalendar/google-calendar/main.min.js',
			'fullcalendar-interaction' 	=> 'vendor/plugin/fullcalendar/interaction/main.min.js',
			'fullcalendar-bootstrap'	=> 'vendor/plugin/fullcalendar/bootstrap/main.min.js',
			'fullcalendar-list'			=> 'vendor/plugin/fullcalendar/list/main.min.js',
			'fullcalendar-luxon'		=> 'vendor/plugin/fullcalendar/luxon/main.min.js',
			'fullcalendar-rrule'		=> 'vendor/plugin/fullcalendar/rrule/main.min.js',
			'jquery3.4.1'				=> 'vendor/plugin/jquery/jquery-3.4.1.min.js',

			'moment2.24'				=> 'vendor/plugin/moment/min/moment.min.js',
			'pace-progress'				=> 'vendor/plugin/pace-progress/pace.min.js',
			'popperjs'					=> 'vendor/plugin/popper.js/dist/popper.min.js',
			'sweetalert2.1.2'			=> 'vendor/plugin/sweetalert/sweetalert.min.js',
			'select2'					=> 'vendor/plugin/select2/dist/js/select2.full.min.js',
			'fileupload'				=> 'vendor/plugin/jquery-file-upload/js/jquery.fileupload.js',
			'fileupload-process'		=> 'vendor/plugin/jquery-file-upload/js/jquery.fileupload-process.js',
			'fileupload-ui'				=> 'vendor/plugin/jquery-file-upload/js/jquery.fileupload-ui.js',
			'fileupload-image'			=> 'vendor/plugin/jquery-file-upload/js/jquery.fileupload-image.js',
			'fileupload-validate'		=> 'vendor/plugin/jquery-file-upload/js/jquery.fileupload-validate.js',
			'jquery-ui-widget'			=> 'vendor/plugin/jquery-file-upload/js/vendor/jquery.ui.widget.js',
			'fileupload-tmpl'			=> 'vendor/plugin/jquery-file-upload/js/tmpl.min.js',
			'fileupload-loadimage' 		=> 'vendor/plugin/jquery-file-upload/js/load-image.all.min.js',
			'jstree'					=> 'vendor/plugin/jstree/dist/jstree.min.js',
			'summernote'				=> 'vendor/plugin/summernote/dist/summernote.min.js',
			'summernote-bs4'			=> 'vendor/plugin/summernote/dist/summernote-bs4.min.js',
			'multi-select'			=> 'vendor/plugin/multi-select/js/jquery.multi-select.js',
			'morris'				=> 'vendor/plugin/morrisjs/morris.min.js',
			'raphael'				=> 'vendor/plugin/raphael/raphael.min.js'
			) ;
		}
		
		if(is_array($jsfile)){
			foreach($jsfile as $value){
				if(in_array($value, array_keys($jsArr)))
					$ret .= '<script src="'.$b.$jsArr[$value].'"></script>';
				
				
			}
		}
		else{
			if(in_array($jsfile,array_keys($jsArr)))
			$ret .= '<script src="'.$b.$jsArr[$jsfile].'"></script>';
		}
		

		return $ret;

	}
}

if(!function_exists('cssArray')){
	function cssArray($cssfile){
		if (ENVIRONMENT == 'production'){
			$b = '';
			$cssArr = array (
				'bootstrap4.3.1' 			=> 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
				'datatables'				=> 'https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css',
				'bs4-datatables' 			=> 'https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
				'chartjs'		 			=> 'https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.css',
				'daterangepicker'			=> 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css',
				'fontawesome5.10.0-12'	 	=> 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-12/css/all.min.css',
				'fullcalendar-core'	 		=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css',
				'fullcalendar-daygrid' 		=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css',
				'fullcalendar-timegrid' 	=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.css',
				'fullcalendar-list'			=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/list/main.min.css',
				
				'fullcalendar-bootstrap'	=> 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.css',
				'select2'					=> 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css',
				'fileupload'				=> 'vendor/plugin/jquery-file-upload/css/jquery.fileupload.css',
				'fileupload-ui'				=> 'vendor/plugin/jquery-file-upload/css/jquery.fileupload-ui.css',
				'jstree'				=> 'vendor/plugin/jstree/dist/themes/default/style.min.css',
				'multi-select'			=> 'vendor/plugin/multi-select/css/multi-select.css',
				'morris'				=> 'vendor/plugin/morrisjs/morris.css'

			);
		}
		else {
			$b	= base_url('');
			$cssArr = array(
				'bootstrap4.3.1' 		=> 'vendor/plugin/bootstrap/4.3.1/css/bootstrap.min.css',
				'bs4-datatables' 		=> 'vendor/plugin/bs4-datatable/datatables.min.css',
				//'chartjs'		 => 'vendor/plugin/chart.js/',
				'datatables' 			=> 'vendor/plugin/bs4-datatable/datatables.min.css',
				'daterangepicker'		=> 'vendor/plugin/daterangepicker/min/daterangepicker.min.css',
				'fontawesome5.10.0-12'	=> 'vendor/plugin/font-awesome/css/all.min.css',
				'fullcalendar-core'	 	=> 'vendor/plugin/fullcalendar/core/main.min.css',
				'fullcalendar-daygrid' 	=> 'vendor/plugin/fullcalendar/daygrid/main.min.css',
				'fullcalendar-timegrid' => 'vendor/plugin/fullcalendar/timegrid/main.min.css',
				'fullcalendar-bootstrap'=> 'vendor/plugin/fullcalendar/bootstrap/main.min.css',
				'fullcalendar-list'		=> 'vendor/plugin/fullcalendar/list/main.min.css',
				'select2'				=> 'vendor/plugin/select2/dist/css/select2.min.css',
				'select2-bs4'			=>  'vendor/plugin/select2/dist/css/select2-bootstrap.min.css',
				'fileupload'			=> 'vendor/plugin/jquery-file-upload/css/jquery.fileupload.css',
				'fileupload-ui'			=> 'vendor/plugin/jquery-file-upload/css/jquery.fileupload-ui.css',
				'jstree'				=> 'vendor/plugin/jstree/dist/themes/default/style.min.css',
				'summernote'			=> 'vendor/plugin/summernote/dist/summernote.min.css',
				'summernote-bs4' 		=> 'vendor/plugin/summernote/dist/summernote-bs4.min.css',
				'multi-select'			=> 'vendor/plugin/multi-select/css/multi-select.css',
				'morris'				=> 'vendor/plugin/morrisjs/morris.css'
			);
		}
		

		$ret = '';
		if(is_array($cssfile)){
			foreach($cssfile as $value){
				if(in_array($value, array_keys($cssArr)))
				$ret .= '<link href="'.$b.$cssArr[$value].'" rel="stylesheet">';
			}
		}
		else{
			if(in_array($cssfile, array_keys($jsArr)))
			$ret .= '<link href="'.$b.$cssArr[$cssfile].'rel="stylesheet">';
		}

		return $ret;


	}
}

/*
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
*/
