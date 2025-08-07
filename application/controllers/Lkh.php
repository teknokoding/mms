<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lkh extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
		$this->load->model('mod_lkh');
		$this->load->model('mod_mesin');
		$this->load->model('mod_karyawan');
		$this->load->model('mod_user');
		$this->session->set_flashdata('judul','Laporan Harian');
    }

	public function index()
	{
		
		if($this->input->post('start')!="")
		{
			$data['cari']=true;
			$total_rows = $this->mod_lkh->rows_search($this->session->userdata('id_sect'),$this->input->post('start'),$this->input->post('stop'),$this->input->post('id_mesin'));//total row
			$config["base_url"] = base_url('lkh/index'); //site url
			include "pagination_config.php"; // HARUS SELALU DISERTAKAN BERURUTAN
			$data['lkh'] = $this->mod_lkh->read_search($this->session->userdata('id_sect'),$this->input->post('start'),$this->input->post('stop'),$this->input->post('id_mesin'),$config["per_page"], $data['page']);
		}
		else
		{
			$data['cari']=false;
			$total_rows = $this->mod_lkh->rows($this->session->userdata('id_sect'));//total row
			$config["base_url"] = base_url('lkh/index'); //site url
			include "pagination_config.php"; // HARUS SELALU DISERTAKAN BERURUTAN
			$data['lkh'] = $this->mod_lkh->read($this->session->userdata('id_sect'),$config["per_page"], $data['page']);
		}
		
		
        $this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['mesin'] = $this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('lkh/lkh',$data);
		$this->load->view('control-sidebar');
		$this->load->view('footer');
	}

	// DETAIL ===========================================
	public function detail($id_lkh)
	{
		$lkh = $this->mod_lkh->readdetail($id_lkh);
		foreach ($lkh as $item) {
			$data["pelaksana1"] = $this->mod_karyawan->readnamabynik($item->pelaksana1);
			$data["pelaksana2"] = $this->mod_karyawan->readnamabynik($item->pelaksana2);
			$data["pelaksana3"] = $this->mod_karyawan->readnamabynik($item->pelaksana3);
			$data["pelaksana4"] = $this->mod_karyawan->readnamabynik($item->pelaksana4);
			$data["pelaksana5"] = $this->mod_karyawan->readnamabynik($item->pelaksana5);
			$data["pelaksana6"] = $this->mod_karyawan->readnamabynik($item->pelaksana6);
			$data["pengisilaporan"] = $this->mod_user->readnamabyusername($item->pengisilaporan);
			$data["nama_acc"] =  $this->mod_user->readnamabyusername($item->acc);
		}
		$data['lkh']=$lkh;
		$this->load->view('lkh/lkhdetail',$data);
	}

	// FORM INPUT LKH BARU  ===========================================
	public function create()
	{
		$data['mesin'] = $this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
		$data['karyawan']=$this->mod_karyawan->readbysect_aktif($this->session->userdata('id_sect'));
		$data['user']=$this->mod_user->readbysect_aktif($this->session->userdata('id_sect'));
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('lkh/create',$data);
		$this->load->view('control-sidebar');
		$this->load->view('footer');
		
	}

	// FORM INPUT LKH LANJUTAN  ===========================================
	public function createnext($reff_id)
	{
		$data['mesin'] = $this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
		$data['karyawan']=$this->mod_karyawan->readbysect_aktif($this->session->userdata('id_sect'));
		$data['user']=$this->mod_user->readbysect_aktif($this->session->userdata('id_sect'));
		$data['reff_id']=$reff_id;
		$data['lkh']=$this->mod_lkh->readbyreffid($reff_id);
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('lkh/createnext',$data);
		$this->load->view('control-sidebar');
		$this->load->view('footer');
		
	}

	

	// EKSEKUSI INPUT LKH  ===========================================
	public function input()
	{
		if($this->input->post('status')!="OK")
		{
			$finish=0;
			if(empty($this->input->post('reff_id')))
			{
				$reff_id=random_string('alnum',8);
			}
			else
			{
				$reff_id = $this->input->post('reff_id');
			}
		}
		else
		{
			$finish=1;
			if(empty($this->input->post('reff_id')))
			{
				$reff_id="";
			}
			else
			{
				$reff_id = $this->input->post('reff_id');
				$this->mod_lkh->updatelanjutan($reff_id,$finish);

			}	
			
		}
		$data = array(
			'finish'=>$finish,
			'reff_id'=>$reff_id,
			'id_sect'=>$this->input->post('id_sect'),
			'id_dept'=>$this->input->post('id_dept'),
			'jenislkh'=>$this->input->post('jenislkh'),
			'tgllkh'=>$this->input->post('tgllkh'),
			'shift'=>$this->input->post('shift'),
			'id_mesin'=>$this->input->post('id_mesin'),
			'id_unit_mesin'=>$this->input->post('id_unit_mesin'),
			'detail'=>$this->input->post('detail'),
			'keluhan'=>$this->input->post('keluhan'),
			'uraian'=>$this->input->post('uraian'),
			'status'=>$this->input->post('status'),
			'waktumulai'=>$this->input->post('waktumulai'),
			'waktuselesai'=>$this->input->post('waktuselesai'),
			'pengisilaporan'=>$this->input->post('pengisilaporan'),
			'pelaksana1'=>$this->input->post('pelaksana[0]'),
			'pelaksana2'=>$this->input->post('pelaksana[1]'),
			'pelaksana3'=>$this->input->post('pelaksana[2]'),
			'pelaksana4'=>$this->input->post('pelaksana[3]'),
			'pelaksana5'=>$this->input->post('pelaksana[4]'),
			'pelaksana6'=>$this->input->post('pelaksana[5]'),
		);
		
		$this->mod_lkh->input($data);
		redirect('lkh');
	}

	
	
	// FORM EDIT LKH ===========================================
	public function edit($id_lkh)
	{
		$data['mesin'] = $this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
		$data['karyawan']=$this->mod_karyawan->readbysect_aktif($this->session->userdata('id_sect'));
		$data['user']=$this->mod_user->readbysect_aktif($this->session->userdata('id_sect'));
		$data['lkh'] = $this->mod_lkh->readdetail($id_lkh);
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('lkh/edit',$data);
		$this->load->view('control-sidebar');
		$this->load->view('footer');
		
	}

	// EKSEKUSI EDIT LKH / UPDATE ===========================================
	public function update($id_lkh)
	{
		if($this->input->post('status')!="OK")
		{
			$finish=0;
			if(empty($this->input->post('reff_id')))
			{
				$reff_id=random_string('alnum',8);
			}
			else
			{
				$reff_id = $this->input->post('reff_id');
				$this->mod_lkh->updatelanjutan($reff_id,$finish);
			}
		}
		else
		{
			$finish=1;
			if(empty($this->input->post('reff_id')))
			{
				$reff_id="";
			}
			else
			{
				$reff_id = $this->input->post('reff_id');
				$this->mod_lkh->updatelanjutan($reff_id,$finish);

			}	
			
		}
		
		$data = array(
			'finish'=>$finish,
			'reff_id'=>$reff_id,
			'jenislkh'=>$this->input->post('jenislkh'),
			'tgllkh'=>$this->input->post('tgllkh'),
			'shift'=>$this->input->post('shift'),
			'id_mesin'=>$this->input->post('id_mesin'),
			'id_unit_mesin'=>$this->input->post('id_unit_mesin'),
			'detail'=>$this->input->post('detail'),
			'keluhan'=>$this->input->post('keluhan'),
			'uraian'=>$this->input->post('uraian'),
			'status'=>$this->input->post('status'),
			'waktumulai'=>$this->input->post('waktumulai'),
			'waktuselesai'=>$this->input->post('waktuselesai'),
			'pengisilaporan'=>$this->input->post('pengisilaporan'),
			'pelaksana1'=>$this->input->post('pelaksana[0]'),
			'pelaksana2'=>$this->input->post('pelaksana[1]'),
			'pelaksana3'=>$this->input->post('pelaksana[2]'),
			'pelaksana4'=>$this->input->post('pelaksana[3]'),
			'pelaksana5'=>$this->input->post('pelaksana[4]'),
			'pelaksana6'=>$this->input->post('pelaksana[5]'),
			'acc'=>""
		);
		
		$this->mod_lkh->update($data,$id_lkh);
		
		$this->session->set_userdata("swal","Swal.fire(
			'Data Berhasil Diupdate',
			'',
			'success'
		  )");
		redirect('lkh');
	}

	// HAPUS LKH ===========================================
	public function delete($id_lkh)
	{
		$this->mod_lkh->delete($id_lkh);
		$this->session->set_userdata("swal","Swal.fire(
			'Data LKH berhasil dihapus',
			'',
			'error'
		  )");
		redirect('lkh');
	}

	public function acc($id_lkh)
	{
		$this->secure->level('4,5');
		$this->mod_lkh->acc($id_lkh,$this->session->userdata('username'));
	}
}
