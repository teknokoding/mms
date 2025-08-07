<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tpm2acc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_tpm2');
        $this->load->model('mod_tpm');
        $this->secure->auth();
        $this->secure->level('1,2,3,4');
        $this->session->set_flashdata('judul', 'ACC Tag Release');
    }
    

    public function index()
    {
        $data['acc']=$this->mod_tpm2->acc_read($this->session->userdata('id_sect'));
        $this->load->view('header_tpm');
        $this->load->view('sidebar_tpm');
        $this->load->view('tpm2/acc', $data);
        $this->load->view('footer');
    }
    public function acc_form($id_tag)
    {
        $data['riwayat']=$this->mod_tpm->readbyid($id_tag);
        $this->load->view('tpm2/acc_form', $data);
    }
    public function do_acc($id_tag)
    {
        $data = array(
            "acc_stat"=>"OK",

        );
        $this->db->where('id_tag', $id_tag);
        
        $this->db->update('tag', $data);
        $this->session->set_userdata("swal", "Swal.fire(
			'Berhasil di ACC',
			'',
			'success'
        );");
        redirect('tpm2acc');
    }
}

/* End of file Tpm2acc.php */
