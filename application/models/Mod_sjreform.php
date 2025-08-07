<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_sjreform extends CI_Model {

    public function readbyid($id_reform)
    {
        $sql = "SELECT * FROM reform_detail JOIN reform ON reform_detail.id_reform=reform.id_reform LEFT JOIN pisau ON reform_detail.id_pisau=pisau.id_pisau LEFT JOIN user ON reform.pengirim=user.username LEFT JOIN klien ON reform.id_klien=klien.id_klien WHERE reform_detail.id_reform='$id_reform'";
        return $this->db->query($sql)->result();
    }

    public function read($start,$stop,$id_klien)
    {
        if($id_klien=="ALL")
        {
            $sql = "SELECT A.*,reform.*,pisau.*,user.*,klien.*,(SELECT COUNT(id_reform) FROM reform_detail WHERE id_reform=A.id_reform) AS jumlah FROM reform_detail A JOIN reform ON A.id_reform=reform.id_reform LEFT JOIN pisau ON A.id_pisau=pisau.id_pisau LEFT JOIN user ON reform.pengirim=user.username  LEFT JOIN klien ON reform.id_klien=klien.id_klien  WHERE reform.tgl_kirim BETWEEN 'start' AND '$stop' ORDER BY A.id_reform_detail DESC";
        }
        else
        {
            $sql = "SELECT A.*,reform.*,pisau.*,user.*,klien.*,(SELECT COUNT(id_reform) FROM reform_detail WHERE id_reform=A.id_reform) AS jumlah FROM reform_detail A JOIN reform ON A.id_reform=reform.id_reform LEFT JOIN pisau ON A.id_pisau=pisau.id_pisau LEFT JOIN user ON reform.pengirim=user.username  LEFT JOIN klien ON reform.id_klien=klien.id_klien  WHERE reform.id_klien='$id_klien' AND reform.tgl_kirim BETWEEN 'start' AND '$stop' ORDER BY A.id_reform_detail DESC";
        }
        
        return $this->db->query($sql)->result();
    }
    
    public function readbysect($id_sect,$limit,$start)
    {
        $sql = "SELECT A.*,reform.*,pisau.*,user.*,klien.*,(SELECT COUNT(id_reform) FROM reform_detail WHERE id_reform=A.id_reform) AS jumlah FROM reform_detail A JOIN reform ON A.id_reform=reform.id_reform LEFT JOIN pisau ON A.id_pisau=pisau.id_pisau LEFT JOIN user ON reform.pengirim=user.username  LEFT JOIN klien ON reform.id_klien=klien.id_klien  ORDER BY A.id_reform_detail DESC LIMIT $limit OFFSET $start";
        return $this->db->query($sql)->result();
    }

    public function rows($id_sect)
    {
        $sql = "SELECT * FROM reform_detail JOIN reform ON reform_detail.id_reform=reform.id_reform";
        return $this->db->query($sql)->num_rows();
    }

    public function create_temp($data)
    {
        $this->db->insert('reform_temp',$data);
    }
    public function create_detail($data)
    {
        $this->db->insert('reform_detail',$data);
    }
    public function read_temp($id_reform)
    {
        $sql = "SELECT * FROM reform_temp JOIN pisau ON reform_temp.id_pisau=pisau.id_pisau WHERE reform_temp.id_reform='$id_reform' ORDER BY reform_temp.id_reform_temp DESC";
        return $this->db->query($sql)->result();
    }
    public function read_temp_detail($id_reform_temp)
    {
        $sql = "SELECT * FROM reform_temp JOIN pisau ON reform_temp.id_pisau=pisau.id_pisau WHERE reform_temp.id_reform_temp='$id_reform_temp'";
        return $this->db->query($sql)->result();
    }
    public function read_detail($id_reform)
    {
        $sql = "SELECT * FROM reform_detail JOIN reform ON reform_detail.id_reform=reform.id_reform JOIN pisau ON reform_detail.id_pisau=pisau.id_pisau  WHERE reform_detail.id_reform='$id_reform'";
        return $this->db->query($sql)->result();
    }

    public function read_item_detail($id_reform_detail)
    {
        $sql = "SELECT * FROM reform_detail JOIN pisau ON reform_detail.id_pisau=pisau.id_pisau  WHERE reform_detail.id_reform_detail='$id_reform_detail'";
        return $this->db->query($sql)->result();
    }

    public function update_temp($id_reform_temp,$data)
    {
        $this->db->where('id_reform_temp',$id_reform_temp);
        $this->db->update('reform_temp',$data);
    }
    public function update_detail($id_reform_detail,$data)
    {
        $this->db->where('id_reform_detail',$id_reform_detail);
        $this->db->update('reform_detail',$data);
    }
    
    public function finish($id_reform,$id_klien)
    {
        $sql = "SELECT id_reform,id_pisau,qty_kirim,note FROM reform_temp WHERE id_reform='$id_reform'";
        $data_detail = $this->db->query($sql)->result();    
        $data_sjreform = array(
            "id_reform"=>$id_reform,
            "tgl_kirim"=>date('Y-m-d'),
            "id_klien"=>$id_klien,
            "pengirim"=>$this->session->userdata('username'),
        );
        $this->db->insert('reform',$data_sjreform);
        $this->db->insert_batch('reform_detail',$data_detail);
        $this->db->where('id_reform',$id_reform);
        $this->db->delete('reform_temp');
    }

    public function finish_edit($id_reform,$id_klien)
    {
       $this->db->where('id_reform',$id_reform);
       $this->db->update('reform',array('id_klien'=>$id_klien,'pengirim'=>$this->session->userdata('username')));
    }

}

/* End of_reform.php */

?>