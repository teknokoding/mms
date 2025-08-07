<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Preventive extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->secure->auth();
        $this->load->model('mod_preventive');
        $this->load->model('mod_karyawan');
        $this->load->model('mod_mesin');
        $this->load->model('mod_paket');
        $this->load->model('mod_durasi');
        $this->session->set_flashdata('judul', 'Preventive Maintenance');
    }

    // FORM DONE CHECKLIST =======================================
    public function done_form($id_jadwal_cl)
    {
        $data['paket']=$this->mod_preventive->readbyid($id_jadwal_cl);
        $data['karyawan']=$this->mod_karyawan->readbysect_aktif($this->session->userdata('id_sect'));
        $data['prev']=$this->mod_preventive->readbyid($id_jadwal_cl);
        $this->load->view('preventive/done', $data);
    }

    // FORM DONE CHECKLIST GEDUNG AB =======================================
    public function done1_form($id_jadwal_cl)
    {
        $data['paket']=$this->mod_preventive->readbyid($id_jadwal_cl);
        $data['karyawan']=$this->mod_karyawan->readbysect_aktif($this->session->userdata('id_sect'));
        $data['prev']=$this->mod_preventive->readbyid($id_jadwal_cl);
        $this->load->view('preventive/done1', $data);
    }

    // DONE CL =================================================
    public function done($id_jadwal_cl)
    {
        $data = array(
            'done_cl'=>$this->input->post('done_cl'),
            'uraian_cl'=>$this->input->post('uraian_cl'),
            'pelaksana1'=>$this->input->post('pelaksana[0]'),
            'pelaksana2'=>$this->input->post('pelaksana[1]'),
            'pelaksana3'=>$this->input->post('pelaksana[2]'),
            'pelaksana4'=>$this->input->post('pelaksana[3]'),
            'pelaksana5'=>$this->input->post('pelaksana[4]'),
            'pelaksana6'=>$this->input->post('pelaksana[5]'),

        );
        $this->mod_preventive->done($id_jadwal_cl, $data);
    }

    // DONE AB CL =================================================
    public function done1($id_jadwal_cl)
    {
        $data = array(
             'done_cl'=>$this->input->post('done_cl'),
             'uraian_cl'=>$this->input->post('uraian_cl'),
             'pelaksana1'=>$this->input->post('pelaksana[0]'),
             'pelaksana2'=>$this->input->post('pelaksana[1]'),
             'pelaksana3'=>$this->input->post('pelaksana[2]'),
             'pelaksana4'=>$this->input->post('pelaksana[3]'),
             'pelaksana5'=>$this->input->post('pelaksana[4]'),
             'pelaksana6'=>$this->input->post('pelaksana[5]'),
 
         );
        $kode_cl = $this->input->post('kode_cl');
        $start_cl =  $this->input->post('start_cl');
        $stop_cl =  $this->input->post('stop_cl');
        $id_mesin = $this->input->post('id_mesin');
        $data_next = array(
        "id_mesin"=>$id_mesin,
        "start_cl"=>$start_cl,
        "stop_cl"=>$stop_cl,
        "id_mesin"=>$id_mesin,
        "kode_cl"=>$kode_cl,
        "id_sect"=>$this->session->userdata('id_sect'));
        
        $this->mod_preventive->done($id_jadwal_cl, $data);
        $this->mod_preventive->next_cl($data_next);
    }

    // ACC CHECKLIST ============================================
    public function acc($id_jadwal_cl)
    {
        $this->secure->level('4,5');
        $this->mod_preventive->acc($id_jadwal_cl);
    }

    // FORM GESER JADWAL ==========================================
    public function geser_form($id_jadwal_cl)
    {
        $data['paket'] = $this->mod_preventive->readbyid($id_jadwal_cl);
        $this->load->view('preventive/geser', $data);
    }

    // ACTION GESER JADWAL ==========================================
    public function geser($id_jadwal_cl)
    {
        $data = $this->input->post();
        $this->mod_preventive->geser($id_jadwal_cl, $data);
    }


    // CARI DATA CL ===================================================
    public function searchdata()
    {
        $start_cl = $this->input->post('start_cl');
        if (isset($start_cl)) {
            $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
            $data['mingguan']=$this->mod_preventive->readday_mingguan_range($this->input->post('start_cl'), $this->input->post('stop_cl'), $this->input->post('id_mesin'));
            $data['bulanan']=$this->mod_preventive->readday_bulanan_range($this->input->post('start_cl'), $this->input->post('stop_cl'), $this->input->post('id_mesin'));
			$data['independen']=$this->mod_preventive->read_independen_range($this->input->post('start_cl'), $this->input->post('stop_cl'), $this->input->post('id_mesin'));
            $data['mulai']=$this->input->post('start_cl');
            $data['selesai']=$this->input->post('stop_cl');
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('preventive/searchdata', $data);
            $this->load->view('control-sidebar');
            $this->load->view('footer');
        }
    }

    // CARI DATA CL MME1 ===================================================
    public function searchdata1()
    {
        $start_cl = $this->input->post('start_cl');
        if (isset($start_cl)) {
            $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
            $data['paket']=$this->mod_preventive->readday_range($this->input->post('start_cl'), $this->input->post('stop_cl'), $this->input->post('id_mesin'));
            $data['mulai']=$this->input->post('start_cl');
            $data['selesai']=$this->input->post('stop_cl');
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('preventive/searchdata1', $data);
            $this->load->view('control-sidebar');
            $this->load->view('footer');
        }
    }

    // HAPUS JADWAL CL =====================================================
    public function hapus($id_jadwal_cl)
    {
        $this->mod_preventive->hapus($id_jadwal_cl);
        $this->session->set_userdata("swal", "Swal.fire(
            'Jadwal berhasil dihapus',
            '',
            'error'
          )");
    }

    // FORM SKIP CL
    public function skip_form($id_jadwal_cl)
    {
        $data['paket'] = $this->mod_preventive->readbyid($id_jadwal_cl);
        $this->load->view('preventive/skip', $data);
    }

    // SKIP CL
    public function skip($id_jadwal_cl)
    {
        $kode_cl = $this->input->post('kode_cl');
        $start_cl =  $this->input->post('start_cl');
        $stop_cl =  $this->input->post('stop_cl');
        $id_mesin = $this->input->post('id_mesin');
        $note_skip = $this->input->post('note_skip');
        $data = array(
        "id_mesin"=>$id_mesin,
        "start_cl"=>$start_cl,
        "stop_cl"=>$stop_cl,
        "id_mesin"=>$id_mesin,
        "kode_cl"=>$kode_cl,
        "id_sect"=>$this->session->userdata('id_sect')
    );
        $this->mod_preventive->skip($id_jadwal_cl, $kode_cl, $start_cl, $note_skip, $data);
    }

    // FORM CREATE CL ===============================================
    public function create_form()
    {
        $data['mesin']=$this->mod_mesin->readbymnt($this->session->userdata('id_sect'));
        $this->load->view('preventive/create_form', $data);
    }

    // BACA PAKET PER MESIN ==========================================
    public function readpaketbymesin($id_mesin)
    {
        $paket = $this->mod_paket->readbymesin($id_mesin);
        echo json_encode($paket);
    }

    // SUBMIT JADWAL BARU
    public function create_cl()
    {
        $kode_cl_arr = explode("_", $this->input->post('kode_cl'));
        $kode_durasi = $kode_cl_arr[1];
        $expired = $this->mod_durasi->readexpiredbykodedurasi($kode_durasi);
        foreach ($expired as $item) {
            $expired = $item->expired;
        }
        $start_cl = $this->input->post('start_cl');
        $kode_cl = $this->input->post('kode_cl');
        $id_mesin = $this->input->post('id_mesin');
        $stop_cl = date('Y-m-d', strtotime('+'.$expired.' day', strtotime($start_cl)));
        $data = array(
        "start_cl"=>$start_cl,
        "stop_cl"=>$stop_cl,
        "id_mesin"=>$id_mesin,
        "kode_cl"=>$kode_cl,
        "id_sect"=>$this->session->userdata('id_sect')
    );
        $this->mod_preventive->create_cl($data);
        $this->session->set_userdata("swal", "Swal.fire(
        'Jadwal berhasil dibuat',
        '',
        'success'
      )");
    }
}

/* End of file Preventiveday.php */
