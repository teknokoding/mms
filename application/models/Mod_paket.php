<?php
class Mod_paket extends CI_Model
{
    public function read()
    {
        $sql = "SELECT * FROM checklist";
        return  $this->db->query($sql)->result();
    }

    public function readbyid($id_cl)
    {
        $sql = "SELECT * FROM checklist WHERE id_cl='$id_cl'";
        return  $this->db->query($sql)->result();
    }

    public function readbysect($id_sect)
    {
        $sql = "SELECT * FROM checklist JOIN mesin ON checklist.id_mesin=mesin.id_mesin WHERE checklist.id_sect='$id_sect'";
        return  $this->db->query($sql)->result();
    }

    public function readbymesin($id_mesin)
    {
        $sql = "SELECT * FROM checklist WHERE id_mesin='$id_mesin' ORDER BY kode_durasi ASC";
        return $this->db->query($sql)->result();
    }

    public function insert($data)
    {
        $this->db->insert('checklist',$data);
    }

    public function update($id_cl,$data)
    {
        $this->db->where('id_cl',$id_cl);
        $this->db->update('checklist',$data);
    }

    public function hapus($id_cl,$kode_cl)
    {
        $this->db->where('id_cl',$id_cl);
        $this->db->delete('checklist');
        unlink('./assets/isodoc/'.$kode_cl.'.pdf');
    }

    

}
