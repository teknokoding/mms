<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Unitmesin extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->load->model('mod_unitmesin');
		$this->session->set_flashdata('judul','Unit Mesin');
    }

	public function readbymesin($id_mesin)
	{
		$data = $this->mod_unitmesin->readbymesin($id_mesin);
		echo json_encode($data);
		
	}
	public function create()
	{
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('lkh/create');
		$this->load->view('footer');
		
		
		
		
	}
}
