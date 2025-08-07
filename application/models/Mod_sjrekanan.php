<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_sjrekanan extends CI_Model {

    public function readbyid($id_lain)
    {
        $sql = "SELECT * FROM lain_detail JOIN lain ON lain_detail.id_lain=lain.id_lain LEFT JOIN mesin ON lain_detail.id_mesin=mesin.id_mesin LEFT JOIN satuan ON lain_detail.id_satuan=satuan.id_satuan LEFT JOIN user ON lain.input=user.username LEFT JOIN relasi ON lain.id_relasi=relasi.id_relasi WHERE lain_detail.id_lain='$id_lain'";
        return $this->db->query($sql)->result();
    }

    public function readbysect($id_sect,$start,$stop,$id_relasi)
    {
        if($id_relasi=="ALL")
        {
            $sql = "SELECT A.*,lain.*,mesin.*,satuan.*,user.*,relasi.*,(SELECT COUNT(id_lain) FROM lain_detail WHERE id_lain=A.id_lain) AS jumlah FROM lain_detail A JOIN lain ON A.id_lain=lain.id_lain LEFT JOIN mesin ON A.id_mesin=mesin.id_mesin LEFT JOIN satuan ON A.id_satuan=satuan.id_satuan LEFT JOIN user ON lain.input=user.username  LEFT JOIN relasi ON lain.id_relasi=relasi.id_relasi  WHERE lain.id_sect='$id_sect' AND lain.tgl_kirim BETWEEN '$start' AND '$stop' ORDER BY A.id_lain_detail DESC";
        }
        else
        {
            $sql = "SELECT A.*,lain.*,mesin.*,satuan.*,user.*,relasi.*,(SELECT COUNT(id_lain) FROM lain_detail WHERE id_lain=A.id_lain) AS jumlah FROM lain_detail A JOIN lain ON A.id_lain=lain.id_lain LEFT JOIN mesin ON A.id_mesin=mesin.id_mesin LEFT JOIN satuan ON A.id_satuan=satuan.id_satuan LEFT JOIN user ON lain.input=user.username  LEFT JOIN relasi ON lain.id_relasi=relasi.id_relasi  WHERE lain.id_sect='$id_sect' AND lain.id_relasi='$id_relasi' AND lain.tgl_kirim BETWEEN '$start' AND '$stop' ORDER BY A.id_lain_detail DESC";
        }
        
        return $this->db->query($sql)->result();
    }

    public function readbysect2($id_sect,$limit,$start)
    {
        $sql = "SELECT A.*,lain.*,mesin.*,satuan.*,user.*,relasi.*,(SELECT COUNT(id_lain) FROM lain_detail WHERE id_lain=A.id_lain) AS jumlah FROM lain_detail A JOIN lain ON A.id_lain=lain.id_lain LEFT JOIN mesin ON A.id_mesin=mesin.id_mesin LEFT JOIN satuan ON A.id_satuan=satuan.id_satuan LEFT JOIN user ON lain.input=user.username  LEFT JOIN relasi ON lain.id_relasi=relasi.id_relasi  WHERE lain.id_sect='$id_sect' ORDER BY A.id_lain_detail DESC";
        return $this->db->query($sql)->result();
    }

    public function rows($id_sect)
    {
        $sql = "SELECT * FROM lain_detail JOIN lain ON lain_detail.id_lain=lain.id_lain WHERE lain.id_sect='$id_sect'";
        return $this->db->query($sql)->num_rows();
    }

    public function create_temp($data)
    {
        $this->db->insert('lain_temp',$data);
    }
    public function create_detail($data)
    {
        $this->db->insert('lain_detail',$data);
    }
    public function read_temp($id_lain)
    {
        $sql = "SELECT * FROM lain_temp JOIN mesin ON lain_temp.id_mesin=mesin.id_mesin JOIN satuan ON lain_temp.id_satuan=satuan.id_satuan  WHERE lain_temp.id_lain='$id_lain' ORDER BY lain_temp.id_lain_temp DESC";
        return $this->db->query($sql)->result();
    }
    public function read_temp_detail($id_lain_temp)
    {
        $sql = "SELECT * FROM lain_temp JOIN mesin ON lain_temp.id_mesin=mesin.id_mesin JOIN satuan ON lain_temp.id_satuan=satuan.id_satuan  WHERE lain_temp.id_lain_temp='$id_lain_temp'";
        return $this->db->query($sql)->result();
    }
    public function read_detail($id_lain)
    {
        $sql = "SELECT * FROM lain_detail JOIN mesin ON lain_detail.id_mesin=mesin.id_mesin JOIN satuan ON lain_detail.id_satuan=satuan.id_satuan  JOIN lain ON lain_detail.id_lain=lain.id_lain JOIN relasi ON lain.id_relasi=relasi.id_relasi WHERE lain_detail.id_lain='$id_lain'";
        return $this->db->query($sql)->result();
    }

    public function read_item_detail($id_lain_detail)
    {
        $sql = "SELECT * FROM lain_detail JOIN mesin ON lain_detail.id_mesin=mesin.id_mesin JOIN satuan ON lain_detail.id_satuan=satuan.id_satuan  WHERE lain_detail.id_lain_detail='$id_lain_detail'";
        return $this->db->query($sql)->result();
    }

    public function update_temp($id_lain_temp,$data)
    {
        $this->db->where('id_lain_temp',$id_lain_temp);
        $this->db->update('lain_temp',$data);
    }
    public function update_detail($id_lain_detail,$data)
    {
        $this->db->where('id_lain_detail',$id_lain_detail);
        $this->db->update('lain_detail',$data);
    }
    
    public function finish($id_lain,$id_relasi)
    {
        $sql = "SELECT id_lain,nama_barang,id_mesin,qty_kirim,id_satuan,note FROM lain_temp WHERE id_lain='$id_lain'";
        $data_detail = $this->db->query($sql)->result();    
        $data_sjrekanan = array(
            "id_lain"=>$id_lain,
            "tgl_kirim"=>date('Y-m-d'),
            "id_sect"=>$this->session->userdata('id_sect'),
            "id_dept"=>$this->session->userdata('id_dept'),
            "input"=>$this->session->userdata('username'),
            "id_relasi"=>$id_relasi,
        );
        $this->db->insert('lain',$data_sjrekanan);
        $this->db->insert_batch('lain_detail',$data_detail);
        $this->db->where('id_lain',$id_lain);
        $this->db->delete('lain_temp');
    }

    public function finish_edit($id_lain,$id_relasi)
    {
       $this->db->where('id_lain',$id_lain);
       $this->db->update('lain',array('id_relasi'=>$id_relasi,'input'=>$this->session->userdata('username')));
    }

}

/* End of_lain.php */

?>