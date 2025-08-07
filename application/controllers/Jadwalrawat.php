<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwalrawat extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		// $this->secure->auth();
        $this->load->model('mod_preventive');
        $this->load->model('mod_mesin');
        $this->session->set_flashdata('judul','Preventive Maintenance');
        
    }

    public function index()
    {
        define("id_sect","6");
        $data['mesin']=$this->mod_mesin->readbysect_def(id_sect);
        $this->load->view('header');
        // $this->load->view('sidebar');
        if(id_sect=="5")
        {
            $data['paket']=$this->mod_preventive->readday(date('Y-m-d'));
            $data['paketpass']=$this->mod_preventive->readday_pass(date('Y-m-d'));
            $this->load->view('preventive/preventive1',$data);
        }
        else
        {
            $data['mingguan']=$this->mod_preventive->readday_mingguan(date('Y-m-d'));
            $data['bulanan']=$this->mod_preventive->readday_bulanan(date('Y-m-d'));
			$data['independen']=$this->mod_preventive->read_independen(date('Y-m-d'));
            $this->load->view('preventive/preventive2',$data);
        }
        
        // $this->load->view('control-sidebar');
		$this->load->view('footer');
    }

}

/* End of file Preventiveday.php */


?>