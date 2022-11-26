<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_user extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('theme');
		$this->load->model('Admin_model','AM');

	}

	// List all your items
	public function index( )
	{
		$data['libjs']  		= jsbyEnv(array('libAkun'));
		$data['libcss'] 		= '';
		$data['pjs']        	= jsArray(array('bs4-datatables'));
  		$data['pcss']       	= cssArray(array('datatables'));
  		$data['headTable']  = head_tbl_btn2('user_akun');
		$data['konten'] = 'admin/userAkunKonten';
		$this->theme->dashboard_theme($data);
	}

	public function table_user_akun(){
		$table        = 'user_akun';
      $col_order    = array('id'); 
     	$col_search   = array('nama','username','level');
      $order        = array('id' => 'ASC');
      $query        = " * FROM user_akun ";

      $filter = array();
              //get_datatables($table,$col_order,$col_search,$order,$query,$filter=Null,$group_by = null)
      $list  = $this->AM->get_datatables($table,$col_order,$col_search,$order,$query,$filter);
      $data  = array();
      $no    = $_POST['start'];
      foreach ($list as $da) {
         $no++;
         $row   = array();
       
         $row[] = $no; 
         $row[] = $da->nama; 
         $row[] = $da->username;
         $row[] = $da->level  ;
        
         $row[] = actbtn2($da->id,'data_akun'); 


         $data[] = $row;
     }

     $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => $this->AM->count_all_query($table,$filter),
        "recordsFiltered" => $this->AM->count_filtered($query,$filter,$filter),
        "data" => $data,
    );
        //output to json format
      $this->jsonOut($output);
	}

	// Add a new item
	public function add_user_akun()
	{

		$username = $this->input->post('username');

		$cek = $this->db->get_where('user_akun', array('username'=>$username));
		if( $cek->num_rows() ){
			$ret['status'] 		= false;
			$ret['msg']['error'] = 'username sudah digunakan';
		}else{
			$data['nama'] 		= $this->input->post('nama');
			$data['username'] = $username;
			$data['password'] = $this->input->post('password');
			$data['level'] 	= $this->input->post('level_user_id');



			$insert = $this->AM->save('user_akun',$data);

			if($insert){
				$ret['status'] = true;
				$ret['msg']['success']= 'berhasil';
			}
			else{
				$ret['status'] = false;
				$ret['msg']['error'] = 'gagal';
			}
		}



		


		$this->jsonOut($ret);




	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Akun_user.php */
/* Location: ./application/modules/admin/controllers/Akun_user.php */
