<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_satuan extends CI_Model {

    public function read()
    {
        return $this->db->get('satuan')->result();
    }

}

/* End of file Mod_satuan.php */

?>