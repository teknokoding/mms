<?php
class Mod_tpm extends CI_Model
{
    public function read($id_sect)
    {
        $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin WHERE tag.id_pic='$id_sect' AND tag.rel_stat!='OK' ORDER BY tgl_tag ASC";
        return $this->db->query($sql)->result();
    }

    public function read_mesin($id_sect)
    {
        $id_mesin = $this->session->userdata('id_mesin');
        if($id_mesin=="ALL")
        {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik WHERE tag.id_pic='$id_sect' AND tag.rel_stat!='OK' ORDER BY tgl_tag ASC";
        }
        else
        {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik WHERE tag.id_pic='$id_sect' AND tag.rel_stat!='OK' AND tag.id_mesin='$id_mesin' ORDER BY tgl_tag ASC";
        }
        
        return $this->db->query($sql)->result();
    }

    public function read_mesin_qr($id_mesin)
    {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik WHERE tag.rel_stat!='OK' AND tag.id_mesin='$id_mesin' ORDER BY tag.tgl_tag ASC";
        return $this->db->query($sql)->result();
    }

    public function readall_range($start,$stop,$id_mesin)
    {
        $id_sect = $this->session->userdata('id_sect');
        if($id_mesin=="ALL")
        {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik WHERE tag.id_pic='$id_sect'  AND (tag.tgl_tag BETWEEN '$start' AND '$stop') ORDER BY tag.tgl_tag ASC";
        }
        else
        {
            $sql = "SELECT * FROM tag JOIN mesin ON tag.id_mesin=mesin.id_mesin JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag.tager=karyawan.nik WHERE tag.id_pic='$id_sect' AND tag.id_mesin='$id_mesin' AND (tag.tgl_tag BETWEEN '$start' AND '$stop') ORDER BY tag.tgl_tag ASC";
        }
        
        return $this->db->query($sql)->result();
    }

    public function readbyid($id_tag)
    {
        $sql = "SELECT * FROM tag_release LEFT JOIN tag ON tag_release.id_tag=tag.id_tag LEFT JOIN mesin ON tag.id_mesin=mesin.id_mesin LEFT JOIN mesin_unit ON tag.id_unit=mesin_unit.id_unitmesin LEFT JOIN karyawan ON tag_release.pelaksana1=karyawan.nik LEFT JOIN user ON tag.tager=user.username WHERE tag_release.id_tag='$id_tag' ORDER BY tag_release.tgl_rel ASC";
        return $this->db->query($sql)->result();
    }

    public function do_release($data,$id_tag,$rel_stat)
    {
        $this->db->insert('tag_release',$data);
        $this->db->where('id_tag',$id_tag);
        $this->db->update('tag',array('rel_stat'=>$rel_stat));
    }

    public function rows($id_sect)
    {
        $sql = "SELECT lkh.id_lkh FROM lkh WHERE lkh.id_sect='$id_sect'";
        return $this->db->query($sql)->num_rows();
    }

    public function input($data)
    {
        $this->db->insert('lkh',$data);
    }

    public function delete($id_lkh)
    {
        $this->db->where("id_lkh",$id_lkh);
        $this->db->delete("lkh");
    }

    public function update($data,$id_lkh)
    {
        $this->db->where("id_lkh",$id_lkh);
        $this->db->update("lkh",$data);
    }

    public function updatelanjutan($reff_id,$finish)
    {
        $this->db->where("reff_id",$reff_id);
        $data = array('finish'=>$finish);
        $this->db->update("lkh",$data);
    }

    public function acc($id_lkh,$username)
    {
        $this->db->where("id_lkh",$id_lkh);
        $data = array('acc'=>$username);
        $this->db->update("lkh",$data);
    }
}
