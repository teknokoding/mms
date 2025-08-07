<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterpaket extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->load->model('mod_paket');
		$this->load->model('mod_mesin');
		$this->load->model('mod_durasi');
		$this->session->set_flashdata('judul','Master Paket Rawat');
    }

	
	public function index()
	{
		$data['paket']=$this->mod_paket->readbysect($this->session->userdata('id_sect'));
		$data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
		$data['durasi']=$this->mod_durasi->read();
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('masterpaket/index',$data);
		$this->load->view('footer');
	}

	public function cek_kode($kode_cl)
	{
		$query = $this->db->query("SELECT * FROM checklist WHERE kode_cl='$kode_cl'");
		$num = $query->num_rows();
		if($num>0)
		{
			echo"<div class='badge badge-danger'>Kode Sudah Tersedia !!</div>
			<script>$('#simpan').prop('disabled',true);</script>";
		}
		else
		{
			echo "<script>$('#simpan').prop('disabled',false);</script>";        
		}
	}

	public function insert()
	{
		$id_mesin = $this->input->post('id_mesin');
		$kode_durasi = $this->input->post('kode_durasi');
		$kode_cl = $id_mesin.'_'.$kode_durasi;
		$data = array(
			'id_mesin'=>$id_mesin,
			'kode_durasi'=>$kode_durasi,
			'kode_cl'=>$kode_cl,
			'note_cl'=>$this->input->post('note_cl'),
			'id_sect'=>$this->session->userdata('id_sect'),
		);
	$this->load->library('upload'); // Load librari upload
    $config['upload_path'] = './assets/isodoc';
    $config['allowed_types'] = 'pdf';
    $config['max_size']  = '2048';
	$config['overwrite'] = true;
	$config['file_name'] = $kode_cl.".pdf";
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('dokumen_cl')){ // Lakukan upload dan Cek jika proses upload berhasil
	  // Jika berhasil :
	  $this->mod_paket->insert($data);
      $this->session->set_userdata("swal","Swal.fire(
		'Paket Rawat Berhasil Ditambah',
		'',
		'success'
	  )");
	redirect('masterpaket');
    }else{
		$this->session->set_userdata("swal","Swal.fire(
			'Upload dokumen tidak berhasil',
			'',
			'error'
		  )");
	redirect('masterpaket');
    }
		
	}

	public function edit_form($id_cl)
	{
		$data['paketedit']=$this->mod_paket->readbyid($id_cl);
		$data['mesinedit']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
		$data['durasiedit']=$this->mod_durasi->read();
		$this->load->view('masterpaket/edit_form',$data);
	}

	public function update($id_cl)
	{
		$id_mesin = $this->input->post('id_mesin');
		$kode_durasi = $this->input->post('kode_durasi');
		$kode_cl = $id_mesin.'_'.$kode_durasi;
		$data = array(
			'id_mesin'=>$id_mesin,
			'kode_durasi'=>$kode_durasi,
			'kode_cl'=>$kode_cl,
			'note_cl'=>$this->input->post('note_cl'),
			'id_sect'=>$this->session->userdata('id_sect'),
		);
		
	if($_FILES['dokumen_cl']['name']!="")	
	{
	$this->load->library('upload'); // Load librari upload
    $config['upload_path'] = './assets/isodoc';
    $config['allowed_types'] = 'pdf';
    $config['max_size']  = '2048';
	$config['overwrite'] = true;
	$config['file_name'] = $kode_cl.".pdf";
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('dokumen_cl')){ // Lakukan upload dan Cek jika proses upload berhasil
	  // Jika berhasil :
	  $this->mod_paket->update($id_cl,$data);
      $this->session->set_userdata("swal","Swal.fire(
		'Dokumen Checklist Berhasil Di Upload',
		'',
		'success'
	  )");
	redirect('masterpaket');
    }else{
		$this->session->set_userdata("swal","Swal.fire(
			'Upload dokumen tidak berhasil',
			'',
			'error'
		  )");
	redirect('masterpaket');
    }
		}
		else
		{
		$this->mod_paket->update($id_cl,$data);
		$this->session->set_userdata("swal","Swal.fire(
			'Paket Rawat Berhasil Diupdate',
			'',
			'success'
		  )");
		redirect('masterpaket');
		}
	}

	public function hapus($id_cl,$kode_cl)
	{
		$this->mod_paket->hapus($id_cl,$kode_cl);
		$this->session->set_userdata("swal","Swal.fire(
			'Paket Rawat Berhasil Dihapus',
			'',
			'warning'
		  )");
		redirect('masterpaket');
	}
}
