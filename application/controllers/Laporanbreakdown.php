<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporanbreakdown extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_mesin');
        $this->load->model('mod_lkh');
        $this->session->set_flashdata('judul', 'Laporan Breakdown');
    }

    public function index()
    {
        $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('laporan/breakdown', $data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function searchdata()
    {
        $data=$this->mod_lkh->readbreakdown_range($this->input->post('start_cl'), $this->input->post('stop_cl'), $this->input->post('id_mesin'));
        echo json_encode($data);
    }
}

/* End of file Laporanpreventive.php */
