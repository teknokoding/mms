<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class sjbk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_sjbk');
        $this->load->model('mod_mesin');
        $this->load->model('mod_satuan');
        $this->session->set_flashdata('judul','Surat Jalan Bengkel');
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
		$data['sjbk']=$this->mod_sjbk->readbysect($this->session->userdata('id_sect'),$start,$stop,$id_mesin);
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjbk/index',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function index2()
    {
        
        $total_rows = $this->mod_sjbk->rows($this->session->userdata('id_sect'));//total row
		$config["base_url"] = base_url('sjbk/index'); //site url
		include "pagination_config.php"; // HARUS SELALU DISERTAKAN BERURUTAN
		$data['sjbk']=$this->mod_sjbk->readbysect($this->session->userdata('id_sect'),$config["per_page"], $data['page']);
       // $data['sjbk']=$this->mod_sjbk->readbysect($this->session->userdata('id_sect'));
        $this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjbk/index',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function form_edit($id_bengkel)
    {
        $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
        $data['satuan']=$this->mod_satuan->read();
        $data['id_bengkel']=$id_bengkel;
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjbk/edit',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }
    public function edit_sjbk($id_bengkel)
    {
        $res = $this->mod_sjbk->read_detail($id_bengkel);
        echo json_encode($res);
    }
    public function pdf($id_bengkel){
        
        $id_bengkel = $this->secure->decrypt($id_bengkel);
        $data['sjbk'] = $this->mod_sjbk->readbyid($id_bengkel);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "bengkel-CWTD-".$id_bengkel;
        $this->pdf->load_view('sjbk/pdf', $data);
    }

    public function doprint($id_bengkel){
        
        $id_bengkel = $this->secure->decrypt($id_bengkel);
        $data['sjbk'] = $this->mod_sjbk->readbyid($id_bengkel);
        $this->load->view('sjbk/print', $data);
    }

    public function create()
    {
        $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
        $data['satuan']=$this->mod_satuan->read();
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjbk/create',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function create_temp()
    {
        $data = $this->input->post();
        $this->mod_sjbk->create_temp($data);
        $res = $this->mod_sjbk->read_temp($this->input->post('id_bengkel'));
        echo json_encode($res);
    }

    public function create_detail()
    {
        $data = $this->input->post();
        $this->mod_sjbk->create_detail($data);
        $res = $this->mod_sjbk->read_detail($this->input->post('id_bengkel'));
        echo json_encode($res);
    }

    public function del_temp($id_bengkel,$id_bengkel_temp)
    {
        $this->db->where('id_bengkel_temp',$id_bengkel_temp);
        $this->db->delete('bengkel_temp');
        $res = $this->mod_sjbk->read_temp($id_bengkel);
        echo json_encode($res);
    }

    public function del_detail($id_bengkel,$id_bengkel_detail)
    {
        $this->db->where('id_bengkel_detail',$id_bengkel_detail);
        $this->db->delete('bengkel_detail');
        $res = $this->mod_sjbk->read_detail($id_bengkel);
        echo json_encode($res);
    }


    public function edit($id_bengkel_temp)
    {
        $res = $this->mod_sjbk->read_temp_detail($id_bengkel_temp);
        echo json_encode($res);
    } 

    public function edit_detail($id_bengkel_detail)
    {
        $res = $this->mod_sjbk->read_item_detail($id_bengkel_detail);
        echo json_encode($res);
    }

    public function update_temp()
    {
        $id_bengkel = $this->input->post('id_bengkel');
        $id_bengkel_temp = $this->input->post('id_bengkel_temp');
        $data = $this->input->post();
        $this->mod_sjbk->update_temp($id_bengkel_temp,$data);
        $res = $this->mod_sjbk->read_temp($id_bengkel);
        echo json_encode($res);

    }

    public function update_detail()
    {
        $id_bengkel = $this->input->post('id_bengkel');
        $id_bengkel_detail = $this->input->post('id_bengkel_detail');
        $data = $this->input->post();
        $this->mod_sjbk->update_detail($id_bengkel_detail,$data);
        $res = $this->mod_sjbk->read_detail($id_bengkel);
        echo json_encode($res);

    }

    

    public function finish($id_bengkel)
    {
        //$this->secure->level('1,2,3,4,5');
        $this->mod_sjbk->finish($id_bengkel);
        $this->session->set_userdata("swal","Swal.fire(
			'Surat Jalan berhasil dibuat',
			'',
			'success'
		  )");
        redirect('sjbk');
    }

    public function finish_edit($id_bengkel)
    {
        //$this->secure->level('1,2,3,4,5');
        $this->mod_sjbk->finish_edit($id_bengkel);
        $this->session->set_userdata("swal","Swal.fire(
			'Surat Jalan berhasil di simpan',
			'',
			'success'
		  )");
        redirect('sjbk');
    }

    public function batal_all($id_bengkel)
    {
        $this->db->where('id_bengkel',$id_bengkel);
        $this->db->delete('bengkel_temp');
        $this->session->set_userdata("swal","Swal.fire(
			'Pembuatan Surat Jalan dibatalkan',
			'',
			'warning'
		  )");
    }

    public function del_all($id_bengkel)
    {
        $this->db->where('id_bengkel',$id_bengkel);
        $this->db->delete('bengkel_detail');
        $this->db->where('id_bengkel',$id_bengkel);
        $this->db->delete('bengkel');
        $this->session->set_userdata("swal","Swal.fire(
			'Surat Jalan No. $id_bengkel Telah Dihapus',
			'',
			'warning'
          )");
        redirect('sjbk');
    }
}

/* End of file Laporanpreventive.php */

?>