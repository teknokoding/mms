<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_sga extends CI_Model
{
    public function readbysect($id_sect)
    {
        $this->db->where('id_sect', $id_sect);
        return $this->db->get('sga')->result();
    }
}

/* End of file Mod_sga.php */
