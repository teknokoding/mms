<?php
class Mod_lkh extends CI_Model
{
    public function read($id_sect, $limit, $start)
    {
        //$sql = "SELECT * FROM lkh LEFT JOIN mesin ON lkh.id_mesin=mesin.id_mesin LEFT JOIN mesin_unit ON lkh.id_unit_mesin=mesin_unit.id_unitmesin  WHERE lkh.id_sect='$id_sect' ORDER BY lkh.id_lkh DESC LIMIT $limit OFFSET $start";
        $sql = "SELECT lkh.finish,lkh.id_lkh,lkh.jenislkh,DATE_FORMAT(lkh.tgllkh,'%d/%m/%y') AS tgllkhformat,lkh.tgllkh,lkh.waktumulai,lkh.waktuselesai,lkh.shift,lkh.detail,lkh.keluhan,lkh.uraian,lkh.keterangan,lkh.status,lkh.finish,lkh.durasi,lkh.pengisilaporan,lkh.reff_id,lkh.acc,mesin.nama_mesin,mesin_unit.nama_unitmesin FROM lkh LEFT JOIN mesin ON lkh.id_mesin=mesin.id_mesin LEFT JOIN mesin_unit ON lkh.id_unit_mesin=mesin_unit.id_unitmesin  WHERE lkh.id_sect='$id_sect' ORDER by lkh.id_lkh DESC LIMIT $limit OFFSET $start";
        return $this->db->query($sql)->result();
    }
    public function read_search($id_sect, $awal, $akhir, $id_mesin)
    {
        if ($id_mesin=="ALL") {
            $sql = "SELECT lkh.finish,lkh.id_lkh,lkh.jenislkh,DATE_FORMAT(lkh.tgllkh,'%d/%m/%y') AS tgllkhformat,lkh.tgllkh,lkh.waktumulai,lkh.waktuselesai,lkh.shift,lkh.detail,lkh.keluhan,lkh.uraian,lkh.keterangan,lkh.status,lkh.finish,lkh.durasi,lkh.pengisilaporan,lkh.reff_id,lkh.acc,mesin.nama_mesin,mesin_unit.nama_unitmesin FROM lkh LEFT JOIN mesin ON lkh.id_mesin=mesin.id_mesin LEFT JOIN mesin_unit ON lkh.id_unit_mesin=mesin_unit.id_unitmesin  WHERE lkh.id_sect='$id_sect' AND (lkh.tgllkh BETWEEN '$awal' AND'$akhir') ORDER by lkh.id_lkh DESC";
        } else {
            $sql = "SELECT lkh.finish,lkh.id_lkh,lkh.jenislkh,DATE_FORMAT(lkh.tgllkh,'%d/%m/%y') AS tgllkhformat,lkh.tgllkh,lkh.waktumulai,lkh.waktuselesai,lkh.shift,lkh.detail,lkh.keluhan,lkh.uraian,lkh.keterangan,lkh.status,lkh.finish,lkh.durasi,lkh.pengisilaporan,lkh.reff_id,lkh.acc,mesin.nama_mesin,mesin_unit.nama_unitmesin FROM lkh LEFT JOIN mesin ON lkh.id_mesin=mesin.id_mesin LEFT JOIN mesin_unit ON lkh.id_unit_mesin=mesin_unit.id_unitmesin  WHERE lkh.id_sect='$id_sect' AND (lkh.tgllkh BETWEEN '$awal' AND '$akhir') AND lkh.id_mesin='$id_mesin' ORDER by lkh.id_lkh DESC";
        }
        return $this->db->query($sql)->result();
    }

