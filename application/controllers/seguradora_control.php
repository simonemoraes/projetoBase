<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seguradora_control extends CI_Controller {
    
    var $cia_ukey = "";

    public function __construct() {
        parent::__construct();
        $this->load->model("seguradora_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {

        $this->obj_gen->autoriza();

        $seguradora['lista_seguradora'] = $this->seguradora_model->retornaSeguradoras($this->cia_ukey);

        $html_grid_seguradora = $this->load->view('seguradora/grid_seguradora.php', $seguradora, TRUE);
        $html_form_seguradora = $this->load->view('seguradora/form_seguradora.php', "", TRUE);
        $html_opcoes_seguradora = $this->load->view('seguradora/opcao_pesquisa.php', "", TRUE);

        $dados_painel = array(
            'titulo' => 'Seguradoras',
            'opcoes' => $html_opcoes_seguradora,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''",
            'endereco_btn_editar' => base_url('seguradora/editar'),
            'estado_btn_inativar' => "disabled=''",
            'estado_btn_maps' => "disabled=''",
            'endereco_btn_ativar' => ''
        );


        $link_fechar = base_url('seguradora');

        // Obeto para injeção de js  especifico.
        $obj_jS = array(
            'js_tela' => "js/seguradora/seguradora.js"
        );


        $endereco_salvar = base_url('seguradora/salvar');

        // Obeto para o preenchmento dos componentes do modal
        $obj_modal = array(
            'titulo_modal' => 'Cadastro de Seguradoras',
            'btn_cadastrar' => 'Salvar',
            'acao' => $endereco_salvar,
            'fechar' => $link_fechar,
            'formulario' => $html_form_seguradora
        );

        $dados['html_seguradora'] = $this->obj_gen->retornaPagina($html_grid_seguradora, $dados_painel, $obj_jS, $obj_modal);

        $this->load->view('seguradora/v_seguradora.php', $dados);

       
    }

}
