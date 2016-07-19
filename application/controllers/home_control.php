<?php

class Home_control extends CI_Controller {
    
    var $dadosmenu = array();
    
     public function __construct() {
        parent::__construct();

        $this->dadosmenu = $this->menu_model->listaMenus();
    }

    public function index() {
       $this->load->template("index.php", "", $this->dadosmenu);
    }
    
    public function produtos() {
       $this->load->template("produtos.php", "", $this->dadosmenu);
    }

}
