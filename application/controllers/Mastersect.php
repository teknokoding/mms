<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mastersect extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_sect');
        $this->load->model('mod_dept');
        $this->session->set_flashdata('judul', 'Master Section');
    }

    
    public function index()
    {
        $data['dept']=$this->mod_dept->read();
        $data['sect']=$this->mod_sect->read();
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('mastersect/index', $data);
        $this->load->view('footer');
    }

    public function insert()
    {
        $data = $this->input->post();
        $this->mod_sect->insert($data);
        $this->session->set_userdata("swal", "Swal.fire(
			'Section Berhasil Ditambah',
			'',
			'success'
		  )");
        redirect('mastersect');
    }

    public function edit_form($id_sect)
    {
        $data['dept']=$this->mod_dept->read();
        $data['sectedit']=$this->mod_sect->readbyid($id_sect);
        $this->load->view('mastersect/edit_form', $data);
    }

    public function update($id_sect)
    {
        $data = $this->input->post();
        $this->mod_sect->update($id_sect, $data);
        $this->session->set_userdata("swal", "Swal.fire(
			'Section Berhasil Diupdate',
			'',
			'success'
		  )");
        redirect('mastersect');
    }

    

    public function hapus($id_sect)
    {
        $this->mod_sect->hapus($id_sect);
        $this->session->set_userdata("swal", "Swal.fire(
			'Section Berhasil Dihapus',
			'',
			'warning'
		  )");
        redirect('mastersect');
    }

    public function readbydept($id_dept)
    {
        $sect = $this->mod_sect->readbydept($id_dept);
        echo json_encode($sect);
    }
}
