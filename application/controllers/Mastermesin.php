<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mastermesin extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->load->model('mod_mesin');
		$this->load->model('mod_sect');
		$this->session->set_flashdata('judul','Master mesin');
    }

	
	public function index()
	{
		$data['sect']=$this->mod_sect->readpic();
		$data['mesin']=$this->mod_mesin->read();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('mastermesin/index',$data);
		$this->load->view('footer');
	}

	public function qrlist()
	{
		$data['sect']=$this->mod_sect->readpic();
		$data['mesin']=$this->mod_mesin->read();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('mastermesin/qrlist',$data);
		$this->load->view('footer');
	}


	public function insert()
	{
		$this->input->post('prv')=='on'?$prv='Y':$prv='N';
		$this->input->post('brk')=='on'?$brk='Y':$brk='N';
		$data = array(
			'id_sect'=>$this->input->post('id_sect'),
			'nama_mesin'=>$this->input->post('nama_mesin'),
			'prv'=>$prv,
			'brk'=>$brk,
		);
		$this->mod_mesin->insert($data);
		$this->session->set_userdata("swal","Swal.fire(
			'Mesin Berhasil Ditambah',
			'',
			'success'
		  )");
		redirect('mastermesin');
	}

	public function edit_form($id_mesin)
	{
		$data['sect']=$this->mod_sect->readpic();
		$data['mesinedit']=$this->mod_mesin->readbyid($id_mesin);
		$this->load->view('mastermesin/edit_form',$data);
	}

	public function update($id_mesin)
	{
		$this->input->post('prv')=='on'?$prv='Y':$prv='N';
		$this->input->post('brk')=='on'?$brk='Y':$brk='N';
		$data = array(
			'id_sect'=>$this->input->post('id_sect'),
			'nama_mesin'=>$this->input->post('nama_mesin'),
			'prv'=>$prv,
			'brk'=>$brk,
		);
		$this->mod_mesin->update($id_mesin,$data);
		$this->session->set_userdata("swal","Swal.fire(
			'Mesin Berhasil Diupdate',
			'',
			'success'
		  )");
		redirect('mastermesin');
	}

	public function hapus($id_mesin)
	{
		$this->mod_mesin->hapus($id_mesin);
		$this->session->set_userdata("swal","Swal.fire(
			'Mesin Berhasil Dihapus',
			'',
			'warning'
		  )");
		redirect('mastermesin');
	}
}
