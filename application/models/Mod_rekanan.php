<?php
class Mod_rekanan extends CI_Model
{
    public function read()
    {
        $sql = "SELECT * FROM relasi";
        return  $this->db->query($sql)->result();
    }

    public function readbyid($id_relasi)
    {
        $sql = "SELECT * FROM relasi WHERE id_relasi='$id_relasi'";
        return  $this->db->query($sql)->result();
    }

    public function insert($data)
    {
        $this->db->insert('relasi',$data);
    }

    public function update($id_relasi,$data)
    {
        $this->db->where('id_relasi',$id_relasi);
        $this->db->update('relasi',$data);
    }

    public function hapus($id_relasi)
    {
        $this->db->where('id_relasi',$id_relasi);
        $this->db->delete('relasi');
    }


}
