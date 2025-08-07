
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_relasi extends CI_Model {
public function read()
{
   return $this->db->get('relasi')->result();
}

public function readbyid($id_relasi)
{
    $this->db->where('id_relasi');
    return $this->db->get('relasi')->result();
}

}

/* End of file Mod_relasi.php */
?>
