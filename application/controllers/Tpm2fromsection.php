<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tpm2fromsection extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_sect');
        $this->load->model('mod_mesin');
        $this->load->model('mod_karyawan');
        $this->load->model('mod_user');
        $this->load->model('mod_tpm2');
        $this->session->set_flashdata('judul', 'Tag Dari Unit Anda');
    }
    
    public function index()
    {
        $this->load->view('header_tpm');
        $this->load->view('sidebar_tpm');
        $data['sect']=$this->mod_sect->readpic();
        $data['tpm'] = $this->mod_tpm2->read_mesin_fromsect($this->session->userdata('id_sect'));
        $data['mesin'] = $this->mod_mesin->readbysect($this->session->userdata('id_sect'));
        $data['karyawan'] = $this->mod_karyawan->readbysect_aktif($this->session->userdata('id_sect'));
        $this->load->view('tpm2/fromsection', $data);
        $this->load->view('footer');
    }

    public function riwayat($id_tag)
    {
        $data['riwayat']=$this->mod_tpm2->readbyid($id_tag);
        $this->load->view('tpm/riwayat', $data);
    }

    public function release($id_tag)
    {
        $data['karyawan']=$this->mod_karyawan->readbysect($this->session->userdata('id_sect'));
        $data['id_tag']=$id_tag;
        $this->load->view('tpm/release', $data);
    }

    public function do_release($id_tag)
    {
        $data = array(
            'tgl_rel' => $this->input->post('tgl_rel'),
            'action' => $this->input->post('action'),
            'rel_stat' => $this->input->post('rel_stat'),
            'id_tag'=>$id_tag,
            'pelaksana1'=>$this->input->post('pelaksana[0]'),
            'pelaksana2'=>$this->input->post('pelaksana[1]'),
            'pelaksana3'=>$this->input->post('pelaksana[2]'),
            'pelaksana4'=>$this->input->post('pelaksana[3]'),
            'pelaksana5'=>$this->input->post('pelaksana[4]'),
            'pelaksana6'=>$this->input->post('pelaksana[5]'),
            'input_by'=>$this->session->userdata('username'),
        );
        $this->mod_tpm2->do_release($data, $id_tag, $this->input->post('rel_stat'));
        $this->session->set_userdata("swal", "Swal.fire(
			'TAG berhasil di release',
			'',
			'success'
		  )");
        redirect('tpm');
    }

    public function set_mesin($id_mesin)
    {
        $this->session->set_userdata('id_mesin', $id_mesin);
    }
    public function readdeptbysect($id_sect)
    {
        $data = $this->mod_sect->readbyid($id_sect);
        echo json_encode($data);
    }
    public function readdetail($id_tag)
    {
        $data = $this->mod_tpm2->readdetail($id_tag);
        echo json_encode($data);
    }
    public function create()
    {
        $data = $this->input->post();
        $this->mod_tpm2->create($data);
        $this->session->set_userdata("swal", "Swal.fire(
			'TAG berhasil dibuat',
			'',
			'success'
		  )");
        redirect('tpm2fromsection');
    }
    public function update($id_tag)
    {
        $data = $this->input->post();
        $this->mod_tpm2->update($data, $id_tag);
        $this->session->set_userdata("swal", "Swal.fire(
			'TAG berhasil diupdate',
			'',
			'success'
		  )");
        redirect('tpm2fromsection');
    }
    public function delete($id_tag)
    {
        $this->mod_tpm2->delete($id_tag);
        $this->session->set_userdata("swal", "Swal.fire(
			'TAG telah dihapus',
			'',
			'warning'
		  )");
        redirect('tpm2fromsection');
    }
}
