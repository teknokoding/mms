<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterdurasi extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->load->model('mod_durasi');
		$this->session->set_flashdata('judul','Master Durasi Paket');
    }

	
	public function index()
	{
		$data['durasi']=$this->mod_durasi->read();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('masterdurasi/index',$data);
		$this->load->view('footer');
	}

	public function insert()
	{
		$data = $this->input->post();
		$this->mod_durasi->insert($data);
		$this->session->set_userdata("swal","Swal.fire(
			'Durasi Rawat Berhasil Ditambah',
			'',
			'success'
		  )");
		redirect('masterdurasi');
	}

	public function edit_form($id_durasi_cl)
	{
		$data['durasiedit']=$this->mod_durasi->readbyid($id_durasi_cl);
		$this->load->view('masterdurasi/edit_form',$data);
	}

	public function update($id_durasi_cl)
	{
		$data = $this->input->post();
		$this->mod_durasi->update($id_durasi_cl,$data);
		$this->session->set_userdata("swal","Swal.fire(
			'Durasi Rawat Berhasil Diupdate',
			'',
			'success'
		  )");
		redirect('masterdurasi');
	}

	public function hapus($id_durasi_cl)
	{
		$this->mod_durasi->hapus($id_durasi_cl);
		$this->session->set_userdata("swal","Swal.fire(
			'Durasi Rawat Berhasil Dihapus',
			'',
			'warning'
		  )");
		redirect('masterdurasi');
	}
}
