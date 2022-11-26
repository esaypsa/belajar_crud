<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('theme');
		

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$this->theme->dashboard_theme();
	}

	// Add a new item
	public function add()
	{

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

/* End of file Dashboard.php */
/* Location: ./application/modules/admin/controllers/Dashboard.php */
