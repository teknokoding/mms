<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_level extends CI_Model {

    public function read()
    {
        return $this->db->get('level')->result();

    }

}

/* End of file Mod_level.php */

?>