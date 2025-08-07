<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tpm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_lkh');
        $this->load->model('mod_mesin');
        $this->load->model('mod_karyawan');
        $this->load->model('mod_user');
        $this->load->model('mod_tpm');
        $this->session->set_flashdata('judul', 'Total Productive Maintenance');
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('sidebar');
        $data['tpm'] = $this->mod_tpm->read_mesin($this->session->userdata('id_sect'));
        $data['mesin'] = $this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
        $this->load->view('tpm/index', $data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function riwayat($id_tag)
    {
        $data['riwayat']=$this->mod_tpm->readbyid($id_tag);
        $this->load->view('tpm/riwayat', $data);
    }
    public function riwayat2($id_tag)
    {
        $data['riwayat']=$this->mod_tpm->readbyid($id_tag);
        $this->load->view('tpm2/riwayat', $data);
    }

    public function release($id_tag)
    {
        $data['karyawan']=$this->mod_karyawan->readbysect_aktif($this->session->userdata('id_sect'));
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
        $this->mod_tpm->do_release($data, $id_tag, $this->input->post('rel_stat'));
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
}
