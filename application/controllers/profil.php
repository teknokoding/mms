<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_user');
        $this->session->set_flashdata('judul', 'Profil');
    }

    public function index()
    {
        $data['user']=$this->mod_user->readbyid($this->session->userdata('iduser'));
        if ($this->session->userdata('id_dept')=='4') {
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('profil', $data);
            $this->load->view('control-sidebar');
            $this->load->view('footer');
        } else {
            $this->load->view('header_tpm');
            $this->load->view('sidebar_tpm');
            $this->load->view('profil', $data);
            $this->load->view('footer');
        }
    }

    public function gantipass($iduser)
    {
        $valid = $this->mod_user->cekpass($iduser, $this->input->post('pass_lama'));
        if ($valid=='1') {
            if ($this->input->post('pass_baru')!=$this->input->post('pass_ulang')) {
                echo "<div class='alert bg-danger'>password yang anda ulangi tidak cocok</div>";
            } else {
                $this->mod_user->gantipass($iduser, $this->input->post('pass_baru'));
                $this->session->set_userdata("swal", "Swal.fire(
                    'Penggantian Password Berhasil',
                    '',
                    'success'
                  )");
                echo "sukses";
            }
        } else {
            echo "<div class='alert bg-danger'>Password lama anda tidak benar</div>";
        }
    }
}

/* End of file Profil.php */
