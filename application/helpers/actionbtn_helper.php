 <?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 /**
 * Function Name
 *
 * Function description
 *
 * @access	public
 * @param	int/string	$id
 * @return	string 	$act
 */
 
if (! function_exists('actbtn'))
{
	function actbtn($id,$act)
	{
		if($id){
			$btn = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_'.$act.'('."'".$id."'".')"><i class="fa fa-edit"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_'.$act.'('."'".$id."'".')"><i class="fas fa-trash-alt"></i> Delete</a>';
		}
		return $btn;
	}
}

if (! function_exists('actbtn2'))
{
	function actbtn2($id,$dataLabel)
	{
		if($id){
			$btn = '<button class="EditBtn btn btn-sm btn-primary"  title="Edit" data-value = "'.$id.'" data-label="'.$dataLabel.'"><i class="fa fa-edit"></i> Edit</button>
				  <button class="DeleteBtn btn btn-sm btn-danger"  title="Hapus" data-value = "'.$id.'" data-label="'.$dataLabel.'"><i class="fas fa-trash-alt"></i> Delete</button>';
		}
		return $btn;
	}
}

if (! function_exists('actbtn3'))
{
	function actbtn3($id,$dataLabel)
	{
		if($id){
			$btn = '<button class="EditBtn btn btn-outline-primary btn-sm fs-4"  title="Edit" data-value = "'.$id.'" data-label="'.$dataLabel.'"><i class="bx bx-edit"></i></button>
				  <button class="DeleteBtn btn btn-outline-danger btn-sm fs-4"  title="Hapus" data-value = "'.$id.'" data-label="'.$dataLabel.'"><i class="bx bxs-trash"></i></button>';
		}
		return $btn;
	}
}

if (!function_exists('update_btn')){
	function update_btn($id,$dataLabel){
		if($id){
		$btn = '<button class="EditBtn btn btn-outline-primary btn-sm fs-4"  title="Edit" data-value = "'.$id.'" data-label="'.$dataLabel.'"><i class="bx bx-edit"></i></button>';
		}
	return $btn;
	}
}

if (! function_exists('bc_sosper'))
{
	function bc_sosper($id,$dataLabel)
	{
		if($id){
			$btn = '<button class="BcBtn btn btn-sm btn-primary"  title="Edit" data-value = "'.$id.'" data-label="'.$dataLabel.'"><i class="fa fa-paper-plane"></i> Broadcast</button>
				  <button class="DeleteBtn btn btn-sm btn-danger"  title="Hapus" data-value = "'.$id.'" data-label="'.$dataLabel.'"><i class="fas fa-trash-alt"></i> Delete</button>';
		}
		return $btn;
	}
}

if (! function_exists('delbtn'))
{
	function delbtn($id,$act)
	{
		if($id){
			$btn = '<a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_'.$act.'('."'".$id."'".')"><i class="fa fa-trash"></i> Delete</a>';
		}
		return $btn;
	}
}

if (! function_exists('delbtn2'))
{
	function delbtn2($id,$dataLabel)
	{
		if($id){
			$btn = '<button class="DeleteBtn btn btn-sm btn-danger"  title="Hapus" data-value = "'.$id.'" data-label="'.$dataLabel.'"><i class="fas fa-trash-alt"></i> Delete</button>';
		}
		else{
			$btn='';
		}
		return $btn;
	}
}


if (! function_exists('editbtn'))
{
	function editbtn($id,$act)
	{
		if($id){
			$btn = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_'.$act.'('."'".$id."'".')"><i class="fa fa-edit"></i> Edit</a>';
		}
		return $btn;
	}
}

if (!function_exists('exportPDF'))
{
	function exportPDF($id,$dataLabel){
		$btn = '<button class="PdfBtn btn btn-sm btn-info"  title="Export PDF" data-value = "'.$id.'" data-label="'.$dataLabel.'"><i class="far fa-file-pdf"></i> PDF </button>';
		return $btn;
	}
}

