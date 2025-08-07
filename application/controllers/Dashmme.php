<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashmme extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->session->set_flashdata('judul','Dashboard');
    }

	public function index()
	{
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('dashmme');
		$this->load->view('control-sidebar');
		$this->load->view('footer');
	}
}
