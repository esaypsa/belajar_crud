<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	function __construct()
		{
	    	parent::__construct();
	    	$this->upload_doc = dirname(APPPATH).'/upload_doc/';
	        $this->upload_userImage = dirname(APPPATH).'/upload_img/user_img/';
	        $this->jsonDoc = dirname(APPPATH).'/jsonDoc/'; 
		}
	
	private function _get_datatables_query($filter = null,$group_by=null) {
			
			
				$this->db->select($this->tablequery, FALSE);
			
			
			
			$i = 0;
			if ($this->column_search) {
				# code...
			
				foreach ($this->column_search as $item) // loop column 
				{
					if(isset($_POST['search']['value'])) // if datatable send POST for search
					{
						
						if($i===0) // first loop
						{
							$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
							$this->db->like($item, $_POST['search']['value']);
						}
						else
						{
							$this->db->or_like($item, $_POST['search']['value']);
						}

						if(count($this->column_search) - 1 == $i) //last loop
							$this->db->group_end(); //close bracket
					}
					$i++;
				}
			}

			if($filter){
				$this->db->where($filter);
			}
			if(isset($this->group_by)){
				$this->db->group_by($this->group_by);
			}
			
			if(isset($_POST['order'])) // here order processing
			{
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			else if(isset($this->order))
			{
				$order = $this->order;
				if(is_array($order)){
				$this->db->order_by(key($order), $order[key($order)]);	
				}
				else{
				$this->db->order_by($order, false);	
				}
				
			}
		
	}


	public function get_datatables($table,$col_order,$col_search,$order,$query,$filter=Null,$group_by = null) {
		//$this->db = $this->load->database($db, TRUE);
		$this->column_order = $col_order;
		$this->column_search = $col_search;
		$this->tablequery = $query;
		$this->order = $order;
		$this->group_by = $group_by;
		$this->_get_datatables_query($filter, $group_by);
		if(isset($_POST["length"]) && $_POST["length"] != -1 )
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		
	}

	public function count_filtered($query,$filter=null) {
		//$this->db = $this->load->database($db, TRUE);
		$this->tablequery = $query;
		$this->_get_datatables_query($filter);
		$query = $this->db->get();
		
		return $query->num_rows();
	}

	public function searchTermArr($tblquery,$columnSearch,$term,$limit){
		$this->db->select($tblquery, FALSE);
			
			$i = 0;
		
			foreach ($columnSearch as $item) // loop column 
			{
				if($term) // if datatable send POST for search
				{
					
					if($i===0) // first loop
					{
						$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
						$this->db->like($item, $term);
					}
					else
					{
						$this->db->or_like($item, $term);
					}

					if(count($columnSearch) - 1 == $i) //last loop
						$this->db->group_end(); //close bracket
				}
				$i++;
			}

		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
	}	

	public function count_all($table)	{
		//$this->db = $this->load->database($db, TRUE);
		
		$this->db->from($table);
		
		return $this->db->count_all_results();
	}

	public function count_all_query($table,$filter){
		$this->db->from($table);
		$this->db->where($filter);
		return $this->db->count_all_results();
	}


	public function save($table,$data) {
		//$this->db = $this->load->database($db, TRUE); 
		$this->db->insert($table, $data);
		
		return $this->db->insert_id(); 
	}

	public function insertDb($table,$data,$id=null){
	 
	 	if($id){
 			$insert = $this->update($table,array('id'=>$id), $data);

 		}
 		else{
 			$insert = $this->db->insert($table, $data); 
 		}

 		return $insert;
	}

	public function insertUpdate($table,$data,$key=null){
		//$key in array eg: ('id' => 1)
		if($key){
			$insert = $this->update($table,$key,$data);

		}
		else{
			$insert = $this->db->insert($table, $data); 
		}

		return $insert;
	}

	public function insertBatchDb($table,$data,$id=null){
		if($id){
 			$insert = $this->update($table,array('id'=>$id), $data);

 		}
 		else{
 			$insert = $this->db->insert_batch($table, $data); 
 		}

 		return $insert;
	}
	
	public function save2($table,$data){
    $this->db->insert($table, $data);
    return ($this->db->affected_rows() != 1) ? false : true;
}

	public function save_arr($table,$fieldName,$data){
		$this->db->set($fieldName,implode( "," , $data) );
		$this->db->insert($table);

	}

	public function save_batch($table,$data){
		return $this->db->insert_batch($table,$data);
	}

	public function saveBatchIgnore($table,$data){
		$this->db->trans_start();
		foreach ($data as $item) {
		       $insert_query = $this->db->insert_string($table, $item);
		       $insert_query = str_replace('INSERT INTO', 'REPLACE INTO', $insert_query);
		       $this->db->query($insert_query);
		    }
		$ret = $this->db->affected_rows();
		$this->db->trans_complete();
		return $ret;
	}

	public function get_by_id($table,$id) {
		//$this->db = $this->load->database($db, TRUE);
		$q = $this->db->get_where($table, array('id'=>$id));
		
		return $q->row();
	}

	public function getRowData($table,$id){
		$data = $this->db->get_where($table, array('id'=>$id))->row();
		if($data){
			$ret = array('status'=>true, 'data'=>$data);
		}
		else{
			$ret = array('status'=>false, 'data'=>null);	
		}

		return $ret;
	}

	public function get_all($table) {
		//$this->db = $this->load->database($db, TRUE);
		$q = $this->db->from($table)->order_by('id','ASC')->get();
		
		return $q->result();
	}	

	public function delete_by_id($table,$id) {
		//$this->db = $this->load->database($db, TRUE);
		$this->db->delete($table, array('id' => $id));
		
		return $this->db->affected_rows();
	}
	function deleteIdByIdPeserta($table,$id,$idpeserta){
		$this->db->delete($table, array('id' => $id, 'idpeserta'=>$idpeserta));
		
		return $this->db->affected_rows();
	}

	public function bulk_delete($table,$arr_id){
			$this->db->where_in('id', $arr_id)->delete($table);
			return $this->db->affected_rows();
	}

	public function softDeleteById($table,$id){
		$this->db->update($table,array('trash'=>1),array('id'=>$id));
		return $this->db->affected_rows();
	}

	public function bulkSoftDeleteById($table,$id){
		
		$this->db->where_in('id',$id);
		$this->db->update($table,array('trash'=>1));
		return $this->db->affected_rows();
	}

	public function update($table,$where, $data) {
		//$this->db = $this->load->database($db, TRUE);
		$this->db->update($table, $data, $where);
		
		return $this->db->affected_rows();
	}

	public function setVerifiedStatus($table,$id,$value){
			$this->db->update($table, array('verifiedby'=>$value), array('id'=>$id));
			return $this->db->affected_rows();
	}


	public function get_all_tablequery($query){
		//$this->db = $this->load->database($db, TRUE);
		$this->db->select($query, FALSE);
		if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		$query = $this->db->get();
		return $query->result();
		
	}

	public function cek_update_unik($table, $field, $value, $id){
		//$this->db = $this->load->database($db, TRUE);
		$q	= $this->db->get_where($table, array($field => $value, 'id != '=>$id));
		$ret = $q->num_rows()  ? FALSE:TRUE;

		return $ret;
	}

	public function toggle_data($table,$field,$id){
		$q = $this->db->set($field,'(id = '.$id.')' ,false)->update($table);
		return $q;
	}

	public function table_fields($table){
    	return $this->db->list_fields($table);
	}
	public function getUnitSekolah(){
		//$this->db = $this->load->database('ypsan', TRUE);
		$q = $this->db->query("CALL getUnitSekolah()");
		return $q->result();
	}
	public function getPropinsi(){
		//$this->db = $this->load->database('ypsan', TRUE);
		//$q = $this->db->query("CALL getPropinsi()");
		$q = $this->db->get('propinsi');
		return $q->result();
	}

	public function getKabupaten($propID=0){
		//$this->db = $this->load->database('ypsan', TRUE);
		//$q = $this->db->query("CALL getKabupaten('".$propID."')");
		//$q = $this->db->get_where('kabupaten',array('propinsi_id'=>$propID));
		$q = $this->db->query("SELECT * FROM `kabupaten` WHERE LEFT(kode,2) = '".$propID."'");
		return $q->result();	
	}

	public function getKecamatan($kabID=0){
		//$this->db = $this->load->database('ypsan', TRUE);
		//$q = $this->db->query("CALL getKecamatan('".$kabID."')");
		//$q = $this->db->get_where('kecamatan',array('kabupaten_id'=>$kabID));
		$q = $this->db->query("SELECT * FROM `kecamatan` WHERE LEFT(kode,5) = '".$kabID."'");
		return $q->result();
	}

	public function getDesa($kecID=0){
		//$this->db = $this->load->database('ypsan', TRUE);
		//$q = $this->db->query("CALL getDesa('".$kecID."')");
		//$q = $this->db->get_where('desa',array('kecamatan_id'=>$kecID));
		$q = $this->db->query("SELECT * FROM `desa` WHERE LEFT(kode,8) ='".$kecID."'");
		return $q->result();
	}

	public function getArmada(){
		$q = $this->db->get('armada');
		return $q->result();
	}
	


	public function updatePassword_rules(){
		$rules = [
					[
                        'field'=> 'oldpass',
                        'label'=> 'Password Lama',
                        'rules' => 'trim|required',
                        'errors'=> array('required'=>'%s wajib diisi'), 
                    ],
                    [
                        'field'=> 'newpass',
                        'label'=> 'Password Baru',
                        'rules' => 'trim|required',
                        'errors'=> array('required'=>'%s wajib diisi'), 
                    ],
                    [
                        'field'=> 'rnewpass',
                        'label'=> 'Konfirmasi Password',
                        'rules' => 'trim|required|matches[newpass]',
                        'errors'=> array('required'=>'%s wajib diisi','matches'=>'konfirmasi Password tidak sesuai'), 
                    ],
                       
                   ];
    	return $rules;
	}
public function akunDriverSelect2(){
        $term = $this->input->post('search');
        $tblquery = " * from user_akun ";
        $coloumnSearch = array('nama','email');
        $limit = 5;
        $filter = array('level >'=>'2');
        $q = $this->searchTermArr($tblquery,$coloumnSearch,$term,$limit,$filter);
        $data = array();
        if($q){
            foreach($q as $h){
                $row = array();
                $row['id'] = $h->id;
                $row['text'] = "[".$h->nama."] ".$h->email;
                $data[] = $row;
            }
        
        }
        return $data;
}

public function dashboardBox(){
	$qArmada = $this->db->get('armada')->num_rows();
    $qDriver = $this->db->get_where('user_akun', array('level'=>3))->num_rows();
    $qLayanan = $this->db->get('form_layanan')->num_rows();
    $qPenerima = $this->db->query('SELECT * FROM `form_layanan` GROUP BY nik')->num_rows();

    $ret['armada'] = $qArmada ? $qArmada : 0;
    $ret['driver'] = $qDriver ? $qDriver : 0;
    $ret['layanan']= $qLayanan ? $qLayanan : 0;
    $ret['penerima']= $qPenerima ? $qPenerima : 0;

    return $ret;
}

public function terus(){

}
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */