<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class sjrekanan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_sjrekanan');
        $this->load->model('mod_relasi');
        $this->load->model('mod_mesin');
        $this->load->model('mod_satuan');
        $this->session->set_flashdata('judul','Surat Jalan Rekanan');
        
    }

    public function index()
    {
        if($this->input->post('start')=='')
        {
            $start = date("Y-m", strtotime("-1 Years"))."-01";
            $stop = date('Y-m')."-31";
            $id_relasi = "ALL";
        }
        else
        {
            $start = $this->input->post('start');
            $stop = $this->input->post('stop');
            $id_relasi = $this->input->post('id_relasi');
        }
        $data['relasi']=$this->mod_relasi->read();
		$data['sjrekanan']=$this->mod_sjrekanan->readbysect($this->session->userdata('id_sect'),$start,$stop,$id_relasi);
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjrekanan/index',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function index2()
    {
        
        $total_rows = $this->mod_sjrekanan->rows($this->session->userdata('id_sect'));//total row
		$config["base_url"] = base_url('sjrekanan/index'); //site url
		include "pagination_config.php"; // HARUS SELALU DISERTAKAN BERURUTAN
		$data['sjrekanan']=$this->mod_sjrekanan->readbysect($this->session->userdata('id_sect'),$config["per_page"], $data['page']);
       // $data['sjrekanan']=$this->mod_sjrekanan->readbysect($this->session->userdata('id_sect'));
        $this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjrekanan/index',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function form_edit($id_lain)
    {
        $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
        $data['satuan']=$this->mod_satuan->read();
        $data['relasi']=$this->mod_relasi->read();
        $data['id_lain']=$id_lain;
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjrekanan/edit',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }
    public function edit_sjrekanan($id_lain)
    {
        $res = $this->mod_sjrekanan->read_detail($id_lain);
        echo json_encode($res);
    }
    public function pdf($id_lain){
        
        $id_lain = $this->secure->decrypt($id_lain);
        $data['sjrekanan'] = $this->mod_sjrekanan->readbyid($id_lain);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "lain-CWTD-".$id_lain;
        $this->pdf->load_view('sjrekanan/pdf', $data);
    }
    public function doprint($id_lain){
        
        $id_lain = $this->secure->decrypt($id_lain);
        $data['sjrekanan'] = $this->mod_sjrekanan->readbyid($id_lain);
        $this->load->view('sjrekanan/print', $data);
    }

    public function create()
    {
        $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
        $data['satuan']=$this->mod_satuan->read();
        $data['relasi']=$this->mod_relasi->read();
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjrekanan/create',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function create_temp()
    {
        $data = $this->input->post();
        $this->mod_sjrekanan->create_temp($data);
        $res = $this->mod_sjrekanan->read_temp($this->input->post('id_lain'));
        echo json_encode($res);
    }

    public function create_detail()
    {
        $data = $this->input->post();
        $this->mod_sjrekanan->create_detail($data);
        $res = $this->mod_sjrekanan->read_detail($this->input->post('id_lain'));
        echo json_encode($res);
    }

    public function del_temp($id_lain,$id_lain_temp)
    {
        $this->db->where('id_lain_temp',$id_lain_temp);
        $this->db->delete('lain_temp');
        $res = $this->mod_sjrekanan->read_temp($id_lain);
        echo json_encode($res);
    }

    public function del_detail($id_lain,$id_lain_detail)
    {
        $this->db->where('id_lain_detail',$id_lain_detail);
        $this->db->delete('lain_detail');
        $res = $this->mod_sjrekanan->read_detail($id_lain);
        echo json_encode($res);
    }


    public function edit($id_lain_temp)
    {
        $res = $this->mod_sjrekanan->read_temp_detail($id_lain_temp);
        echo json_encode($res);
    } 

    public function edit_detail($id_lain_detail)
    {
        $res = $this->mod_sjrekanan->read_item_detail($id_lain_detail);
        echo json_encode($res);
    }

    public function update_temp()
    {
        $id_lain = $this->input->post('id_lain');
        $id_lain_temp = $this->input->post('id_lain_temp');
        $data = $this->input->post();
        $this->mod_sjrekanan->update_temp($id_lain_temp,$data);
        $res = $this->mod_sjrekanan->read_temp($id_lain);
        echo json_encode($res);

    }

    public function update_detail()
    {
        $id_lain = $this->input->post('id_lain');
        $id_lain_detail = $this->input->post('id_lain_detail');
        $data = $this->input->post();
        $this->mod_sjrekanan->update_detail($id_lain_detail,$data);
        $res = $this->mod_sjrekanan->read_detail($id_lain);
        echo json_encode($res);

    }

    

    public function finish($id_lain,$id_relasi)
    {
        $this->mod_sjrekanan->finish($id_lain,$id_relasi);
        $this->session->set_userdata("swal","Swal.fire(
			'Surat Jalan berhasil dibuat',
			'',
			'success'
		  )");
    }

    public function finish_edit($id_lain,$id_relasi)
    {
        $this->mod_sjrekanan->finish_edit($id_lain,$id_relasi);
        $this->session->set_userdata("swal","Swal.fire(
			'Surat Jalan berhasil di simpan',
			'',
			'success'
		  )");
    }

    public function batal_all($id_lain)
    {
        $this->db->where('id_lain',$id_lain);
        $this->db->delete('lain_temp');
        $this->session->set_userdata("swal","Swal.fire(
			'Pembuatan Surat Jalan dibatalkan',
			'',
			'warning'
		  )");
    }

    public function del_all($id_lain)
    {
        $this->db->where('id_lain',$id_lain);
        $this->db->delete('lain_detail');
        $this->db->where('id_lain',$id_lain);
        $this->db->delete('lain');
        $this->session->set_userdata("swal","Swal.fire(
			'Surat Jalan No. $id_lain Telah Dihapus',
			'',
			'warning'
          )");
        redirect('sjrekanan');
    }
}

/* End of file Laporanpreventive.php */

?>