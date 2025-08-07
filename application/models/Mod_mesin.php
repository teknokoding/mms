<?php
class Mod_mesin extends CI_Model
{
    public function read()
    {
        $sql = "SELECT * FROM mesin LEFT JOIN sect ON mesin.id_sect=sect.id_sect ORDER BY nama_mesin ASC";
        return  $this->db->query($sql)->result();
    }

    public function rows()
    {
        $sql = "SELECT * FROM mesin";
        return  $this->db->query($sql)->num_rows();
    }

    public function readbymnt($id_sect)
    {
        
        if($this->session->userdata('id_sect')=='5')
        {
            $sql = "SELECT * FROM mesin WHERE (id_sect = '2' OR id_sect = '$id_sect' OR id_sect = '11') AND aktif='Y' ORDER BY nama_mesin ASC";
        }
        elseif($this->session->userdata('id_sect')=='6')
        {
            $sql = "SELECT * FROM mesin WHERE (id_sect = '3' OR id_sect = '4' OR id_sect = '$id_sect')  AND aktif='Y' ORDER BY nama_mesin ASC";
        }
        return $this->db->query($sql)->result();
    }

    public function readbysect_def($id_sect)
    {
        $sql = "SELECT * FROM mesin WHERE (id_sect = '3' OR id_sect = '4' OR id_sect = '$id_sect')  AND aktif='Y' ORDER BY nama_mesin ASC"; 
        return $this->db->query($sql)->result();
    }

    public function readbyid($id_mesin)
    {
        $sql = "SELECT * FROM mesin LEFT JOIN sect ON mesin.id_sect=sect.id_sect WHERE mesin.id_mesin='$id_mesin' ORDER BY nama_mesin ASC";
        return  $this->db->query($sql)->result();
    }

    public function readbysect($id_sect)
    {
        $sql = "SELECT * FROM mesin WHERE id_sect='$id_sect' ORDER BY nama_mesin ASC";
        return $this->db->query($sql)->result();
    }

    public function insert($data)
    {
        $this->db->insert('mesin',$data);
    }

    public function set_status($id_mesin, $status)
    {
        $this->db->insert('status_mesin',["id_mesin"=>$id_mesin,"status"=>$status]);
    }

    public function update($id_mesin,$data)
    {
        $this->db->where('id_mesin',$id_mesin);
        $this->db->update('mesin',$data);
    }

    public function hapus($id_mesin)
    {
        $this->db->where('id_mesin',$id_mesin);
        $this->db->delete('mesin');
    }

    public function show_status()
    {
        $sql = "SELECT status_mesin.status, status_mesin.waktu,mesin.nama_mesin FROM status_mesin JOIN mesin ON status_mesin.id_mesin=mesin.id_mesin ORDER BY status_mesin.waktu DESC LIMIT 50";
        return  $this->db->query($sql)->result();
    }

}