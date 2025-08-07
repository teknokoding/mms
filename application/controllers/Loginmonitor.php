<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Loginmonitor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_auth');
        $this->load->model('mod_theme');
    }

    public function index()
    
    {
        if(get_cookie('mmsauth')!="")
        {
            redirect('monitor/qr/'.$this->session->flashdata('id_mesin_enc'));
        }
        else
        {
        $data['id_mesin_enc'] = $this->session->flashdata('id_mesin_enc');
        $this->load->view('loginmonitor',$data);
        }
    }

    public function ceklogin($id_mesin_enc)  
    {
        $Username    = $this->input->post('Username');
        $Password   = $this->input->post('Password');
        $Password   = md5($Password);
        $valid = $this->mod_auth->cekloginmonitor($Username,$Password);
        if(get_cookie('mmsauth'))
        {
            $this->mod_theme->tema();
            redirect('monitor/qr/'.$id_mesin_enc);
        }
        else {
            $this->session->set_flashdata('id_mesin_enc', $id_mesin_enc);
            $this->session->set_flashdata('pesan','<div class="alert alert-danger"><small>Login gagal, user atau password tidak valid</small></div>');
            redirect('loginmonitor');
        }
        
        
    }

   
}