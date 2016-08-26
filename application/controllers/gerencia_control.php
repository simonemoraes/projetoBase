<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gerencia_control extends CI_Controller {

    var $cia_ukey = "";
    var $tabela = "gerencia";

    public function __construct() {
        parent::__construct();
        $this->load->model("gerencia_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {

        $this->obj_gen->autoriza();

        $endereco_paginacao = 'gerencia/p';

        $total_registros = $this->gerencia_model->contarTodos($this->tabela, $this->cia_ukey);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $gerencia['lista_gerencia'] = $this->gerencia_model->retornaTodos($this->tabela, $this->cia_ukey, 'gerente', 'asc', $data['resultado_por_pg'], $data['offset']);

        $gerencia['equipes'] = $this->gerencia_model->retornaEquipes($this->cia_ukey);

        $gerencia['gerencias'] = $this->gerencia_model->retornaGerentes($this->cia_ukey);

        $gerencia['id_form'] = 'id_form_gerencia';

        $html_grid_gerencia = $this->load->view('gerencia/grid_gerencia.php', $gerencia, TRUE);
        $html_form_gerencia = $this->load->view('gerencia/form_gerencia.php', $gerencia, TRUE);
        $html_opcoes_gerencia = $this->load->view('gerencia/opcao_pesquisa.php', "", TRUE);

        $dados_painel = array(
            'titulo' => 'Gerencia',
            'opcoes' => $html_opcoes_gerencia,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''",
            'endereco_btn_editar' => base_url('gerencia/editar'),
            'estado_btn_inativar' => "disabled=''",
            'estado_btn_maps' => "disabled=''",
            'endereco_btn_ativar' => base_url('gerencia/ativar'),
            'endereco_btn_localizar' => base_url('gerencia/filtarRegistros'),
            'paginacao' => $data['paginacao']
        );


        $link_fechar = base_url('gerencia');

        // Obeto para injeção de js  especifico.
        $obj_jS = array(
            'js_tela' => "js/gerencia/gerencia.js"
        );


        $endereco_salvar = base_url('gerencia/salvar');

        // Obeto para o preenchmento dos componentes do modal
        $obj_modal = array(
            'titulo_modal' => 'Vinculo de Gerencia X Equipe',
            'btn_cadastrar' => 'Salvar',
            'acao' => $endereco_salvar,
            'fechar' => $link_fechar,
            'formulario' => $html_form_gerencia
        );

        $dados['html_gerencia'] = $this->obj_gen->retornaPagina($html_grid_gerencia, $dados_painel, $obj_jS, $obj_modal);

        $this->load->view('gerencia/v_gerencia.php', $dados);
    }

    public function salvar() {

        $acao = "EDITAR";
        $resposta = "";

        $chave = $this->input->post('ukey');

        if ($this->input->post('ukey') == "NOVO") {
            $chave = $this->obj_gen->criaChaveprimaria("U");
            $acao = 'INSERIR';
        }

        $retorno = FALSE;

        $ukey = $this->input->post('ukey');
        $cia_ukey = $this->obj_gen->getCiaUkey();
        $gerente = $this->input->post('gerente_ukey');
        $equipe = $this->input->post('equipe_ukey');
        $data_inicio = $this->input->post('data_inicio');
        $data_fim = $this->input->post('data_fim');


        if ($ukey === 'NOVO') {
            $ukey = $this->obj_gen->criaChaveprimaria();

            $gerencia = array(
                'ukey' => $chave,
                'cia_ukey' => $cia_ukey,
                'gerente_ukey' => $gerente,
                'equipe_ukey' => $equipe,
                'data_inicio' => $data_inicio,
                'data_fim' => $data_fim,
                'status' => 1
            );

            $valida = 0;

            $valida = $this->gerencia_model->validaGerentePorEquipe($cia_ukey, $this->tabela, $gerente, $equipe, $data_inicio);

            if ($valida > 0) {
                $resposta = 'existe';
            } else {
                $retorno = $this->gerencia_model->inserir($this->tabela, $gerencia);
            }
        }

        if ($acao == 'EDITAR') {
            $retorno = $this->gerencia_model->desligar($this->tabela, $data_fim, $chave);
        }


        if ($retorno) {
            echo 'sucesso';
        } else {

            if ($resposta === "existe") {
                echo $resposta;
            } else {
                echo 'error';
            }
        }
    }

    public function editar() {

        $this->obj_gen->autoriza();

        $chave = $this->input->post('ukey');
        $resultado = $this->gerencia_model->retornaPorUkey($this->tabela, $this->cia_ukey, $chave);

        $retorno = array(
            'ukey' => $resultado['ukey'],
            'nome_gerente' => $resultado['gerente'],
            'nome_equipe' => $resultado['equipe'],
            'data_inicio' => $resultado['data_inicio'],
            'data_fim' => $resultado['data_fim']
        );

        echo json_encode($retorno);
    }

    public function filtarRegistros() {

        if ($this->input->post('filtro')) {
            $filtro = $this->input->post('filtro');
            $valor = $this->input->post('texto_digitado');

            $this->session->unset_userdata("ultima_busca");
        } else {

            $filtro = $this->session->userdata("ultima_busca")['filtro'];
            $valor = $this->session->userdata("ultima_busca")['texto_digitado'];
        }

        $valores['filtro'] = $filtro;
        $valores['texto_digitado'] = $valor;


        $this->session->set_userdata("ultima_busca", $valores);

        $resultado = $this->gerencia_model->buscarPorFiltroGerencia($this->tabela, $filtro, $valor);

        if ($resultado) {

            $gerencia['lista_gerencia'] = $resultado;

            $html_grid_gerencia = $this->load->view('gerencia/grid_gerencia.php', $gerencia, TRUE);

            $dados = array(
                'html_grid' => $html_grid_gerencia,
            );

            echo json_encode($dados);
        }
    }

}
