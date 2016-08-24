<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supervisao_control extends CI_Controller {

    var $cia_ukey = "";
    var $tabela = "supervisao";

    public function __construct() {
        parent::__construct();
        $this->load->model("supervisao_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {

        $this->obj_gen->autoriza();

        $endereco_paginacao = 'supervisao/p';

        $total_registros = $this->supervisao_model->contarTodos($this->tabela, $this->cia_ukey);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $supervisao['lista_supervisao'] = $this->supervisao_model->retornaTodos($this->tabela, $this->cia_ukey, 'supervisor', 'asc', $data['resultado_por_pg'], $data['offset']);

        $supervisao['equipes'] = $this->supervisao_model->retornaEquipes($this->cia_ukey);

        $supervisao['supervisores'] = $this->supervisao_model->retornaSupervisores($this->cia_ukey);

        $supervisao['id_form'] = 'id_form_supervisao';

        $html_grid_supervisao = $this->load->view('supervisao/grid_supervisao.php', $supervisao, TRUE);
        $html_form_supervisao = $this->load->view('supervisao/form_supervisao.php', $supervisao, TRUE);
        $html_opcoes_supervisao = $this->load->view('supervisao/opcao_pesquisa.php', "", TRUE);

        $dados_painel = array(
            'titulo' => 'Supervisão',
            'opcoes' => $html_opcoes_supervisao,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''",
            'endereco_btn_editar' => base_url('supervisao/editar'),
            'estado_btn_inativar' => "disabled=''",
            'estado_btn_maps' => "disabled=''",
            'endereco_btn_ativar' => base_url('supervisao/ativar'),
            'endereco_btn_localizar' => base_url('supervisao/filtarRegistros'),
            'paginacao' => $data['paginacao']
        );


        $link_fechar = base_url('supervisao');

        // Obeto para injeção de js  especifico.
        $obj_jS = array(
            'js_tela' => "js/supervisao/supervisao.js"
        );


        $endereco_salvar = base_url('supervisao/salvar');

        // Obeto para o preenchmento dos componentes do modal
        $obj_modal = array(
            'titulo_modal' => 'Cadastro de supervisaos',
            'btn_cadastrar' => 'Salvar',
            'acao' => $endereco_salvar,
            'fechar' => $link_fechar,
            'formulario' => $html_form_supervisao
        );

        $dados['html_supervisao'] = $this->obj_gen->retornaPagina($html_grid_supervisao, $dados_painel, $obj_jS, $obj_modal);

        $this->load->view('supervisao/v_supervisao.php', $dados);
    }

    public function salvar() {

        $acao = "EDITAR";

        $chave = $this->input->post('ukey');

        if ($this->input->post('ukey') == "NOVO") {
            $chave = $this->obj_gen->criaChaveprimaria("U");
            $acao = 'INSERIR';
        }

        $retorno = FALSE;

        $ukey = $this->input->post('ukey');
        $cia_ukey = $this->obj_gen->getCiaUkey();
        $supervisor = $this->input->post('supervisor_ukey');
        $equipe = $this->input->post('equipe_ukey');
        $data_inicio = $this->input->post('data_inicio');
        $data_fim = $this->input->post('data_fim');


        if ($ukey === 'NOVO') {
            $ukey = $this->obj_gen->criaChaveprimaria();

            $supervisao = array(
                'ukey' => $ukey,
                'cia_ukey' => $cia_ukey,
                'supervisor_ukey' => $supervisor,
                'equipe_ukey' => $equipe,
                'data_inicio' => $data_inicio,
                'data_fim' => $data_fim,
                'status' => 1
            );

            $retorno = $this->supervisao_model->inserir($this->tabela, $supervisao);
        }

        if ($acao == 'EDITAR') {
            // Preenchendo o objeto supervisao com dados que vieram no post para alteração
            $supervisao = array(
                'ukey' => $ukey,
                'cia_ukey' => $cia_ukey,
                'supervisor_ukey' => $supervisor,
                'equipe_ukey' => $equipe,
                'data_inicio' => $data_inicio,
                'data_fim' => $data_fim,
                'status' => 1
            );
            $retorno = $this->supervisao_model->editar($this->tabela, $supervisao);
        }


        if ($retorno) {
            echo 'sucesso';
        } else {
            echo 'error';
        }
    }

    public function ativar() {

        $this->obj_gen->autoriza();

        $chave = $this->input->post('ukey');
        $usr = $this->supervisao_model->buscaPorId($this->tabela, $chave);

        $retorno = "";

        if (!empty($usr)) {
            $status = $usr['status'];

            if ($status == 1) {
                $usr['status'] = 0;
                $retorno = $this->supervisao_model->editar($this->tabela, $usr);
            } else {
                $usr['status'] = 1;
                $retorno = $this->supervisao_model->editar($this->tabela, $usr);
            }
        }

        if ($retorno) {
            echo base_url('supervisao');
        } else {
            echo 'error';
        }
    }

    public function editar() {

        $this->obj_gen->autoriza();

        $chave = $this->input->post('ukey');
        $resultado = $this->supervisao_model->buscaPorId($this->tabela, $chave);

        $retorno = array(
            'ukey' => $resultado['ukey'],
            'nome' => $resultado['nome'],
            'descricao' => $resultado['descricao']
        );

        echo json_encode($retorno);
    }

    public function filtarRegistros() {

        if ($this->input->post('filtro')) {
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

            $total_registros = $this->supervisao_model->contarTodosPorBusca($this->tabela, $this->cia_ukey, $filtro, $valor);
            $this->session->unset_userdata("ultima_busca");
        } else {

            $filtro = $this->session->userdata("ultima_busca")['filtro'];
            $valor = $this->session->userdata("ultima_busca")['texto_digitado'];
            $total_registros = $this->session->userdata("ultima_busca")['total'];
        }


        $endereco_paginacao = 'supervisao/b';

        $valores['filtro'] = $filtro;
        $valores['texto_digitado'] = $valor;
        $valores['total'] = $total_registros;

        $this->session->set_userdata("ultima_busca", $valores);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $resultado = $this->supervisao_model->buscarPorFiltro($this->tabela, $filtro, $valor, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $html_footer_painel = $data['paginacao'];


        if ($resultado) {

            $supervisao['lista_supervisao'] = $resultado;

            $html_grid_supervisao = $this->load->view('supervisao/grid_supervisao.php', $supervisao, TRUE);

            $dados = array(
                'html_grid' => $html_grid_supervisao,
                'html_footer' => $html_footer_painel
            );

            echo json_encode($dados);
        }
    }

}
