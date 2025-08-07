<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanpreventive extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->secure->auth();
        $this->load->model('mod_preventive');
        $this->load->model('mod_karyawan');
        $this->load->model('mod_mesin');
        $this->load->model('mod_paket');
        $this->session->set_flashdata('judul','Laporan Preventive Maintenance');
        
    }

    public function index()
    {
        
        $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
        $this->load->view('header');
		$this->load->view('sidebar');
        $this->load->view('laporan/preventive',$data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function searchdata()
    {
        $data=$this->mod_preventive->readall_range($this->input->post('start_cl'),$this->input->post('stop_cl'),$this->input->post('id_mesin'));
        echo json_encode($data);
    }
	
	public function pencapaian($tahun='tahunini')
    {
        if ($tahun=='tahunini') {
            $tahun = date('Y');
        }
        $data['tahun']=$tahun;
        $data['raw'] = $this->mod_preventive->pencapaian($tahun);
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('laporan/pencapaian_preventive', $data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

    public function notdone($periode)
    {
        $data['raw'] = $this->mod_preventive->notdone($periode);
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('laporan/pencapaian_notdone', $data);
        $this->load->view('control-sidebar');
        $this->load->view('footer');
    }

}

/* End of file Laporanpreventive.php */

?>