<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class condicao_comissionamento_control extends CI_Controller {

    var $cia_ukey = "";
    var $tabela = "condicao_comissionamentos";

    public function __construct() {
        parent::__construct();
        $this->load->model("condicao_comissionamento_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {

        $this->obj_gen->autoriza();

        $endereco_paginacao = 'condicao_comissionamento/p';

        $total_registros = $this->condicao_comissionamento_model->contarTodos($this->tabela, $this->cia_ukey);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $condicao_comissionamento['lista_condicao_comissionamento'] = $this->condicao_comissionamento_model->retornaTodos($this->tabela, $this->cia_ukey, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $condicao_comissionamento['id_form'] = 'id_form_condicao_comissionamento';

        $html_grid_condicao_comissionamento = $this->load->view('condicao_comissionamento/grid_condicao_comissionamento.php', $condicao_comissionamento, TRUE);
        $html_form_condicao_comissionamento = $this->load->view('condicao_comissionamento/form_condicao_comissionamento.php', $condicao_comissionamento, TRUE);
        $html_opcoes_condicao_comissionamento = $this->load->view('condicao_comissionamento/opcao_pesquisa.php', "", TRUE);

        $dados_painel = array(
            'titulo' => 'Condições de Comissionamentos',
            'opcoes' => $html_opcoes_condicao_comissionamento,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''",
            'endereco_btn_editar' => base_url('condicao_comissionamento/editar'),
            'estado_btn_inativar' => "disabled=''",
            'estado_btn_maps' => "disabled=''",
            'endereco_btn_ativar' => base_url('condicao_comissionamento/ativar'),
            'endereco_btn_localizar' => base_url('condicao_comissionamento/filtarRegistros'),
            'paginacao' => $data['paginacao']
        );


        $link_fechar = base_url('condicao_comissionamento');

        // Obeto para injeção de js  especifico.
        $obj_jS = array(
            'js_tela' => "js/condicao_comissionamento/condicao_comissionamento.js"
        );


        $endereco_salvar = base_url('condicao_comissionamento/salvar');

        // Obeto para o preenchmento dos componentes do modal
        $obj_modal = array(
            'titulo_modal' => 'Cadastro de condicões de comissionamento',
            'btn_cadastrar' => 'Salvar',
            'acao' => $endereco_salvar,
            'fechar' => $link_fechar,
            'formulario' => $html_form_condicao_comissionamento
        );

        $dados['html_condicao_comissionamento'] = $this->obj_gen->retornaPagina($html_grid_condicao_comissionamento, $dados_painel, $obj_jS, $obj_modal);

        $this->load->view('condicao_comissionamento/v_condicao_comissionamento.php', $dados);
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
        $nome = $this->input->post('nome');
        $descricao = $this->input->post('descricao');
        $cia_ukey = $this->obj_gen->getCiaUkey();

        if ($ukey === 'NOVO') {
            $ukey = $this->obj_gen->criaChaveprimaria();

            $condicao_comissionamento = array(
                'ukey' => $ukey,
                'cia_ukey' => $cia_ukey,
                'nome' => $nome,
                'descricao' => $descricao,
                'status' => 1
            );

            $retorno = $this->condicao_comissionamento_model->inserir($this->tabela, $condicao_comissionamento);
        }
        
        if ($acao == 'EDITAR') {
            // Preenchendo o objeto condicao_comissionamento com dados que vieram no post para alteração
            $usuario = array(
                'ukey' => $chave,
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao')
               
            );
            $retorno = $this->condicao_comissionamento_model->editar($this->tabela, $usuario);
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
        $usr = $this->condicao_comissionamento_model->buscaPorId($this->tabela, $chave);

        $retorno = "";

        if (!empty($usr)) {
            $status = $usr['status'];

            if ($status == 1) {
                $usr['status'] = 0;
                $retorno = $this->condicao_comissionamento_model->editar($this->tabela, $usr);
            } else {
                $usr['status'] = 1;
                $retorno = $this->condicao_comissionamento_model->editar($this->tabela, $usr);
            }
        }

        if ($retorno) {
            echo base_url('condicao_comissionamento');
        } else {
            echo 'error';
        }
    }

    public function editar() {

        $this->obj_gen->autoriza();

        $chave = $this->input->post('ukey');
        $resultado = $this->condicao_comissionamento_model->buscaPorId($this->tabela, $chave);

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

            $total_registros = $this->condicao_comissionamento_model->contarTodosPorBusca($this->tabela, $this->cia_ukey, $filtro, $valor);
            $this->session->unset_userdata("ultima_busca");
        } else {

            $filtro = $this->session->userdata("ultima_busca")['filtro'];
            $valor = $this->session->userdata("ultima_busca")['texto_digitado'];
            $total_registros = $this->session->userdata("ultima_busca")['total'];
        }


        $endereco_paginacao = 'condicao_comissionamento/b';

        $valores['filtro'] = $filtro;
        $valores['texto_digitado'] = $valor;
        $valores['total'] = $total_registros;

        $this->session->set_userdata("ultima_busca", $valores);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $resultado = $this->condicao_comissionamento_model->buscarPorFiltro($this->tabela, $filtro, $valor, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $html_footer_painel = $data['paginacao'];


        if ($resultado) {

            $condicao_comissionamento['lista_condicao_comissionamento'] = $resultado;

            $html_grid_condicao_comissionamento = $this->load->view('condicao_comissionamento/grid_condicao_comissionamento.php', $condicao_comissionamento, TRUE);

            $dados = array(
                'html_grid' => $html_grid_condicao_comissionamento,
                'html_footer' => $html_footer_painel
            );

            echo json_encode($dados);
        }
    }

}
