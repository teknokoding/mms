<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_sjbk extends CI_Model {

    public function readbyid($id_bengkel)
    {
        $sql = "SELECT * FROM bengkel_detail JOIN bengkel ON bengkel_detail.id_bengkel=bengkel.id_bengkel LEFT JOIN mesin ON bengkel_detail.id_mesin=mesin.id_mesin LEFT JOIN satuan ON bengkel_detail.id_satuan=satuan.id_satuan LEFT JOIN user ON bengkel.input=user.username WHERE bengkel_detail.id_bengkel='$id_bengkel'";
        return $this->db->query($sql)->result();
    }

    public function readbysect($id_sect,$start,$stop,$id_mesin)
    {
        if ($id_mesin=="ALL") {
            $sql = "SELECT A.*,bengkel.*,mesin.*,satuan.*,user.*,(SELECT COUNT(id_bengkel) FROM bengkel_detail WHERE id_bengkel=A.id_bengkel) AS jumlah FROM bengkel_detail A JOIN bengkel ON A.id_bengkel=bengkel.id_bengkel LEFT JOIN mesin ON A.id_mesin=mesin.id_mesin LEFT JOIN satuan ON A.id_satuan=satuan.id_satuan LEFT JOIN user ON bengkel.input=user.username WHERE bengkel.id_sect='$id_sect' AND bengkel.tgl_kirim BETWEEN '$start' AND '$stop' ORDER BY A.id_bengkel_detail DESC";
        }
        else
        {
            $sql = "SELECT A.*,bengkel.*,mesin.*,satuan.*,user.*,(SELECT COUNT(id_bengkel) FROM bengkel_detail WHERE id_bengkel=A.id_bengkel AND id_mesin='$id_mesin') AS jumlah FROM bengkel_detail A JOIN bengkel ON A.id_bengkel=bengkel.id_bengkel LEFT JOIN mesin ON A.id_mesin=mesin.id_mesin LEFT JOIN satuan ON A.id_satuan=satuan.id_satuan LEFT JOIN user ON bengkel.input=user.username WHERE bengkel.id_sect='$id_sect'  AND A.id_mesin='$id_mesin' AND bengkel.tgl_kirim BETWEEN '$start' AND '$stop' ORDER BY A.id_bengkel_detail DESC";
        }
        return $this->db->query($sql)->result();
    }

    public function rows($id_sect)
    {
        $sql = "SELECT * FROM bengkel_detail JOIN bengkel ON bengkel_detail.id_bengkel=bengkel.id_bengkel WHERE bengkel.id_sect='$id_sect'";
        return $this->db->query($sql)->num_rows();
    }

    public function create_temp($data)
    {
        $this->db->insert('bengkel_temp',$data);
    }
    public function create_detail($data)
    {
        $this->db->insert('bengkel_detail',$data);
    }
    public function read_temp($id_bengkel)
    {
        $sql = "SELECT * FROM bengkel_temp JOIN mesin ON bengkel_temp.id_mesin=mesin.id_mesin JOIN satuan ON bengkel_temp.id_satuan=satuan.id_satuan  WHERE bengkel_temp.id_bengkel='$id_bengkel' ORDER BY bengkel_temp.id_bengkel_temp DESC";
        return $this->db->query($sql)->result();
    }
    public function read_temp_detail($id_bengkel_temp)
    {
        $sql = "SELECT * FROM bengkel_temp JOIN mesin ON bengkel_temp.id_mesin=mesin.id_mesin JOIN satuan ON bengkel_temp.id_satuan=satuan.id_satuan  WHERE bengkel_temp.id_bengkel_temp='$id_bengkel_temp'";
        return $this->db->query($sql)->result();
    }
    public function read_detail($id_bengkel)
    {
        $sql = "SELECT * FROM bengkel_detail JOIN mesin ON bengkel_detail.id_mesin=mesin.id_mesin JOIN satuan ON bengkel_detail.id_satuan=satuan.id_satuan  WHERE bengkel_detail.id_bengkel='$id_bengkel'";
        return $this->db->query($sql)->result();
    }

    public function read_item_detail($id_bengkel_detail)
    {
        $sql = "SELECT * FROM bengkel_detail JOIN mesin ON bengkel_detail.id_mesin=mesin.id_mesin JOIN satuan ON bengkel_detail.id_satuan=satuan.id_satuan  WHERE bengkel_detail.id_bengkel_detail='$id_bengkel_detail'";
        return $this->db->query($sql)->result();
    }

    public function update_temp($id_bengkel_temp,$data)
    {
        $this->db->where('id_bengkel_temp',$id_bengkel_temp);
        $this->db->update('bengkel_temp',$data);
    }
    public function update_detail($id_bengkel_detail,$data)
    {
        $this->db->where('id_bengkel_detail',$id_bengkel_detail);
        $this->db->update('bengkel_detail',$data);
    }
    
    public function finish($id_bengkel)
    {
        $sql = "SELECT id_bengkel,nama_barang,id_mesin,qty_kirim,id_satuan,note FROM bengkel_temp WHERE id_bengkel='$id_bengkel'";
        $data_detail = $this->db->query($sql)->result();    
        $data_sjbk = array(
            "id_bengkel"=>$id_bengkel,
            "tgl_kirim"=>date('Y-m-d'),
            "id_sect"=>$this->session->userdata('id_sect'),
            "id_dept"=>$this->session->userdata('id_dept'),
            "input"=>$this->session->userdata('username'),
        );
        $this->db->insert('bengkel',$data_sjbk);
        $this->db->insert_batch('bengkel_detail',$data_detail);
        $this->db->where('id_bengkel',$id_bengkel);
        $this->db->delete('bengkel_temp');
    }

    public function finish_edit($id_bengkel)
    {
       $this->db->where('id_bengkel',$id_bengkel);
       $this->db->update('bengkel',array('input'=>$this->session->userdata('username')));
    }

}

/* End of_bengkel.php */

?>