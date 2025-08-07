<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_spkbk extends CI_Model {

    public function readbyid($id_spkbk)
    {
        $sql = "SELECT * FROM spkbk_detail JOIN spkbk ON spkbk_detail.id_spkbk=spkbk.id_spkbk LEFT JOIN mesin ON spkbk_detail.id_mesin=mesin.id_mesin LEFT JOIN satuan ON spkbk_detail.id_satuan=satuan.id_satuan LEFT JOIN user ON spkbk.acc=user.username WHERE spkbk_detail.id_spkbk='$id_spkbk'";
        return $this->db->query($sql)->result();
    }

    public function readbysect($id_sect,$start,$stop,$id_mesin)
    {
        if($id_mesin=="ALL")
        {
            $sql = "SELECT A.*,spkbk.*,mesin.*,satuan.*,user.*,(SELECT COUNT(id_spkbk) FROM spkbk_detail WHERE id_spkbk=A.id_spkbk) AS jumlah FROM spkbk_detail A JOIN spkbk ON A.id_spkbk=spkbk.id_spkbk LEFT JOIN mesin ON A.id_mesin=mesin.id_mesin LEFT JOIN satuan ON A.id_satuan=satuan.id_satuan LEFT JOIN user ON spkbk.acc=user.username WHERE spkbk.id_sect='$id_sect' AND spkbk.tgl_spk BETWEEN '$start' AND '$stop' ORDER BY A.id_spkbk_detail DESC";
        }
        else
        {
            $sql = "SELECT A.*,spkbk.*,mesin.*,satuan.*,user.*,(SELECT COUNT(id_spkbk) FROM spkbk_detail WHERE id_spkbk=A.id_spkbk AND id_mesin='$id_mesin') AS jumlah FROM spkbk_detail A JOIN spkbk ON A.id_spkbk=spkbk.id_spkbk JOIN mesin ON A.id_mesin=mesin.id_mesin LEFT JOIN satuan ON A.id_satuan=satuan.id_satuan LEFT JOIN user ON spkbk.acc=user.username WHERE spkbk.id_sect='$id_sect' AND A.id_mesin='$id_mesin' AND spkbk.tgl_spk BETWEEN '$start' AND '$stop' ORDER BY A.id_spkbk_detail DESC";
        }
        return $this->db->query($sql)->result();
    }

    public function rows($id_sect)
    {
        $sql = "SELECT * FROM spkbk_detail JOIN spkbk ON spkbk_detail.id_spkbk=spkbk.id_spkbk WHERE spkbk.id_sect='$id_sect'";
        return $this->db->query($sql)->num_rows();
    }

    public function create_temp($data)
    {
        $this->db->insert('spkbk_temp',$data);
    }
    public function create_detail($data)
    {
        $this->db->insert('spkbk_detail',$data);
    }
    public function read_temp($id_spkbk)
    {
        $sql = "SELECT * FROM spkbk_temp JOIN mesin ON spkbk_temp.id_mesin=mesin.id_mesin JOIN satuan ON spkbk_temp.id_satuan=satuan.id_satuan  WHERE spkbk_temp.id_spkbk='$id_spkbk' ORDER BY spkbk_temp.id_spkbk_temp DESC";
        return $this->db->query($sql)->result();
    }
    public function read_temp_detail($id_spkbk_temp)
    {
        $sql = "SELECT * FROM spkbk_temp JOIN mesin ON spkbk_temp.id_mesin=mesin.id_mesin JOIN satuan ON spkbk_temp.id_satuan=satuan.id_satuan  WHERE spkbk_temp.id_spkbk_temp='$id_spkbk_temp'";
        return $this->db->query($sql)->result();
    }
    public function read_detail($id_spkbk)
    {
        $sql = "SELECT * FROM spkbk_detail JOIN mesin ON spkbk_detail.id_mesin=mesin.id_mesin JOIN satuan ON spkbk_detail.id_satuan=satuan.id_satuan  WHERE spkbk_detail.id_spkbk='$id_spkbk'";
        return $this->db->query($sql)->result();
    }

    public function read_item_detail($id_spkbk_detail)
    {
        $sql = "SELECT * FROM spkbk_detail JOIN mesin ON spkbk_detail.id_mesin=mesin.id_mesin JOIN satuan ON spkbk_detail.id_satuan=satuan.id_satuan  WHERE spkbk_detail.id_spkbk_detail='$id_spkbk_detail'";
        return $this->db->query($sql)->result();
    }

    public function update_temp($id_spkbk_temp,$data)
    {
        $this->db->where('id_spkbk_temp',$id_spkbk_temp);
        $this->db->update('spkbk_temp',$data);
    }
    public function update_detail($id_spkbk_detail,$data)
    {
        $this->db->where('id_spkbk_detail',$id_spkbk_detail);
        $this->db->update('spkbk_detail',$data);
    }
    public function draft($id_spkbk)
    {
        $sql = "SELECT id_spkbk,nama_barang,spesifikasi,id_mesin,qty_minta,id_satuan,status_pesan,note FROM spkbk_temp WHERE id_spkbk='$id_spkbk'";
        $data_detail = $this->db->query($sql)->result();    
        $data_spk = array(
            "id_spkbk"=>$id_spkbk,
            "tgl_spk"=>date('Y-m-d'),
            "id_sect"=>$this->session->userdata('id_sect'),
            "id_dept"=>$this->session->userdata('id_dept'),
            "input"=>$this->session->userdata('username')
        );
        $this->db->insert('spkbk',$data_spk);
        $this->db->insert_batch('spkbk_detail',$data_detail);
    }

    public function draft_edit($id_spkbk)
    {
       $this->db->where('id_spkbk',$id_spkbk);
       $this->db->update('spkbk',array('valid'=>'N'));
    }

    public function finish($id_spkbk)
    {
        $sql = "SELECT id_spkbk,nama_barang,spesifikasi,id_mesin,qty_minta,id_satuan,status_pesan,note FROM spkbk_temp WHERE id_spkbk='$id_spkbk'";
        $data_detail = $this->db->query($sql)->result();    
        $data_spk = array(
            "id_spkbk"=>$id_spkbk,
            "tgl_spk"=>date('Y-m-d'),
            "id_sect"=>$this->session->userdata('id_sect'),
            "id_dept"=>$this->session->userdata('id_dept'),
            "input"=>$this->session->userdata('username'),
            "valid"=>"Y",
            "acc"=>$this->session->userdata('username'),
        );
        $this->db->insert('spkbk',$data_spk);
        $this->db->insert_batch('spkbk_detail',$data_detail);
        $this->db->where('id_spkbk',$id_spkbk);
        $this->db->delete('spkbk_temp');
    }

    public function finish_edit($id_spkbk)
    {
       $this->db->where('id_spkbk',$id_spkbk);
       $this->db->update('spkbk',array('valid'=>'Y','acc'=>$this->session->userdata('username')));
    }

}

/* End of_spkbk.php */

?>