<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterdept extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->load->model('mod_dept');
		$this->session->set_flashdata('judul','Master Departmen');
    }

	
	public function index()
	{
		$data['dept']=$this->mod_dept->read();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('masterdept/index',$data);
		$this->load->view('footer');
	}

	public function insert()
	{
		$data = $this->input->post();
		$this->mod_dept->insert($data);
		$this->session->set_userdata("swal","Swal.fire(
			'Department Berhasil Ditambah',
			'',
			'success'
		  )");
		redirect('masterdept');
	}

	public function edit_form($id_dept)
	{
		$data['deptedit']=$this->mod_dept->readbyid($id_dept);
		$this->load->view('masterdept/edit_form',$data);
	}

	public function update($id_dept)
	{
		$data = $this->input->post();
		$this->mod_dept->update($id_dept,$data);
		$this->session->set_userdata("swal","Swal.fire(
			'Departmen Berhasil Diupdate',
			'',
			'success'
		  )");
		redirect('masterdept');
	}

	public function hapus($id_dept)
	{
		$this->mod_dept->hapus($id_dept);
		$this->session->set_userdata("swal","Swal.fire(
			'Departmen Berhasil Dihapus',
			'',
			'warning'
		  )");
		redirect('masterdept');
	}
}
