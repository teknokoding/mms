<?php
class Mod_durasi extends CI_Model
{
    public function read()
    {
        $sql = "SELECT * FROM durasi_cl";
        return  $this->db->query($sql)->result();
    }

    public function readbyid($id_durasi_cl)
    {
        $sql = "SELECT * FROM durasi_cl WHERE id_durasi_cl='$id_durasi_cl'";
        return  $this->db->query($sql)->result();
    }

    public function readexpiredbykodedurasi($kode_durasi)
    {
        $this->db->select('expired');
        $this->db->from('durasi_cl');
        $this->db->where('kode_durasi',$kode_durasi);
        return $this->db->get()->result();
    }

    public function insert($data)
    {
        $this->db->insert('durasi_cl',$data);
    }

    public function update($id_durasi_cl,$data)
    {
        $this->db->where('id_durasi_cl',$id_durasi_cl);
        $this->db->update('durasi_cl',$data);
    }

    public function hapus($id_durasi_cl)
    {
        $this->db->where('id_durasi_cl',$id_durasi_cl);
        $this->db->delete('durasi_cl');
    }

}
