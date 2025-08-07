<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterkaryawan extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->secure->level('1,2,3');
		$this->load->model('mod_karyawan');
		$this->load->model('mod_sect');
		$this->load->model('mod_dept');
		$this->session->set_flashdata('judul','Master Karyawan');
    }

	
	public function index()
	{
		$data['dept']=$this->mod_dept->read();
		$data['sect']=$this->mod_sect->read();
		$data['karyawan']=$this->mod_karyawan->read();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('masterkaryawan/index',$data);
		$this->load->view('footer');
	}

	public function insert()
	{
		$data=$this->input->post();
		$this->mod_karyawan->insert($data);
		$this->session->set_userdata("swal","Swal.fire({
			icon: 'success',
			title: 'Berhasil Menambah Karyawan',
		  })");
		redirect('masterkaryawan');
	}

	public function edit_form($nik)
	{
		$data['dept']=$this->mod_dept->read();
		$data['sect']=$this->mod_sect->read();
		$data['karyawanedit']=$this->mod_karyawan->readbynik($nik);
		$this->load->view('masterkaryawan/edit_form',$data);
	}

	public function update($nik)
	{
		$data = $this->input->post();
		$this->mod_karyawan->update($nik,$data);
		$this->session->set_userdata("swal","Swal.fire(
			'Karyawan Berhasil Diupdate',
			'',
			'success'
		  )");
		redirect('masterkaryawan');
	}

	public function hapus($nik)
	{
		$this->mod_karyawan->hapus($nik);
		$this->session->set_userdata("swal","Swal.fire(
			'Akun Berhasil Dihapus',
			'',
			'warning'
		  )");
		redirect('masterkaryawan');
	}

	public function nonaktif($nik)
	{
		$this->mod_karyawan->nonaktif($nik);
		$this->session->set_userdata("swal","Swal.fire(
			'Akun Berhasil Dinonaktifkan',
			'',
			'warning'
		  )");
		redirect('masterkaryawan');
	}

	public function aktif($nik)
	{
		$this->mod_karyawan->aktif($nik);
		$this->session->set_userdata("swal","Swal.fire(
			'Akun Berhasil Diaktifkan',
			'',
			'success'
		  )");
		redirect('masterkaryawan');
	}

	public function resetpassword($nik)
	{
		$password = random_string('alpha',5);
		$this->mod_karyawan->resetpassword($nik,$password);
		$this->session->set_userdata("swal","Swal.fire({
			icon: 'success',
			title: 'Password Berhasil Direset',
			html: 'Password Untuk User $karyawanname Adalah: <br><div class=\"alert bg-danger\"><h5><b>$password</b></h5></div>',
		  })");
		redirect('masterkaryawan');

	}


}
