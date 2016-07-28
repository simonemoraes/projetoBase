<?php

class Empresa_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $html_grid_empresa = $this->load->view('empresa/grid_empresa.php', "", TRUE);
        
        $dados_painel = array('titulo' => 'Empresas');

        $dados['html_empresa'] = $this->obj_gen->retornaPagina($html_grid_empresa,$dados_painel);

        $this->load->view('empresa/v_empresa.php', $dados);
    }

}
