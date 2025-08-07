<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Spkbk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_spkbk');
        $this->load->model('mod_mesin');
        $this->load->model('mod_satuan');
        $this->session->set_flashdata('judul','SPK Bengkel');
    }

    public function index()
    {
        if($this->input->post('start')=='')
        {
            $start = date("Y-m", strtotime("-1 Years"))."-01";
            $stop = date('Y-m')."-31";
            $id_mesin = "ALL";
            $data['cari']=false;
        }
        else
        {
            $start = $this->input->post('start');
            $stop = $this->input->post('stop');
            $id_mesin = $this->input->post('id_mesin');
            $data['cari']=true;
        }
        $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
		$data['spk']=$this->mod_spkbk->readbysect($this->session->userdata('id_sect'),$start,$stop,$id_mesin);
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('spkbk/index',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function index2()
    {
        
        $total_rows = $this->mod_spkbk->rows($this->session->userdata('id_sect'));//total row
		$config["base_url"] = base_url('spkbk/index'); //site url
		include "pagination_config.php"; // HARUS SELALU DISERTAKAN BERURUTAN
		$data['spk']=$this->mod_spkbk->readbysect($this->session->userdata('id_sect'),$config["per_page"], $data['page']);
       // $data['spk']=$this->mod_spkbk->readbysect($this->session->userdata('id_sect'));
        $this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('spkbk/index',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function form_edit($id_spkbk)
    {
        $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
        $data['satuan']=$this->mod_satuan->read();
        $data['id_spkbk']=$id_spkbk;
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('spkbk/edit',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }
    public function edit_spk($id_spkbk)
    {
        $res = $this->mod_spkbk->read_detail($id_spkbk);
        echo json_encode($res);
    }
    public function pdf($id_spkbk){
        
        $id_spkbk = $this->secure->decrypt($id_spkbk);
        $data['spk'] = $this->mod_spkbk->readbyid($id_spkbk);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "SPKBK-CWTD-".$id_spkbk;
        $this->pdf->load_view('spkbk/pdf', $data);
    }

    public function doprint($id_spkbk){
        
        $id_spkbk = $this->secure->decrypt($id_spkbk);
        $data['spk'] = $this->mod_spkbk->readbyid($id_spkbk);
        $this->load->view('spkbk/print',$data);
    }

    public function create()
    {
        $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
        $data['satuan']=$this->mod_satuan->read();
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('spkbk/create',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function create_temp()
    {
        $data = $this->input->post();
        $this->mod_spkbk->create_temp($data);
        $res = $this->mod_spkbk->read_temp($this->input->post('id_spkbk'));
        echo json_encode($res);
    }

    public function create_detail()
    {
        $data = $this->input->post();
        $this->mod_spkbk->create_detail($data);
        $res = $this->mod_spkbk->read_detail($this->input->post('id_spkbk'));
        echo json_encode($res);
    }

    public function del_temp($id_spkbk,$id_spkbk_temp)
    {
        $this->db->where('id_spkbk_temp',$id_spkbk_temp);
        $this->db->delete('spkbk_temp');
        $res = $this->mod_spkbk->read_temp($id_spkbk);
        echo json_encode($res);
    }

    public function del_detail($id_spkbk,$id_spkbk_detail)
    {
        $this->db->where('id_spkbk_detail',$id_spkbk_detail);
        $this->db->delete('spkbk_detail');
        $res = $this->mod_spkbk->read_detail($id_spkbk);
        echo json_encode($res);
    }


    public function edit($id_spkbk_temp)
    {
        $res = $this->mod_spkbk->read_temp_detail($id_spkbk_temp);
        echo json_encode($res);
    } 

    public function edit_detail($id_spkbk_detail)
    {
        $res = $this->mod_spkbk->read_item_detail($id_spkbk_detail);
        echo json_encode($res);
    }

    public function update_temp()
    {
        $id_spkbk = $this->input->post('id_spkbk');
        $id_spkbk_temp = $this->input->post('id_spkbk_temp');
        $data = $this->input->post();
        $this->mod_spkbk->update_temp($id_spkbk_temp,$data);
        $res = $this->mod_spkbk->read_temp($id_spkbk);
        echo json_encode($res);

    }

    public function update_detail()
    {
        $id_spkbk = $this->input->post('id_spkbk');
        $id_spkbk_detail = $this->input->post('id_spkbk_detail');
        $data = $this->input->post();
        $this->mod_spkbk->update_detail($id_spkbk_detail,$data);
        $res = $this->mod_spkbk->read_detail($id_spkbk);
        echo json_encode($res);

    }

    public function draft($id_spkbk)
    {
        $this->mod_spkbk->draft($id_spkbk);
        $this->session->set_userdata("swal","Swal.fire(
			'Draft SPK berhasil dsimpan',
			'',
			'success'
		  )");
        redirect('spkbk');
    }

    public function draft_edit($id_spkbk)
    {
        $this->mod_spkbk->draft_edit($id_spkbk);
        $this->session->set_userdata("swal","Swal.fire(
			'Draft SPK berhasil dsimpan',
			'',
			'success'
		  )");
        redirect('spkbk');
    }

    public function finish($id_spkbk)
    {
        $this->secure->level('1,2,3,4,5');
        $this->mod_spkbk->finish($id_spkbk);
        $this->session->set_userdata("swal","Swal.fire(
			'SPK berhasil dibuat',
			'',
			'success'
		  )");
        redirect('spkbk');
    }

    public function finish_edit($id_spkbk)
    {
        $this->secure->level('1,2,3,4,5');
        $this->mod_spkbk->finish_edit($id_spkbk);
        $this->session->set_userdata("swal","Swal.fire(
			'SPK berhasil di validasi dan dibuat',
			'',
			'success'
		  )");
        redirect('spkbk');
    }

    public function batal_all($id_spkbk)
    {
        $this->db->where('id_spkbk',$id_spkbk);
        $this->db->delete('spkbk_temp');
        $this->session->set_userdata("swal","Swal.fire(
			'Pembuatan SPK dibatalkan',
			'',
			'warning'
		  )");
    }

    public function del_all($id_spkbk)
    {
        $this->db->where('id_spkbk',$id_spkbk);
        $this->db->delete('spkbk_detail');
        $this->db->where('id_spkbk',$id_spkbk);
        $this->db->delete('spkbk');
        $this->session->set_userdata("swal","Swal.fire(
			'SPK No. $id_spkbk Telah Dihapus',
			'',
			'warning'
          )");
        redirect('spkbk');
    }
}

/* End of file Laporanpreventive.php */

?>