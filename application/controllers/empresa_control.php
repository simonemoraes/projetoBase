<?php

class Empresa_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $html_grid_empresa = $this->load->view('empresa/grid_empresa.php', "", TRUE);
        
        $dados_painel = array('titulo' => 'Empresas');
        
        $endereco = base_url('empresa/cadastrar');
        
        $funcao_jS = array(
            'js_tela' => "js/empresa/empresa.js",
            'btn_novo' => "cadastrarEmpresa('$endereco')",
            'btn_editar' => "editarEmpresa('empresa/editar')",
            'btn_excluir' => "excluirEmpresa('empresa/excluir')",
            'btn_visualizar' => "visualizarEmpresa('empresa/visualizar')"
            
            );

        $dados['html_empresa'] = $this->obj_gen->retornaPagina($html_grid_empresa,$dados_painel, $funcao_jS);
        
        $this->load->view('empresa/v_empresa.php', $dados);
    }

}
