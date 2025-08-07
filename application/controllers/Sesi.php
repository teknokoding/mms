<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sesi extends CI_Controller {

    public function index()
    {
        $this->load->view('header');
        $this->load->view('sidebar');
        if($this->session->userdata('sesi')==0)
        {
        $this->load->view('sesi');
        }
        else
        {
        redirect('lkh');
        }
        $this->load->view('footer');
    }

    public function set_sesi($id_sect)
    {
        $this->session->set_userdata('id_sect',$id_sect);
        $this->session->set_userdata('sesi',1);
        $id_sect=='5'?$seksi="MME1 (AB)":$seksi="MME2 (CD)";
        $this->session->set_userdata("swal","Swal.fire(
			'Anda memilih sesi $seksi',
			'',
			'success'
		  )");
    }

    public function exchange()
    {
        $this->session->set_userdata('sesi',0);
        redirect('sesi');
    }

}

/* End of file Sesi.php */

?>