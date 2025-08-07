<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_auth');
        $this->load->model('mod_theme');
    }

    public function index()
    {
        if ($this->session->has_userdata('Auth')) {
            if ($this->session->userdata('id_dept')==4) {
                redirect('lkh');
            } else {
                redirect('tpm2fromsection');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function ceklogin()
    {
        $Username    = $this->input->post('Username');
        $Password   = $this->input->post('Password');
        $Password   = md5($Password);
        $valid = $this->mod_auth->ceklogin($Username, $Password);
        if ($this->session->has_userdata('Auth')) {
            $this->mod_theme->tema();
            if ($this->session->userdata('id_dept')==4) {
                if ($this->session->userdata('id_level')<4) {
                    if ($this->session->userdata('sesi')==0) {
                        redirect('sesi');
                    } else {
                        redirect('lkh');
                    }
                } else {
                    redirect('lkh');
                }
            } else {
                redirect('tpm2fromsection');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger"><small>Login gagal, user atau password tidak valid</small></div>');
            redirect('login');
        }
    }
}
