<?php
class Mod_breakdown extends CI_Model
{
    public function read($id_sect)
    {
        $sql = "SELECT * FROM lkh JOIN mesin ON lkh.id_mesin=mesin.id_mesin JOIN mesin_unit ON lkh.id_unit_mesin=mesin_unit.id_unitmesin WHERE lkh.finish='0' AND lkh.id_sect='$id_sect' GROUP BY lkh.reff_id ORDER BY lkh.tgllkh DESC";
        return $this->db->query($sql)->result();
    }

    public function readbymesin($id_mesin)
    {
        $sql = "SELECT * FROM lkh JOIN mesin ON lkh.id_mesin=mesin.id_mesin JOIN mesin_unit ON lkh.id_unit_mesin=mesin_unit.id_unitmesin WHERE lkh.finish='0' AND lkh.id_mesin='$id_mesin' GROUP BY lkh.reff_id ORDER BY lkh.tgllkh DESC";
        return $this->db->query($sql)->result();
    }

    public function readdetail($id_lkh)
    {
        $sql = "SELECT lkh.acc_time,lkh.id_lkh,lkh.jenislkh,DATE_FORMAT(lkh.tgllkh,'%d/%m/%y') AS tgllkhformat,lkh.tgllkh,lkh.waktumulai,lkh.waktuselesai,lkh.shift,lkh.shift,lkh.detail,lkh.keluhan,lkh.uraian,lkh.keterangan,lkh.status,lkh.finish,lkh.waktumulai,lkh.waktuselesai,lkh.durasi,lkh.pengisilaporan,lkh.pelaksana1,lkh.pelaksana2,lkh.pelaksana3,lkh.pelaksana4,lkh.pelaksana5,lkh.pelaksana6,lkh.reff_id,lkh.acc,lkh.id_mesin,lkh.id_unit_mesin,lkh.reff_id FROM lkh WHERE lkh.id_lkh='$id_lkh'";
        return $this->db->query($sql)->result();
    }

    public function readbyreffid($reff_id)
    {
        $sql = "SELECT lkh.jenislkh,DATE_FORMAT(lkh.tgllkh,'%d/%m/%y') AS tgllkhformat,lkh.tgllkh,lkh.waktumulai,lkh.waktuselesai,lkh.shift,lkh.shift,lkh.detail,lkh.keluhan,lkh.uraian,lkh.keterangan,lkh.status,lkh.finish,lkh.waktumulai,lkh.waktuselesai,lkh.durasi,lkh.id_mesin,lkh.id_unit_mesin,lkh.reff_id,mesin.nama_mesin,mesin_unit.nama_unitmesin FROM lkh LEFT JOIN mesin ON lkh.id_mesin=mesin.id_mesin LEFT JOIN mesin_unit ON lkh.id_unit_mesin=mesin_unit.id_unitmesin WHERE lkh.reff_id='$reff_id' ORDER by lkh.tgllkh DESC";
        return $this->db->query($sql)->result();
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
