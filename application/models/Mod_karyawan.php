<?php
class Mod_karyawan extends CI_Model
{
    public function read()
    {
        $sql = "SELECT * FROM karyawan JOIN dept ON karyawan.id_dept=dept.id_dept JOIN sect ON karyawan.id_sect=sect.id_sect ORDER BY nama_karyawan ASC";
        return  $this->db->query($sql)->result();
    }

    public function readbynik($nik)
    {
        $sql = "SELECT * FROM karyawan WHERE nik='$nik'";
        return  $this->db->query($sql)->result();
    }

    public function readnamabynik($nik)
    {
        error_reporting(0);
        $this->db->select('nama_karyawan');
        $this->db->from('karyawan');
        $this->db->where('nik',$nik);
        return  $this->db->get()->row()->nama_karyawan;
    }

    public function readbysect($id_sect)
    {
        $sql = "SELECT * FROM karyawan WHERE id_sect='$id_sect' ORDER BY nama_karyawan ASC";
        return $this->db->query($sql)->result();
    }

    public function readbysect_aktif($id_sect)
    {
        $sql = "SELECT * FROM karyawan WHERE id_sect='$id_sect' AND aktif='Y' ORDER BY nama_karyawan ASC";
        return $this->db->query($sql)->result();
    }

    public function insert($data)
    {
        $this->db->insert('karyawan',$data);
    }

    public function update($nik,$data)
    {
        $this->db->where('nik',$nik);
        $this->db->update('karyawan',$data);
    }

    public function hapus($nik)
    {
        $this->db->where('nik',$nik);
        $this->db->delete('karyawan');
    }

    public function nonaktif($nik)
    {
        $this->db->where('nik',$nik);
        $this->db->update('karyawan',array('aktif'=>"N"));
    }

    public function aktif($nik)
    {
        $this->db->where('nik',$nik);
        $this->db->update('karyawan',array('aktif'=>"Y"));
    }
}
