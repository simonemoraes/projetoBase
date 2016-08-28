<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grade_comissionamento_control extends CI_Controller {

    var $cia_ukey = "";
    var $tabela = "grade_comissoes";

    public function __construct() {
        parent::__construct();
        $this->load->model("grade_comissionamento_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {

        $this->obj_gen->autoriza();

        $endereco_paginacao = 'grade_comissionamento/p';

        $total_registros = $this->grade_comissionamento_model->contarTodos($this->tabela, $this->cia_ukey);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $grade_comissionamento['lista_grade_comissionamento'] = $this->grade_comissionamento_model->retornaTodos($this->tabela, $this->cia_ukey, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);
        
        $grade_comissionamento['lista_grade_comissao'] = $this->grade_comissionamento_model->retornaGradeComissao("grade_comissoes", $this->cia_ukey);
        $grade_comissionamento['lista_condicao_comissao'] = $this->grade_comissionamento_model->retornaCondicaoComissao("condicao_comissionamentos", $this->cia_ukey);
        $grade_comissionamento['lista_seguradora'] = $this->grade_comissionamento_model->retornaSeguradora("seguradoras", $this->cia_ukey);
        $grade_comissionamento['lista_produto'] = $this->grade_comissionamento_model->retornaProduto("produtos", $this->cia_ukey);

        $grade_comissionamento['id_form'] = 'id_form_grade_comissionamento';

        $html_grid_grade_comissionamento = $this->load->view('grade_comissionamento/grid_grade_comissionamento.php', $grade_comissionamento, TRUE);
        $html_form_grade_comissionamento = $this->load->view('grade_comissionamento/form_grade_comissionamento.php', $grade_comissionamento, TRUE);
        $html_opcoes_grade_comissionamento = $this->load->view('grade_comissionamento/opcao_pesquisa.php', "", TRUE);

        $dados_painel = array(
            'titulo' => 'Grade de Comissionamentos',
            'opcoes' => $html_opcoes_grade_comissionamento,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''",
            'endereco_btn_editar' => base_url('grade_comissionamento/editar'),
            'estado_btn_inativar' => "disabled=''",
            'estado_btn_maps' => "disabled=''",
            'endereco_btn_ativar' => base_url('grade_comissionamento/ativar'),
            'endereco_btn_localizar' => base_url('grade_comissionamento/filtarRegistros'),
            'paginacao' => $data['paginacao']
        );


        $link_fechar = base_url('grade_comissionamento');

        // Obeto para injeção de js  especifico.
        $obj_jS = array(
            'js_tela' => "js/grade_comissionamento/grade_comissionamento.js"
        );


        $endereco_salvar = base_url('grade_comissionamento/salvar');

        // Obeto para o preenchmento dos componentes do modal
        $obj_modal = array(
            'titulo_modal' => 'Cadastro de grade de comissionamento',
            'btn_cadastrar' => 'Salvar',
            'acao' => $endereco_salvar,
            'fechar' => $link_fechar,
            'formulario' => $html_form_grade_comissionamento
        );

        $dados['html_grade_comissionamento'] = $this->obj_gen->retornaPagina($html_grid_grade_comissionamento, $dados_painel, $obj_jS, $obj_modal);

        $this->load->view('grade_comissionamento/v_grade_comissionamento.php', $dados);
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

            $grade_comissionamento = array(
                'ukey' => $ukey,
                'cia_ukey' => $cia_ukey,
                'nome' => $nome,
                'descricao' => $descricao,
                'status' => 1
            );

            $retorno = $this->grade_comissionamento_model->inserir($this->tabela, $grade_comissionamento);
        }
        
        if ($acao == 'EDITAR') {
            // Preenchendo o objeto grade_comissionamento com dados que vieram no post para alteração
            $usuario = array(
                'ukey' => $chave,
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao')
               
            );
            $retorno = $this->grade_comissionamento_model->editar($this->tabela, $usuario);
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
        $usr = $this->grade_comissionamento_model->buscaPorId($this->tabela, $chave);

        $retorno = "";

        if (!empty($usr)) {
            $status = $usr['status'];

            if ($status == 1) {
                $usr['status'] = 0;
                $retorno = $this->grade_comissionamento_model->editar($this->tabela, $usr);
            } else {
                $usr['status'] = 1;
                $retorno = $this->grade_comissionamento_model->editar($this->tabela, $usr);
            }
        }

        if ($retorno) {
            echo base_url('grade_comissionamento');
        } else {
            echo 'error';
        }
    }

    public function editar() {

        $this->obj_gen->autoriza();

        $chave = $this->input->post('ukey');
        $resultado = $this->grade_comissionamento_model->buscaPorId($this->tabela, $chave);

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

            $total_registros = $this->grade_comissionamento_model->contarTodosPorBusca($this->tabela, $this->cia_ukey, $filtro, $valor);
            $this->session->unset_userdata("ultima_busca");
        } else {

            $filtro = $this->session->userdata("ultima_busca")['filtro'];
            $valor = $this->session->userdata("ultima_busca")['texto_digitado'];
            $total_registros = $this->session->userdata("ultima_busca")['total'];
        }


        $endereco_paginacao = 'grade_comissionamento/b';

        $valores['filtro'] = $filtro;
        $valores['texto_digitado'] = $valor;
        $valores['total'] = $total_registros;

        $this->session->set_userdata("ultima_busca", $valores);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $resultado = $this->grade_comissionamento_model->buscarPorFiltro($this->tabela, $filtro, $valor, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $html_footer_painel = $data['paginacao'];


        if ($resultado) {

            $grade_comissionamento['lista_grade_comissionamento'] = $resultado;

            $html_grid_grade_comissionamento = $this->load->view('grade_comissionamento/grid_grade_comissionamento.php', $grade_comissionamento, TRUE);

            $dados = array(
                'html_grid' => $html_grid_grade_comissionamento,
                'html_footer' => $html_footer_painel
            );

            echo json_encode($dados);
        }
    }

}
