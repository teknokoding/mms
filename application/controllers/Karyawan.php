<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->load->model('mod_karyawan');
		$this->session->set_flashdata('judul','Karyawan');
    }

	public function create()
	{
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('karyawan/create');
		$this->load->view('footer');
	}

	public function nama($nik)
	{
		$data['nama'] = $this->mod_karyawan->readnamabynik($nik);
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('dashmme',$data);
		$this->load->view('footer');

	}
}
