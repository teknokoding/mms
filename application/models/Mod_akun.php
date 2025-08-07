<?php
class Mod_akun extends CI_Model
{
    public function read()
    {
        $sql = "SELECT * FROM user LEFT JOIN sect ON user.id_sect=sect.id_sect JOIN dept ON user.id_dept=dept.id_dept JOIN level ON user.id_level=level.id_level ORDER BY namalengkap ASC";
        return  $this->db->query($sql)->result();
    }

    public function rows()
    {
        $sql = "SELECT * FROM user";
        return  $this->db->query($sql)->num_rows();
    }

    

    public function readbyid($iduser)
    {
        $sql = "SELECT * FROM user LEFT JOIN sect ON user.id_sect=sect.id_sect WHERE user.iduser='$iduser' ORDER BY namalengkap ASC";
        return  $this->db->query($sql)->result();
    }

    public function readbysect($id_sect)
    {
        $sql = "SELECT * FROM user WHERE id_sect='$id_sect' ORDER BY namalengkap ASC";
        return $this->db->query($sql)->result();
    }

    public function insert($data)
    {
        $this->db->insert('user',$data);
    }

    public function update($iduser,$data)
    {
        $this->db->where('iduser',$iduser);
        $this->db->update('user',$data);
    }

    public function hapus($iduser)
    {
        $this->db->where('iduser',$iduser);
        $this->db->delete('user');
    }

    public function nonaktif($iduser)
    {
        $this->db->where('iduser',$iduser);
        $this->db->update('user',array('aktif_stat'=>"N"));
    }

    public function aktif($iduser)
    {
        $this->db->where('iduser',$iduser);
        $this->db->update('user',array('aktif_stat'=>"Y"));
    }
    
    public function resetpassword($iduser,$password)
    {
        $this->db->where('iduser',$iduser);
        $this->db->update('user',array('password'=>md5($password)));
    }

}