    public function readbreakdown_range($awal, $akhir, $id_mesin)
    {
        $id_sect=$this->session->userdata('id_sect');
        if ($id_mesin=="ALL") {
            $sql = "SELECT lkh.finish,lkh.id_lkh,lkh.jenislkh,DATE_FORMAT(lkh.tgllkh,'%d/%m/%y') AS tgllkhformat,lkh.tgllkh,lkh.waktumulai,lkh.waktuselesai,lkh.shift,lkh.detail,lkh.keluhan,lkh.uraian,lkh.keterangan,lkh.status,lkh.finish,lkh.durasi,lkh.pengisilaporan,lkh.reff_id,lkh.acc,mesin.nama_mesin,mesin_unit.nama_unitmesin FROM lkh LEFT JOIN mesin ON lkh.id_mesin=mesin.id_mesin LEFT JOIN mesin_unit ON lkh.id_unit_mesin=mesin_unit.id_unitmesin  WHERE lkh.id_sect='$id_sect' AND lkh.reff_id!='' AND (lkh.tgllkh BETWEEN '$awal' AND'$akhir') GROUP BY lkh.reff_id ORDER BY lkh.id_lkh DESC";
        } else {
            $sql = "SELECT lkh.finish,lkh.id_lkh,lkh.jenislkh,DATE_FORMAT(lkh.tgllkh,'%d/%m/%y') AS tgllkhformat,lkh.tgllkh,lkh.waktumulai,lkh.waktuselesai,lkh.shift,lkh.detail,lkh.keluhan,lkh.uraian,lkh.keterangan,lkh.status,lkh.finish,lkh.durasi,lkh.pengisilaporan,lkh.reff_id,lkh.acc,mesin.nama_mesin,mesin_unit.nama_unitmesin FROM lkh LEFT JOIN mesin ON lkh.id_mesin=mesin.id_mesin LEFT JOIN mesin_unit ON lkh.id_unit_mesin=mesin_unit.id_unitmesin  WHERE lkh.id_sect='$id_sect'  AND lkh.reff_id!='' AND (lkh.tgllkh BETWEEN '$awal' AND '$akhir') AND lkh.id_mesin='$id_mesin' GROUP BY lkh.reff_id ORDER BY lkh.id_lkh DESC";
        }
        return $this->db->query($sql)->result();
    }

    public function readdetail($id_lkh)
    {
        $sql = "SELECT lkh.acc_time,lkh.id_lkh,lkh.jenislkh,DATE_FORMAT(lkh.tgllkh,'%d/%m/%y') AS tgllkhformat,lkh.tgllkh,lkh.waktumulai,lkh.waktuselesai,lkh.shift,lkh.detail,lkh.keluhan,lkh.uraian,lkh.keterangan,lkh.status,lkh.finish,lkh.durasi,lkh.pengisilaporan,lkh.pelaksana1,lkh.pelaksana2,lkh.pelaksana3,lkh.pelaksana4,lkh.pelaksana5,lkh.pelaksana6,lkh.reff_id,lkh.acc,lkh.id_mesin,lkh.id_unit_mesin,lkh.reff_id  FROM lkh WHERE lkh.id_lkh='$id_lkh'";
        return $this->db->query($sql)->result();
    }

    public function readbyreffid($reff_id)
    {
        $sql = "SELECT lkh.jenislkh,DATE_FORMAT(lkh.tgllkh,'%d/%m/%y') AS tgllkhformat,lkh.tgllkh,lkh.waktumulai,lkh.waktuselesai,lkh.shift,lkh.detail,lkh.keluhan,lkh.uraian,lkh.keterangan,lkh.status,lkh.finish,lkh.durasi,lkh.id_mesin,lkh.id_unit_mesin,lkh.reff_id,mesin.nama_mesin,mesin_unit.nama_unitmesin,user.namalengkap FROM lkh LEFT JOIN mesin ON lkh.id_mesin=mesin.id_mesin LEFT JOIN mesin_unit ON lkh.id_unit_mesin=mesin_unit.id_unitmesin  LEFT JOIN user ON lkh.pengisilaporan=user.username WHERE lkh.reff_id='$reff_id' ORDER by lkh.tgllkh ASC";
        return $this->db->query($sql)->result();
    }

    public function rows($id_sect)
    {
        $sql = "SELECT lkh.id_lkh FROM lkh WHERE lkh.id_sect='$id_sect'";
        return $this->db->query($sql)->num_rows();
    }

    public function rows_search($id_sect, $awal, $akhir, $id_mesin)
    {
        if ($id_mesin=="ALL") {
            $sql = "SELECT lkh.id_lkh FROM lkh WHERE lkh.id_sect='$id_sect' AND (lkh.tgllkh BETWEEN '$awal' AND '$akhir')";
        } else {
            $sql = "SELECT lkh.id_lkh FROM lkh WHERE lkh.id_sect='$id_sect' AND (lkh.tgllkh BETWEEN '$awal' AND '$akhir') AND lkh.id_mesin='$id_mesin'";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function input($data)
    {
        $this->db->insert('lkh', $data);
    }

    public function delete($id_lkh)
    {
        $this->db->where("id_lkh", $id_lkh);
        $this->db->delete("lkh");
    }

    public function update($data, $id_lkh)
    {
        $this->db->where("id_lkh", $id_lkh);
        $this->db->update("lkh", $data);
    }

    public function updatelanjutan($reff_id, $finish)
    {
        $this->db->where("reff_id", $reff_id);
        $data = array('finish'=>$finish);
        $this->db->update("lkh", $data);
    }

    public function acc($id_lkh, $username)
    {
        $this->db->where("id_lkh", $id_lkh);
        $data = array('acc'=>$username);
        $this->db->update("lkh", $data);
    }
}
