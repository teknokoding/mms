<?php
class Mod_sect extends CI_Model
{
    public function read()
    {
        $sql = "SELECT sect.id_sect,sect.nama_sect,sect.note as note,dept.nama_dept FROM sect JOIN dept ON sect.id_dept=dept.id_dept ORDER BY nama_sect ASC";
        return  $this->db->query($sql)->result();
    }

    public function readpic()
    {
        $sql = "SELECT sect.id_sect,sect.nama_sect,sect.note as note,dept.nama_dept FROM sect JOIN dept ON sect.id_dept=dept.id_dept WHERE sect.pic='Y' ORDER BY nama_sect ASC";
        return  $this->db->query($sql)->result();
    }

    public function readbyid($id_sect)
    {
        $sql = "SELECT * FROM sect WHERE id_sect='$id_sect'";
        return  $this->db->query($sql)->result();
    }

    public function readbydept($id_dept)
    {
        $sql = "SELECT * FROM sect WHERE id_dept='$id_dept'";
        return  $this->db->query($sql)->result();
    }

    public function insert($data)
    {
        $this->db->insert('sect',$data);
    }

    public function update($id_sect,$data)
    {
        $this->db->where('id_sect',$id_sect);
        $this->db->update('sect',$data);
    }

    public function hapus($id_sect)
    {
        $this->db->where('id_sect',$id_sect);
        $this->db->delete('sect');
    }

}
