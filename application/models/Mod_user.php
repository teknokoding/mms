<?php
class Mod_user extends CI_Model
{
    public function read()
    {
        $sql = "SELECT * FROM user WHERE aktif_stat='Y' ORDER BY namalengkap ASC";
        return  $this->db->query($sql)->result();
    }

    public function readbyusername($username)
    {
        $sql = "SELECT * FROM user WHERE username='$username'";
        return  $this->db->query($sql)->result();
    }

    public function readbyid($iduser)
    {
        $sql = "SELECT * FROM user JOIN dept ON user.id_dept=dept.id_dept JOIN sect ON user.id_sect=sect.id_sect JOIN level ON user.id_level=level.id_level WHERE user.iduser='$iduser'";
        return  $this->db->query($sql)->result();
    }

    public function readnamabyusername($username)
    {
        error_reporting(0);
        $this->db->select('namalengkap');
        $this->db->from('user');
        $this->db->where('username',$username);
        return  $this->db->get()->row()->namalengkap;
    }

    public function readbysect($id_sect)
    {
        $sql = "SELECT * FROM user WHERE id_sect='$id_sect' ORDER BY namalengkap ASC";
        return $this->db->query($sql)->result();
    }

    public function readbysect_aktif($id_sect)
    {
        $sql = "SELECT * FROM user WHERE id_sect='$id_sect' AND aktif_stat='Y' ORDER BY namalengkap ASC";
        return $this->db->query($sql)->result();
    }

    public function cekpass($iduser,$password)
    {
        $pwd = md5($password);
        $this->db->where('iduser', $iduser);
        $this->db->where('password', $pwd);
        $row = $this->db->get('user')->num_rows();
        if($row>0){$valid='1';}else{$valid='0';}
        return $valid;
    }

    public function gantipass($iduser,$pass_baru)
    {
        $this->db->where('iduser',$iduser);
        $this->db->update('user',array('password'=>md5($pass_baru)));
    }

}
