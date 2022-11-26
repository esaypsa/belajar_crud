<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SelectOption
{
	protected $ci;

	public function __construct()
	{
        $this->CI =& get_instance();
        $this->CI->load->model('my_model');
        $this->my_model =& $this->CI->my_model;
	}

	public function selectArmada(){
		$q = $this->my_model->getArmada();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">['.$val->tnkb.']'.$val->merek.'</option>';
			}
		}
		return $ret;
	}

	public function selectWATemplate(){
		$q = $this->my_model->get_all('wa_template');
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">['.$val->kode.']'.$val->tema.'</option>';
			}
		}
		return $ret;
	}

	public function selectJenisJabatan()
	{
		
		$q = $this->my_model->getJenisJabatan();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">'.$val->kode_jabatan.'</option>';
			}
		}
		return $ret;
	}

	public function selectPropinsi(){
	
		$q = $this->my_model->getPropinsi();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->kode.'">'.$val->nama.'</option>';
			}
		}
		return $ret;
		//echo $ret;
	}

	public function selectKabupaten($propID=null){
		
		$q = $this->my_model->getKabupaten($propID);
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->kode.'">'.$val->nama.'</option>';
			}
		}
		return $ret;	
		
	}

	public function selectKecamatan($kabID=null){
		
		$q = $this->my_model->getKecamatan($kabID);
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->kode.'">'.$val->nama.'</option>';
			}
		}
		return $ret;	
	}

	public function selectDesa($kecID=null){
		
		$q = $this->my_model->getDesa($kecID);
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->kode.'">'.$val->nama.'</option>';
			}
		}
		return $ret;	
	}

	public function selectPekerjaan(){
		
		$q = $this->my_model->getListPekerjaan();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">'.$val->nama_pekerjaan.'</option>';
			}
		}
		return $ret;	
	}

	public function selectHubunganKeluarga(){
		
		$q = $this->my_model->getHubunganKeluarga();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">'.$val->nama_hubungan.'</option>';
			}
		}
		return $ret;
	}

	public function selectJenjangPendidikan(){
		
		$q = $this->my_model->getJenjangPendidikan();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">['.$val->kode_jenjang.']'.$val->nama_jenjang.'</option>';
			}
		}
		return $ret;
	}



	public function getListJenisKeanggotaan(){
	
		$q = $this->my_model->getListKeanggotaan();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">'.$val->kode_jenis_keanggotaan.'</option>';
			}
		}
		return $ret;	
	}

	public function selectStruktural(){
		
		$q = $this->my_model->getListStruktural();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">'.$val->nama_struktur.'</option>';
			}
		}
		return $ret;	
	}

	public function selectGrupId(){
		
		$q = $this->my_model->getListUserGrup();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">'.$val->kode_grup.'</option>';
			}
		}
		return $ret;	
	}

	public function selectUserLevel(){
	
		$q = $this->my_model->getListUserLevel();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">'.$val->user_level_name.'</option>';
			}
		}
		return $ret;	
	}

	public function selectUPA(){
		$q = $this->my_model->getListUPA();
		$ret = '<option value="">--pilih--</option>';
		if($q){
			
			foreach ($q as $val) {
				$ret .= '<option value="'.$val->id.'">['.$val->kode.']'.$val-> nama.'</option>';
			}
		}
		return $ret;


	}

}

/* End of file selectOption.php */
/* Location: ./application/libraries/selectOption.php */
