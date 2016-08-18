<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seguradora_control extends CI_Controller {

    var $cia_ukey = "";
    var $tabela = "seguradoras";

    public function __construct() {
        parent::__construct();
        $this->load->model("seguradora_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {

        $this->obj_gen->autoriza();

        $seguradora['lista_seguradora'] = $this->seguradora_model->retornaTodos($this->tabela, $this->cia_ukey);
        $seguradora['id_form'] = 'id_form_seguradora';

        $html_grid_seguradora = $this->load->view('seguradora/grid_seguradora.php', $seguradora, TRUE);
        $html_form_seguradora = $this->load->view('seguradora/form_seguradora.php', $seguradora, TRUE);
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
            'endereco_btn_ativar' => '',
            'endereco_btn_localizar' => base_url('seguradora/filtarRegistros')
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

    public function salvar() {

        $retorno = FALSE;

        $ukey = $this->input->post('ukey');
        $nome = $this->input->post('nome');
        $descricao = $this->input->post('descricao');
        $cia_ukey = $this->obj_gen->getCiaUkey();

        if ($ukey === 'NOVO') {
            $ukey = $this->obj_gen->criaChaveprimaria();

            $seguradora = array(
                'ukey' => $ukey,
                'cia_ukey' => $cia_ukey,
                'nome' => $nome,
                'descricao' => $descricao,
                'status' => 1
            );

            $retorno = $this->seguradora_model->inserir($this->tabela, $seguradora);
        }


        if ($retorno) {
            echo 'sucesso';
        } else {
            echo 'error';
        }
    }

    public function filtarRegistros() {

        $filtro = $this->input->post('filtro');
        $valor = $this->input->post('texto_digitado');

        if ($filtro == 'status') {

            if (strtoupper($valor) == 'INATIVO') {
                $valor = 0;
            }

            if (strtoupper($valor) == 'ATIVO') {
                $valor = 1;
            }
        }

        $resultado = $this->seguradora_model->buscarPorFiltro("seguradoras", $filtro, $valor);

        if ($resultado) {

            $seguradora['lista_seguradora'] = $resultado;
            
            $seguradora['id_form'] = 'id_form_seguradora';

            $html_grid_seguradora = $this->load->view('seguradora/grid_seguradora.php', $seguradora, TRUE);

            echo $html_grid_seguradora;
        }
    }

}
