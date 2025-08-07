<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterakun extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->load->model('mod_akun');
		$this->load->model('mod_sect');
		$this->load->model('mod_dept');
		$this->load->model('mod_level');
		$this->session->set_flashdata('judul','Master Akun');
    }

	
	public function index()
	{
		$data['dept']=$this->mod_dept->read();
		$data['sect']=$this->mod_sect->read();
		$data['user']=$this->mod_akun->read();
		$data['level']=$this->mod_level->read();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('masterakun/index',$data);
		$this->load->view('footer');
	}

	public function insert($password)
	{
		$data=$this->input->post();
		$username =$this->input->post('username');
		$this->mod_akun->insert($data);
		$this->session->set_userdata("swal","Swal.fire({
			icon: 'success',
			title: 'Akun Berhasil Dibuat',
			html: 'Password Untuk User $username Adalah: <br><div class=\"alert bg-danger\"><h5><b>$password</b></h5></div>',
		  })");
		redirect('masterakun');
	}

	public function edit_form($iduser)
	{
		$data['dept']=$this->mod_dept->read();
		$data['sect']=$this->mod_sect->read();
		$data['level']=$this->mod_level->read();
		$data['akunedit']=$this->mod_akun->readbyid($iduser);
		$this->load->view('masterakun/edit_form',$data);
	}

	public function update($iduser)
	{
		$data = $this->input->post();
		$this->mod_akun->update($iduser,$data);
		$this->session->set_userdata("swal","Swal.fire(
			'Akun Berhasil Diupdate',
			'',
			'success'
		  )");
		redirect('masterakun');
	}

	public function hapus($iduser)
	{
		$this->mod_akun->hapus($iduser);
		$this->session->set_userdata("swal","Swal.fire(
			'Akun Berhasil Dihapus',
			'',
			'warning'
		  )");
		redirect('masterakun');
	}

	public function nonaktif($iduser)
	{
		$this->mod_akun->nonaktif($iduser);
		$this->session->set_userdata("swal","Swal.fire(
			'Akun Berhasil Dinonaktifkan',
			'',
			'warning'
		  )");
		redirect('masterakun');
	}

	public function aktif($iduser)
	{
		$this->mod_akun->aktif($iduser);
		$this->session->set_userdata("swal","Swal.fire(
			'Akun Berhasil Diaktifkan',
			'',
			'success'
		  )");
		redirect('masterakun');
	}

	public function resetpassword($iduser)
	{
		$password = random_string('alpha',5);
		$this->mod_akun->resetpassword($iduser,$password);
		$this->session->set_userdata("swal","Swal.fire({
			icon: 'success',
			title: 'Password Berhasil Direset',
			html: 'Password Untuk User $username Adalah: <br><div class=\"alert bg-danger\"><h5><b>$password</b></h5></div>',
		  })");
		redirect('masterakun');

	}


}
