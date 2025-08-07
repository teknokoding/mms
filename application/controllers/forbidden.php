<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Forbidden extends CI_Controller
{
    public function index()
    {
        $this->session->set_flashdata('judul', 'Forbidden');
        if (
        $this->session->userdata('id_dept')=='4'
        ) {
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('forbidden');
            $this->load->view('control-sidebar');
            $this->load->view('footer');
        } else {
            $this->load->view('header_tpm');
            $this->load->view('sidebar_tpm');
            $this->load->view('forbidden');
            $this->load->view('footer');
        }
    }
}

/* End of file Forbidden.php */
