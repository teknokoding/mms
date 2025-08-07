
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_pisau extends CI_Model {
public function read()
{
   return $this->db->get('pisau')->result();
}

public function readbyid($id_pisau)
{
    $this->db->where('id_pisau');
    return $this->db->get('pisau')->result();
}

}

/* End of file Mod_pisau.php */
?>
