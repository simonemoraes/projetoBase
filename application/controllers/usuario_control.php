<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_control extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index() {
        $this->load->view('usuarios/form_usuario');
    }
    
    public function grid() {
        $this->load->view('usuarios/grid_usuario');
    }
}