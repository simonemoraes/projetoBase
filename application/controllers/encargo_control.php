<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class encargo_control extends CI_Controller {

    var $cia_ukey = "";
    var $tabela = "encargos";

    public function __construct() {
        parent::__construct();
        $this->load->model("encargo_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {

        $this->obj_gen->autoriza();

        $endereco_paginacao = 'encargo/p';

        $total_registros = $this->encargo_model->contarTodos($this->tabela, $this->cia_ukey);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $encargo['lista_encargo'] = $this->encargo_model->retornaTodos($this->tabela, $this->cia_ukey, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $encargo['id_form'] = 'id_form_encargo';

        $html_grid_encargo = $this->load->view('encargo/grid_encargo.php', $encargo, TRUE);
        $html_form_encargo = $this->load->view('encargo/form_encargo.php', $encargo, TRUE);
        $html_opcoes_encargo = $this->load->view('encargo/opcao_pesquisa.php', "", TRUE);

        $dados_painel = array(
            'titulo' => 'Encargos',
            'opcoes' => $html_opcoes_encargo,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''",
            'endereco_btn_editar' => base_url('encargo/editar'),
            'estado_btn_inativar' => "disabled=''",
            'estado_btn_maps' => "disabled=''",
            'endereco_btn_ativar' => base_url('encargo/ativar'),
            'endereco_btn_localizar' => base_url('encargo/filtarRegistros'),
            'paginacao' => $data['paginacao']
        );


        $link_fechar = base_url('encargo');

        // Obeto para injeção de js  especifico.
        $obj_jS = array(
            'js_tela' => "js/encargo/encargo.js"
        );


        $endereco_salvar = base_url('encargo/salvar');

        // Obeto para o preenchmento dos componentes do modal
        $obj_modal = array(
            'titulo_modal' => 'Cadastro de encargos',
            'btn_cadastrar' => 'Salvar',
            'acao' => $endereco_salvar,
            'fechar' => $link_fechar,
            'formulario' => $html_form_encargo
        );

        $dados['html_encargo'] = $this->obj_gen->retornaPagina($html_grid_encargo, $dados_painel, $obj_jS, $obj_modal);

        $this->load->view('encargo/v_encargo.php', $dados);
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
        $valor = $this->input->post('valor');
        $cia_ukey = $this->obj_gen->getCiaUkey();

        if ($ukey === 'NOVO') {
            $ukey = $this->obj_gen->criaChaveprimaria();

            $encargo = array(
                'ukey' => $ukey,
                'cia_ukey' => $cia_ukey,
                'nome' => $nome,
                'valor' => $valor,
                'status' => 1
            );

            $retorno = $this->encargo_model->inserir($this->tabela, $encargo);
        }
        
        if ($acao == 'EDITAR') {
            // Preenchendo o objeto encargo com dados que vieram no post para alteração
            $usuario = array(
                'ukey' => $chave,
                'nome' => $this->input->post('nome'),
                'valor' => $this->input->post('valor')
               
            );
            $retorno = $this->encargo_model->editar($this->tabela, $usuario);
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
        $usr = $this->encargo_model->buscaPorId($this->tabela, $chave);

        $retorno = "";

        if (!empty($usr)) {
            $status = $usr['status'];

            if ($status == 1) {
                $usr['status'] = 0;
                $retorno = $this->encargo_model->editar($this->tabela, $usr);
            } else {
                $usr['status'] = 1;
                $retorno = $this->encargo_model->editar($this->tabela, $usr);
            }
        }

        if ($retorno) {
            echo base_url('encargo');
        } else {
            echo 'error';
        }
    }

    public function editar() {

        $this->obj_gen->autoriza();

        $chave = $this->input->post('ukey');
        $resultado = $this->encargo_model->buscaPorId($this->tabela, $chave);

        $retorno = array(
            'ukey' => $resultado['ukey'],
            'nome' => $resultado['nome'],
            'valor' => $resultado['valor']
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

            $total_registros = $this->encargo_model->contarTodosPorBusca($this->tabela, $this->cia_ukey, $filtro, $valor);
            $this->session->unset_userdata("ultima_busca");
        } else {

            $filtro = $this->session->userdata("ultima_busca")['filtro'];
            $valor = $this->session->userdata("ultima_busca")['texto_digitado'];
            $total_registros = $this->session->userdata("ultima_busca")['total'];
        }


        $endereco_paginacao = 'encargo/b';

        $valores['filtro'] = $filtro;
        $valores['texto_digitado'] = $valor;
        $valores['total'] = $total_registros;

        $this->session->set_userdata("ultima_busca", $valores);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $resultado = $this->encargo_model->buscarPorFiltro($this->tabela, $filtro, $valor, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $html_footer_painel = $data['paginacao'];


        if ($resultado) {

            $encargo['lista_encargo'] = $resultado;

            $html_grid_encargo = $this->load->view('encargo/grid_encargo.php', $encargo, TRUE);

            $dados = array(
                'html_grid' => $html_grid_encargo,
                'html_footer' => $html_footer_painel
            );

            echo json_encode($dados);
        }
    }

}
