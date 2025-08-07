<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class sjreform extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_sjreform');
        $this->load->model('mod_pisau');
        $this->load->model('mod_klien');
        $this->session->set_flashdata('judul','Surat Jalan Pisau');
    }
    public function index()
    {
        if($this->input->post('start')=='')
        {
            $start = date("Y-m", strtotime("-1 Years"))."-01";
            $stop = date('Y-m')."-31";
            $id_klien = "ALL";
        }
        else
        {
            $start = $this->input->post('start');
            $stop = $this->input->post('stop');
            $id_klien = $this->input->post('id_klien');
        }
        $data['klien']=$this->mod_klien->read();
		$data['sjreform']=$this->mod_sjreform->read($start,$stop,$id_klien);
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjreform/index',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }
    public function index2()
    {
        
        $total_rows = $this->mod_sjreform->rows($this->session->userdata('id_sect'));//total row
		$config["base_url"] = base_url('sjreform/index'); //site url
		include "pagination_config.php"; // HARUS SELALU DISERTAKAN BERURUTAN
		$data['sjreform']=$this->mod_sjreform->readbysect($this->session->userdata('id_sect'),$config["per_page"], $data['page']);
       // $data['sjreform']=$this->mod_sjreform->readbysect($this->session->userdata('id_sect'));
        $this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjreform/index',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function form_edit($id_reform)
    {
        $data['pisau']=$this->mod_pisau->read();
        $data['klien']=$this->mod_klien->read();
        $data['id_reform']=$id_reform;
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjreform/edit',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }
    public function edit_sjreform($id_reform)
    {
        $res = $this->mod_sjreform->read_detail($id_reform);
        echo json_encode($res);
    }
    public function pdf($id_reform){
        
        $id_reform = $this->secure->decrypt($id_reform);
        $data['sjreform'] = $this->mod_sjreform->readbyid($id_reform);
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "reform-CWTD-".$id_reform;
        $this->pdf->load_view('sjreform/pdf', $data);
    }

    public function doprint($id_reform){
        
        $id_reform = $this->secure->decrypt($id_reform);
        $data['sjreform'] = $this->mod_sjreform->readbyid($id_reform);
        $this->load->view('sjreform/print', $data);
    }

    public function create()
    {
        $data['pisau']=$this->mod_pisau->read($this->session->userdata('id_sect'));
        $data['klien']=$this->mod_klien->read();
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('sjreform/create',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function create_temp()
    {
        $data = $this->input->post();
        $this->mod_sjreform->create_temp($data);
        $res = $this->mod_sjreform->read_temp($this->input->post('id_reform'));
        echo json_encode($res);
    }

    public function create_detail()
    {
        $data = $this->input->post();
        $this->mod_sjreform->create_detail($data);
        $res = $this->mod_sjreform->read_detail($this->input->post('id_reform'));
        echo json_encode($res);
    }

    public function del_temp($id_reform,$id_reform_temp)
    {
        $this->db->where('id_reform_temp',$id_reform_temp);
        $this->db->delete('reform_temp');
        $res = $this->mod_sjreform->read_temp($id_reform);
        echo json_encode($res);
    }

    public function del_detail($id_reform,$id_reform_detail)
    {
        $this->db->where('id_reform_detail',$id_reform_detail);
        $this->db->delete('reform_detail');
        $res = $this->mod_sjreform->read_detail($id_reform);
        echo json_encode($res);
    }


    public function edit($id_reform_temp)
    {
        $res = $this->mod_sjreform->read_temp_detail($id_reform_temp);
        echo json_encode($res);
    } 

    public function edit_detail($id_reform_detail)
    {
        $res = $this->mod_sjreform->read_item_detail($id_reform_detail);
        echo json_encode($res);
    }

    public function update_temp()
    {
        $id_reform = $this->input->post('id_reform');
        $id_reform_temp = $this->input->post('id_reform_temp');
        $data = $this->input->post();
        $this->mod_sjreform->update_temp($id_reform_temp,$data);
        $res = $this->mod_sjreform->read_temp($id_reform);
        echo json_encode($res);

    }

    public function update_detail()
    {
        $id_reform = $this->input->post('id_reform');
        $id_reform_detail = $this->input->post('id_reform_detail');
        $data = $this->input->post();
        $this->mod_sjreform->update_detail($id_reform_detail,$data);
        $res = $this->mod_sjreform->read_detail($id_reform);
        echo json_encode($res);

    }

    

    public function finish($id_reform,$id_klien)
    {
        $this->mod_sjreform->finish($id_reform,$id_klien);
        $this->session->set_userdata("swal","Swal.fire(
			'Surat Jalan berhasil dibuat',
			'',
			'success'
		  )");
    }

    public function finish_edit($id_reform,$id_klien)
    {
        $this->mod_sjreform->finish_edit($id_reform,$id_klien);
        $this->session->set_userdata("swal","Swal.fire(
			'Surat Jalan berhasil disimpan',
			'',
			'success'
		  )");
    }

    public function batal_all($id_reform)
    {
        $this->db->where('id_reform',$id_reform);
        $this->db->delete('reform_temp');
        $this->session->set_userdata("swal","Swal.fire(
			'Pembuatan Surat Jalan dibatalkan',
			'',
			'warning'
		  )");
    }

    public function del_all($id_reform)
    {
        $this->db->where('id_reform',$id_reform);
        $this->db->delete('reform_detail');
        $this->db->where('id_reform',$id_reform);
        $this->db->delete('reform');
        $this->session->set_userdata("swal","Swal.fire(
			'Surat Jalan No. $id_reform Telah Dihapus',
			'',
			'warning'
          )");
        redirect('sjreform');
    }
}

/* End of file Laporanpreventive.php */

?>