<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashtpm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->session->set_flashdata('judul', 'Dashboard');
    }

    public function index()
    {
        $this->load->view('header_tpm');
        $this->load->view('sidebar_tpm');
        $this->load->view('dashmme');
        $this->load->view('footer');
    }
}
