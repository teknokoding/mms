<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterunitmesin extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->load->model('mod_mesin');
		$this->load->model('mod_unitmesin');
		$this->load->model('mod_sect');
		$this->session->set_flashdata('judul','Master unit mesin');
    }

	
	public function index()
	{
		$data['unitmesin']=$this->mod_unitmesin->read();
		$data['mesin']=$this->mod_mesin->read();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('masterunitmesin/index',$data);
		$this->load->view('footer');
	}

	public function insert()
	{
		$data = array(
			'id_mesin'=>$this->input->post('id_mesin'),
			'nama_unitmesin'=>$this->input->post('nama_unitmesin')
		);
		$this->mod_unitmesin->insert($data);
		$this->session->set_userdata("swal","Swal.fire(
			'Unit mesin Berhasil Ditambah',
			'',
			'success'
		  )");
		redirect('Masterunitmesin');
	}

	public function edit_form($id_unitmesin)
	{
		$data['mesin_edit']=$this->mod_mesin->read();
		$data['unitmesin_edit']=$this->mod_unitmesin->readbyid($id_unitmesin);
		$this->load->view('Masterunitmesin/edit_form',$data);
	}

	public function update($id_unitmesin)
	{
		$data = array(
			'id_mesin'=>$this->input->post('id_mesin'),
			'nama_unitmesin'=>$this->input->post('nama_unitmesin')
		);
		$this->mod_unitmesin->update($id_unitmesin,$data);
		$this->session->set_userdata("swal","Swal.fire(
			'Unit Mesin Berhasil Diupdate',
			'',
			'success'
		  )");
		redirect('Masterunitmesin');
	}

	public function hapus($id_unitmesin)
	{
		$this->mod_unitmesin->hapus($id_unitmesin);
		$this->session->set_userdata("swal","Swal.fire(
			'Unit mesin Berhasil Dihapus',
			'',
			'warning'
		  )");
		redirect('Masterunitmesin');
	}
}