if (!function_exists('exportExcel'))
{
	function exportExcel($id,$dataLabel){
		$btn = '<button class="ExcelBtn btn btn-sm btn-success"  title="Export Excel" data-value = "'.$id.'" data-label="'.$dataLabel.'"><i class="far fa-file-excel"></i> Excel </button>';
		return $btn;
	}
}

if (! function_exists('toggle_btn'))
{
	function toggle_btn($id,$checked,$act,$kelas=NULL)
	{
		if($id){
			$btn = '<div class="onoffswitch">
			        <input type="checkbox" name="onoffswitch" class="'.$kelas.' onoffswitch-checkbox" id="myonoffswitch" '.$checked.' onclick="'.$act.'('."'".$id."'".')">
			        <label class="onoffswitch-label" for="myonoffswitch">
			            <span class="onoffswitch-inner"></span>
			            <span class="onoffswitch-switch"></span>
			        </label>
			    </div>';
		}
		return $btn;
	}
}

if (!function_exists('head_tbl_btn'))
{
	function head_tbl_btn( $datasource="", $excel_btn= FALSE ){
		$btn = ' <button class="btn btn-secondary btn-sm" onclick="reload_table()"><i class="fas fa-sync"></i> Reload</button>
		<button id="add_btn" class="btn btn-primary btn-sm" data-source="'.$datasource.'" onclick="add_data()"><i class="fa fa-plus"></i> Tambah Data</button>
		<button id="bdelete_btn" class="btn btn-danger btn-sm" data-source="'.$datasource.'" onclick="bulk_delete()"><i class="fas fa-trash"></i> Hapus Masal</button>
		';
		
		if($excel_btn) {
			$btn .= ' <div class="btn-group">
		 <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-file-excel"></i> Excel</button>
		 <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -2px, 0px);">
		   <a class="dropdown-item" href="javascript:void(0)" onclick="import_excel()">Impor Excel</a>
		   <a class="dropdown-item" href="javascript:void(0)" onclick="export_excel()">Ekspor Excel</a>
		 </div>
	   </div>';
		}

	   return $btn;
	}
}


if (!function_exists('head_tbl_btn2'))
{
	function head_tbl_btn2( $dataLabel, $excel_btn = false, $image_btn = false ){
		$CI =& get_instance();
		$btn = ' <button class="btn ReloadBtn btn-secondary btn-sm" data-label = "'.$dataLabel.'" ><i class="fas fa-sync"></i> Reload</button>
		<button id="add_btn" class="btn AddBtn btn-primary btn-sm" data-label="'.$dataLabel.'"><i class="fa fa-plus"></i> Tambah Data</button>
		<button id="BulkdeleteBtn" class="btn BulkDeleteBtn btn-danger btn-sm" data-label="'.$dataLabel.'" ><i class="fas fa-trash"></i> Hapus Masal</button>
		';
		
		if($excel_btn) {
			$btn .= ' <div class="btn-group">
		 <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-file-excel"></i> Excel</button>
		 <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -2px, 0px);">
		   <button class="ImportexcelBtn dropdown-item"  data-label="'.$dataLabel.'" >Impor Excel</button>
		   <button class="ExportexcelBtn dropdown-item"  data-label="'.$dataLabel.'" >Ekspor Excel</button>
		 </div>
	   </div>';
		}

		if ($image_btn) {
			$btn .= ' <div class="btn-group">
		 <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;"> <i class="far fa-images"></i> Image</button>
		 <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -2px, 0px);">
		   <button class="ImportimgBtn dropdown-item"  data-label="'.$dataLabel.'" >Impor Foto</button>
		   <button class="ExportimgBtn dropdown-item"  data-label="'.$dataLabel.'" >Ekspor Foto</button>
		 </div>
	   </div>';
		}

	   return $btn;
	}
}

