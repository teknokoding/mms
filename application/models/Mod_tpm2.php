<?php
class Mod_tpm2 extends CI_Model
{
    public function read($id_sect)
    {
        $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin WHERE tag.id_pic='$id_sect' AND tag.rel_stat!='OK' ORDER BY tgl_tag DESC";
        return $this->db->query($sql)->result();
    }

    public function read_mesin_fromsect($id_sect)
    {
        $id_mesin = $this->session->userdata('id_mesin');
        if ($id_mesin=="ALL") {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik JOIN sect ON tag.id_pic=sect.id_sect WHERE tag.id_sect='$id_sect' AND tag.rel_stat!='OK' ORDER BY tgl_tag DESC";
        } else {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik JOIN sect ON tag.id_pic=sect.id_sect WHERE tag.id_sect='$id_sect' AND tag.rel_stat!='OK' AND tag.id_mesin='$id_mesin' ORDER BY tgl_tag DESC";
        }
        
        return $this->db->query($sql)->result();
    }

    public function read_mesin_tosect($id_sect)
    {
        $id_mesin = $this->session->userdata('id_mesin');
        if ($id_mesin=="ALL") {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik JOIN sect ON tag.id_sect=sect.id_sect WHERE tag.id_pic='$id_sect' AND tag.rel_stat!='OK' ORDER BY tgl_tag DESC";
        } else {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik JOIN sect ON tag.id_sect=sect.id_sect WHERE tag.id_pic='$id_sect' AND tag.rel_stat!='OK' AND tag.id_mesin='$id_mesin' ORDER BY tgl_tag DESC";
        }
        
        return $this->db->query($sql)->result();
    }

    public function acc_read($id_sect)
    {
        $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik JOIN sect ON tag.id_pic=sect.id_sect WHERE tag.id_sect='$id_sect' AND tag.rel_stat='OK' AND tag.acc_stat!='OK' ORDER BY tgl_tag DESC";
        return $this->db->query($sql)->result();
    }

    public function read_mesin_qr($id_mesin)
    {
        $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik WHERE tag.rel_stat!='OK' AND tag.id_mesin='$id_mesin' ORDER BY tag.tgl_tag ASC";
        return $this->db->query($sql)->result();
    }

    public function readall_range($start, $stop, $id_mesin)
    {
        $id_sect = $this->session->userdata('id_sect');
        if ($id_mesin=="ALL") {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik WHERE tag.id_pic='$id_sect'  AND (tag.tgl_tag BETWEEN '$start' AND '$stop') ORDER BY tag.tgl_tag DESC";
        } else {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik WHERE tag.id_pic='$id_sect' AND tag.id_mesin='$id_mesin' AND (tag.tgl_tag BETWEEN '$start' AND '$stop') ORDER BY tag.tgl_tag DESC";
        }
        
        return $this->db->query($sql)->result();
    }

    public function readbyid($id_tag)
    {
        $sql = "SELECT * FROM tag_release LEFT JOIN tag ON tag_release.id_tag=tag.id_tag LEFT JOIN mesin ON tag.id_mesin=mesin.id_mesin LEFT JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag_release.pelaksana1=karyawan.nik LEFT JOIN user ON tag.tager=user.username WHERE tag_release.id_tag='$id_tag' ORDER BY tag_release.tgl_rel ASC";
        return $this->db->query($sql)->result();
    }

    public function do_release($data, $id_tag, $rel_stat)
    {
        $this->db->insert('tag_release', $data);
        $this->db->where('id_tag', $id_tag);
        $this->db->update('tag', array('rel_stat'=>$rel_stat));
    }

    public function create($data)
    {
        $this->db->insert('tag', $data);
    }
    public function readdetail($id_tag)
    {
        $this->db->where('id_tag', $id_tag);
        return $this->db->get('tag')->result();
    }
    public function update($data, $id_tag)
    {
        $this->db->where('id_tag', $id_tag);
        $this->db->update('tag', $data);
    }
    public function delete($id_tag)
    {
        $this->db->where('id_tag', $id_tag);
        $this->db->delete('tag');
    }
}
