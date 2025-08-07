<?php
class Mod_uploadcl extends CI_Model
{
    public function read($id_sect)
    {
        $this->db->select('*');
        $this->db->where('id_sect',$id_sect);
        $this->db->from('upload_cl');
        $this->db->order_by('tgl_upload','DESC');
        return $this->db->get()->result();
    }

    public function readbyidupload($id_upload)
    {
        $sql = "SELECT * FROM jadwal_cl LEFT JOIN mesin ON jadwal_cl.id_mesin=mesin.id_mesin LEFT JOIN checklist ON jadwal_cl.kode_cl=checklist.kode_cl WHERE jadwal_cl.id_upload='$id_upload' ORDER BY jadwal_cl.start_cl ASC";
        return $this->db->query($sql)->result();
    }

    // Fungsi untuk melakukan proses upload file
    public function upload_file(){
    $this->load->library('upload'); // Load librari upload
    $config['upload_path'] = './assets/excel';
    $config['allowed_types'] = 'xlsx';
    $config['max_size']  = '2048';
    $config['overwrite'] = true;
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '', 'nama_file'=>$this->upload->data('file_name'));
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }
  
  // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
  public function insert_multiple($data){
    $this->db->insert_batch('jadwal_cl', $data);
  }

  // INSERT UPLOAD SET
  public function insert_upload($data_upload)
  {
    $this->db->insert('upload_cl',$data_upload);
  }

  //HAPUS UPLOAD
  public function hapus_upload($id_upload)
  {
    $this->db->where('id_upload',$id_upload);
    $this->db->delete('upload_cl');
    $this->db->where('id_upload',$id_upload);
    $this->db->delete('jadwal_cl');
  }


    

}
