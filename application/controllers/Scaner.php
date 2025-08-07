<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Scaner extends CI_Controller {

    public function index()
    {
        $this->load->view('monitor/scanersolo');
    }
}

?>