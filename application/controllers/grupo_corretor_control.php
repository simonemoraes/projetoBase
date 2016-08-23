<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class grupo_corretor_control extends CI_Controller {

    var $cia_ukey = "";
    var $tabela = "grupo_corretores";

    public function __construct() {
        parent::__construct();
        $this->load->model("grupo_corretor_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {

        $this->obj_gen->autoriza();

        $endereco_paginacao = 'grupo_corretor/p';

        $total_registros = $this->grupo_corretor_model->contarTodos($this->tabela, $this->cia_ukey);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $grupo_corretor['lista_grupo_corretor'] = $this->grupo_corretor_model->retornaTodos($this->tabela, $this->cia_ukey, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $grupo_corretor['id_form'] = 'id_form_grupo_corretor';

        $html_grid_grupo_corretor = $this->load->view('grupo_corretor/grid_grupo_corretor.php', $grupo_corretor, TRUE);
        $html_form_grupo_corretor = $this->load->view('grupo_corretor/form_grupo_corretor.php', $grupo_corretor, TRUE);
        $html_opcoes_grupo_corretor = $this->load->view('grupo_corretor/opcao_pesquisa.php', "", TRUE);

        $dados_painel = array(
            'titulo' => 'Equipes',
            'opcoes' => $html_opcoes_grupo_corretor,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''",
            'endereco_btn_editar' => base_url('grupo_corretor/editar'),
            'estado_btn_inativar' => "disabled=''",
            'estado_btn_maps' => "disabled=''",
            'endereco_btn_ativar' => base_url('grupo_corretor/ativar'),
            'endereco_btn_localizar' => base_url('grupo_corretor/filtarRegistros'),
            'paginacao' => $data['paginacao']
        );


        $link_fechar = base_url('grupo_corretor');

        // Obeto para injeção de js  especifico.
        $obj_jS = array(
            'js_tela' => "js/grupo_corretor/grupo_corretor.js"
        );


        $endereco_salvar = base_url('grupo_corretor/salvar');

        // Obeto para o preenchmento dos componentes do modal
        $obj_modal = array(
            'titulo_modal' => 'Cadastro de equipes',
            'btn_cadastrar' => 'Salvar',
            'acao' => $endereco_salvar,
            'fechar' => $link_fechar,
            'formulario' => $html_form_grupo_corretor
        );

        $dados['html_grupo_corretor'] = $this->obj_gen->retornaPagina($html_grid_grupo_corretor, $dados_painel, $obj_jS, $obj_modal);

        $this->load->view('grupo_corretor/v_grupo_corretor.php', $dados);
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

            $grupo_corretor = array(
                'ukey' => $ukey,
                'cia_ukey' => $cia_ukey,
                'nome' => $nome,
                'descricao' => $descricao,
                'status' => 1
            );

            $retorno = $this->grupo_corretor_model->inserir($this->tabela, $grupo_corretor);
        }
        
        if ($acao == 'EDITAR') {
            // Preenchendo o objeto grupo_corretor com dados que vieram no post para alteração
            $usuario = array(
                'ukey' => $chave,
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao')
               
            );
            $retorno = $this->grupo_corretor_model->editar($this->tabela, $usuario);
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
        $usr = $this->grupo_corretor_model->buscaPorId($this->tabela, $chave);

        $retorno = "";

        if (!empty($usr)) {
            $status = $usr['status'];

            if ($status == 1) {
                $usr['status'] = 0;
                $retorno = $this->grupo_corretor_model->editar($this->tabela, $usr);
            } else {
                $usr['status'] = 1;
                $retorno = $this->grupo_corretor_model->editar($this->tabela, $usr);
            }
        }

        if ($retorno) {
            echo base_url('grupo_corretor');
        } else {
            echo 'error';
        }
    }

    public function editar() {

        $this->obj_gen->autoriza();

        $chave = $this->input->post('ukey');
        $resultado = $this->grupo_corretor_model->buscaPorId($this->tabela, $chave);

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

            $total_registros = $this->grupo_corretor_model->contarTodosPorBusca($this->tabela, $this->cia_ukey, $filtro, $valor);
            $this->session->unset_userdata("ultima_busca");
        } else {

            $filtro = $this->session->userdata("ultima_busca")['filtro'];
            $valor = $this->session->userdata("ultima_busca")['texto_digitado'];
            $total_registros = $this->session->userdata("ultima_busca")['total'];
        }


        $endereco_paginacao = 'grupo_corretor/b';

        $valores['filtro'] = $filtro;
        $valores['texto_digitado'] = $valor;
        $valores['total'] = $total_registros;

        $this->session->set_userdata("ultima_busca", $valores);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $resultado = $this->grupo_corretor_model->buscarPorFiltro($this->tabela, $filtro, $valor, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $html_footer_painel = $data['paginacao'];


        if ($resultado) {

            $grupo_corretor['lista_grupo_corretor'] = $resultado;

            $html_grid_grupo_corretor = $this->load->view('grupo_corretor/grid_grupo_corretor.php', $grupo_corretor, TRUE);

            $dados = array(
                'html_grid' => $html_grid_grupo_corretor,
                'html_footer' => $html_footer_painel
            );

            echo json_encode($dados);
        }
    }

}
