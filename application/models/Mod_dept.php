<?php
class Mod_dept extends CI_Model
{
    public function read()
    {
        $sql = "SELECT * FROM dept";
        return  $this->db->query($sql)->result();
    }

    public function readbyid($id_dept)
    {
        $sql = "SELECT * FROM dept WHERE id_dept='$id_dept'";
        return  $this->db->query($sql)->result();
    }

    public function insert($data)
    {
        $this->db->insert('dept',$data);
    }

    public function update($id_dept,$data)
    {
        $this->db->where('id_dept',$id_dept);
        $this->db->update('dept',$data);
    }

    public function hapus($id_dept)
    {
        $this->db->where('id_dept',$id_dept);
        $this->db->delete('dept');
    }


}
