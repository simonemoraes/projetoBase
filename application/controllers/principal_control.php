<?php

class Principal_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
      $this->load->view('principal/v_inicial.php');
        
        
    }
     public function teste() {
         echo '<pre>';
         print_r($this->obj_gen->criaChaveprimaria());
         
          echo '</pre>';
          
        echo 26 * 26 * 26 *26 ;
     }

  

}
