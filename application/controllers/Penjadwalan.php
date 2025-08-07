<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Penjadwalan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		    $this->secure->auth();
        $this->load->model('mod_uploadcl');
        $this->load->model('mod_durasi');
        $this->session->set_flashdata('judul','Penjadwalan Preventive Maintenance');
        
    }

    public function index()
    {
        $data['upload'] = $this->mod_uploadcl->read($this->session->userdata('id_sect'));
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('penjadwalan/index',$data);
        $this->load->view('control-sidebar');
		    $this->load->view('footer');

    }

    public function readbyidupload($id_upload)
    {
        $data = $this->mod_uploadcl->readbyidupload($id_upload);
        echo json_encode($data);
    }

    public function form()
    {
        $data = array(); // Buat variabel $data sebagai array
        if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
          // lakukan upload file dengan memanggil function upload yang ada di mod_uploadcl.php
          $upload = $this->mod_uploadcl->upload_file();
          if($upload['result'] == "success"){ // Jika proses upload sukses
            // Load plugin PHPExcel nya
            include(APPPATH.'third_party/PHPExcel/PHPExcel.php');
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('./assets/excel/'.$upload['nama_file']); // Load file yang tadi diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
            
            // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
            // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
            $data['sheet'] = $sheet; 
            $data['nama_file']=$upload['nama_file'];
          }else{ // Jika proses upload gagal
            $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
          }
        }
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('penjadwalan/upload',$data);
        $this->load->view('control-sidebar');
		    $this->load->view('footer');
      }
      

      public function import()
      {
        $id_upload = random_string('nozero',8);
      // Load plugin PHPExcel nya
        include(APPPATH.'third_party/PHPExcel/PHPExcel.php');
        $nama_file = $this->input->post('nama_file');
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('./assets/excel/'.$nama_file); // Load file yang telah diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
        $data = array();
        
        $numrow = 1;
        foreach($sheet as $row){
          // Cek $numrow apakah lebih dari 1
          // Artinya karena baris pertama adalah nama-nama kolom
          // Jadi dilewat saja, tidak usah diimport
          if($numrow > 1){
            $kode_cl = $row['C'];
            $kode_cl_arr = explode("_",$kode_cl);
            $kode_durasi = $kode_cl_arr[1];
            $id_mesin = $kode_cl_arr[0];
            $expired = $this->mod_durasi->readexpiredbykodedurasi($kode_durasi);
            foreach($expired as $item)
            {
              $expired = $item->expired;
            }
            $start_cl = $row['F'].'-'.$row['E'].'-'.$row['D'];
            $stop_cl = date('Y-m-d',strtotime('+'.$expired.' day',strtotime($start_cl)));
            // Kita push (add) array data ke variabel data
            array_push($data, array(
              'kode_cl'=>$row['C'], 
              'id_mesin'=>$id_mesin, 
              'id_sect'=>$this->session->userdata('id_sect'),
              'start_cl'=>$start_cl, 
              'stop_cl'=>$stop_cl,
              'id_upload'=>$id_upload,
            ));
          }
          
          $numrow++; // Tambah 1 setiap kali looping
        }
        $data_upload = array(
          'id_upload'=>$id_upload,
          'tgl_upload'=>date('Y-m-d'),
          'upload_by'=>$this->session->userdata('username'),
          'nama_file'=>$nama_file,
          'id_sect'=>$this->session->userdata('id_sect'),
      );
        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
        unlink('./assets/excel/'.$nama_file);
        $this->mod_uploadcl->insert_multiple($data);
        $this->mod_uploadcl->insert_upload($data_upload);
        $this->session->set_userdata("swal","Swal.fire(
          'Upload Jadwal Berhasil',
          '',
          'success'
        )");
        redirect("penjadwalan"); // Redirect ke halaman awal
      }

      // UNTUK HAPUS SATU SET UPLOAD

      public function hapus_upload($id_upload)
      {
        $this->mod_uploadcl->hapus_upload($id_upload);
        $this->session->set_userdata("swal","Swal.fire(
          'Set Jadwal Terhapus',
          '',
          'error'
        )");
      }

}

/* End of file Preventiveday.php */


?>