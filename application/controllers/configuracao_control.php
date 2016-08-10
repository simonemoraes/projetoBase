<?php if(!defined('BASEPATH'))
     exit ('No direct script access allowed');

class configuracao_control extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index() {
        $this->obj_gen->autoriza();
        $this->load->view('configuracao/alterarsenha.php');
    }
    
    public function recuperasenha() {
        $this->load->view('configuracao/recuperasenha.php');
    }
}
