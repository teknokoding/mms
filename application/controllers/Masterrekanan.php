<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterrekanan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->load->model('mod_rekanan');
		$this->session->set_flashdata('judul','Master Rekanan');
    }

	
	public function index()
	{
		$data['relasi']=$this->mod_rekanan->read();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('masterrekanan/index',$data);
		$this->load->view('footer');
	}

	public function insert()
	{
		$data = $this->input->post();
		$this->mod_rekanan->insert($data);
		$this->session->set_userdata("swal","Swal.fire(
			'Rekanan Berhasil Ditambah',
			'',
			'success'
		  )");
		redirect('masterrekanan');
	}

	public function edit_form($id_relasi)
	{
		$data['relasiedit']=$this->mod_rekanan->readbyid($id_relasi);
		$this->load->view('masterrekanan/edit_form',$data);
	}

	public function update($id_relasi)
	{
		$data = $this->input->post();
		$this->mod_rekanan->update($id_relasi,$data);
		$this->session->set_userdata("swal","Swal.fire(
			'Rekanan Berhasil Diupdate',
			'',
			'success'
		  )");
		redirect('masterrekanan');
	}

	public function hapus($id_relasi)
	{
		$this->mod_rekanan->hapus($id_relasi);
		$this->session->set_userdata("swal","Swal.fire(
			'Rekanan Berhasil Dihapus',
			'',
			'warning'
		  )");
		redirect('masterrekanan');
	}
}
