<?php

class Home_control extends CI_Controller {
    
    public function index() {
        $this->load->template("index.php");
    }
}

