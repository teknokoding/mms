<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sga extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_sga');
        $this->load->model('mod_karyawan');
        
        $this->session->set_flashdata('judul', 'SGA/Horenso');
    }

    
    public function index()
    {
        $data['sga']=$this->mod_sga->readbysect($this->session->userdata('id_sect'));
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('sga/index', $data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function create()
    {
        $data["karyawan"]=$this->mod_karyawan->readbysect_aktif($this->session->userdata('id_sect'));
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('sga/create', $data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }
}

/* End of file Controllername.php */
