<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mesin extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		// $this->secure->auth();
		$this->load->model('mod_mesin');
		$this->session->set_flashdata('judul','Mesin');
    }

	
	public function create()
	{
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('lkh/create');
		$this->load->view('footer');
	}

	public function set_status($id_mesin, $status)
	{
		$this->mod_mesin->set_status($id_mesin,$status);
	}

	public function monitor_mesin()
	{
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('monitor/status');
		$this->load->view('footer');
	}

	public function ajax_status()
	{
		$data['status']=$this->mod_mesin->show_status();
		$this->load->view('monitor/ajax_status',$data);
	}

}