if (!function_exists('head_tbl_btn3'))
{
	function head_tbl_btn3( $dataLabel ){
		$CI =& get_instance();
		$btn = ' <button class="btn ReloadBtn btn-secondary btn-sm" data-label = "'.$dataLabel.'" ><i class="fas fa-sync"></i> Reload</button>
		<button id="add_btn" class="btn AddBtn btn-primary btn-sm" data-label="'.$dataLabel.'"><i class="fa fa-plus"></i> Tambah Data</button>';
		
		return $btn;
		}  
}

if (!function_exists('head_tbl_que'))
{
	function head_tbl_que( $dataLabel ){
		$CI =& get_instance();
		$btn = ' <button class="btn ReloadBtn btn-secondary btn-sm" data-label = "'.$dataLabel.'" ><i class="fas fa-sync"></i> Reload</button>
		<button id="add_btn" class="btn AddBtn btn-primary btn-sm" data-label="'.$dataLabel.'"><i class="fa fa-plus"></i> Tambah Data</button>';
		
		return $btn;
		}  
}

if (!function_exists('sendMailBtn'))
{
	function sendMailBtn( $dataLabel ){
		$CI =& get_instance();
		$btn = ' <button class="btn sendMailBtn btn-primary btn-sm" data-label = "'.$dataLabel.'" ><i class="fas fa-envelope"></i> Kirim Pesan</button>';
		
		return $btn;
		}  
}

if (!function_exists('syncBtn'))
{
	function syncBtn( $dataLabel ){
		$CI =& get_instance();
		$btn = ' <button class="btn syncBtn btn-warning btn-sm" data-label = "'.$dataLabel.'" ><i class="fas fa-exchange-alt"></i> Sinkron Data</button>';
		
		return $btn;
		}  
}



if (!function_exists('switch_btn'))
{
	function switch_btn($id="",$name="",$value="",$classinput="",$check="checked",$classlbl="switch-success", $checked="&#x2713", $unchecked="&#x2715"){
		$btn = '<label class="switch switch-label '.$classlbl.' ">
		<input id="'.$id.'" name="'.$name.'" value="'.$value.'" class="switch-input custom-control-input '.$classinput.'" type="checkbox" '.$check.' />
		<span class="switch-slider" data-checked="'.$checked.';" data-unchecked="'.$unchecked.';"></span>
	  </label>';
	return $btn;
	}
}



if (!function_exists('badgeLabel'))
{ 

	function badgeLabel($data,$cssClass='badge-secondary'){
		$ret = '';
		if($data){
			
			if (is_object($data) or is_array($data)) {

				//print_r($data);
				foreach ($data as  $value) {
					$ret .= '<span class="badge '.$cssClass.'"> '.$value.'</span> ';
				}
			}
			else {
				$ret = '<span class="badge '.$cssClass.'"> '.$data.'</span> ';
			}	
		}
	return $ret;	
	}
}

if (!function_exists('badgeNumber')) {
	/*
	*/
	function badgeNumber($data,$cssClass='btn-secondary'){
		$ret = '';
		$number = 1;
		if($data){
			if(is_array($data)){
				foreach ($data as $val) {
					$ret .= '<button class="btn '.$cssClass.' btn-sm" > <span class="fa-stack"> <span class="far fa-square fa-stack-2x"></span> <span class="fa-stack-1x"> '.$number++.' </span> </span>' .$val. '</button> ';
				
				}
			}
		}
		else{
			$ret = '<span class="badge '.$cssClass.'"> '.$data.'</span> ';
		}
	return $ret;	
	}
}

/*function badgeStackNumber($data,$cssClass='badge-secondary'){
	$ret = '';

	$ret .= '<span class="fa-stack">';
    //<!-- The icon that will wrap the number -->
    $ret .= '<span class="fa fa-circle-o fa-stack-2x"></span>' ;
    //<!-- a strong element with the custom content, in this case a number -->
    $ret .= '<strong class="fa-stack-1x"> 2 </strong>';
 $ret .= '</span>';
}*/