<?php
class Mod_unitmesin extends CI_Model
{
    public function read()
    {
        $sql = "SELECT mesin.nama_mesin,mesin_unit.nama_unitmesin,mesin_unit.id_unitmesin FROM mesin_unit JOIN mesin ON mesin_unit.id_mesin=mesin.id_mesin ORDER BY mesin.nama_mesin ASC";
        return  $this->db->query($sql)->result();
    }

    public function readbyid($id_unitmesin)
    {
        $sql = "SELECT * FROM mesin_unit WHERE id_unitmesin='$id_unitmesin'";
        return  $this->db->query($sql)->result();
    }
	public function readbymesin($id_mesin)
    {
        $sql = "SELECT * FROM mesin_unit WHERE id_mesin='$id_mesin' ORDER BY nama_unitmesin ASC";
        return $this->db->query($sql)->result();
    }
    public function insert($data)
    {
        $this->db->insert('mesin_unit',$data);
    }
    public function hapus($id_unitmesin)
    {
        $this->db->where('id_unitmesin',$id_unitmesin);
        $this->db->delete('mesin_unit');
    }

    public function update($id_unitmesin,$data)
    {
        $this->db->where('id_unitmesin',$id_unitmesin);
        $this->db->update('mesin_unit',$data);
    }
   

}
