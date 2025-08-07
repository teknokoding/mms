
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_klien extends CI_Model {
public function read()
{
   return $this->db->get('klien')->result();
}

public function readbyid($id_klien)
{
    $this->db->where('id_klien');
    return $this->db->get('klien')->result();
}

}

/* End of file Mod_klien.php */
?>
