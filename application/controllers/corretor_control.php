<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Corretor_control extends CI_Controller {

    var $cia_ukey = "";
    var $tabela = "corretores";

    public function __construct() {
        parent::__construct();
        $this->load->model("corretor_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {

        $this->obj_gen->autoriza();

        $endereco_paginacao = 'corretor/p';

        $total_registros = $this->corretor_model->contarTodos($this->tabela, $this->cia_ukey);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $corretor['lista_corretor'] = $this->corretor_model->retornaTodos($this->tabela, $this->cia_ukey, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $corretor['id_form'] = 'id_form_corretor';

        $html_grid_corretor = $this->load->view('corretor/grid_corretor.php', $corretor, TRUE);
        $html_form_corretor = $this->load->view('corretor/form_corretor.php', $corretor, TRUE);
        $html_opcoes_corretor = $this->load->view('corretor/opcao_pesquisa.php', "", TRUE);

        $dados_painel = array(
            'titulo' => 'Corretores',
            'opcoes' => $html_opcoes_corretor,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''",
            'endereco_btn_editar' => base_url('corretor/editar'),
            'estado_btn_inativar' => "disabled=''",
            'estado_btn_maps' => "disabled=''",
            'endereco_btn_ativar' => base_url('corretor/ativar'),
            'endereco_btn_localizar' => base_url('corretor/filtarRegistros'),
            'paginacao' => $data['paginacao']
        );


        $link_fechar = base_url('corretor');

        // Obeto para injeção de js  especifico.
        $obj_jS = array(
            'js_tela' => "js/corretor/corretor.js"
        );


        $endereco_salvar = base_url('corretor/salvar');

        // Obeto para o preenchmento dos componentes do modal
        $obj_modal = array(
            'titulo_modal' => 'Cadastro de corretores',
            'btn_cadastrar' => 'Salvar',
            'acao' => $endereco_salvar,
            'fechar' => $link_fechar,
            'formulario' => $html_form_corretor
        );

        $dados['html_corretor'] = $this->obj_gen->retornaPagina($html_grid_corretor, $dados_painel, $obj_jS, $obj_modal);

        $this->load->view('corretor/v_corretor.php', $dados);
    }

    public function salvar() {

        $acao = "EDITAR";

        $chave = $this->input->post('ukey');

        if ($this->input->post('ukey') == "NOVO") {
            $chave = $this->obj_gen->criaChaveprimaria("U");
            $acao = 'INSERIR';
        }

        $retorno = FALSE;

        $cia_ukey = $this->obj_gen->getCiaUkey();
        $ukey = $this->input->post('ukey');
        $nome = $this->input->post('nome');
        $cpf = $this->input->post('cpf');
        $email = $this->input->post('email');
        $telefone = $this->input->post('telefone');
        $celular = $this->input->post('celular');
        $cep = $this->input->post('cep');
        $endereco = $this->input->post('endereco');
        $complemento = $this->input->post('complemento');
        $bairro = $this->input->post('bairro');
        $cidade = $this->input->post('cidade');
        $estado = $this->input->post('estado');



        if ($ukey === 'NOVO') {
            $ukey = $this->obj_gen->criaChaveprimaria();

            $corretor = array(
                'ukey' => $ukey,
                'cia_ukey' => $cia_ukey,
                'nome' => $nome,
                'cpf' => $cpf,
                'email' => $email,
                'telefone' => $telefone,
                'celular' => $celular,
                'cep' => $cep,
                'endereco' => $endereco,
                'complemento' => $complemento,
                'bairro' => $bairro,
                'cidade' => $cidade,
                'estado' => $estado,
                'status' => 1
            );

            $retorno = $this->corretor_model->inserir($this->tabela, $corretor);
        }

        if ($acao == 'EDITAR') {
            // Preenchendo o objeto corretor com dados que vieram no post para alteração
            $usuario = array(
                'ukey' => $ukey,
                'cia_ukey' => $cia_ukey,
                'nome' => $nome,
                'cpf' => $cpf,
                'email' => $email,
                'telefone' => $telefone,
                'celular' => $celular,
                'cep' => $cep,
                'endereco' => $endereco,
                'complemento' => $complemento,
                'bairro' => $bairro,
                'cidade' => $cidade,
                'estado' => $estado
            );
            $retorno = $this->corretor_model->editar($this->tabela, $usuario);
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
        $usr = $this->corretor_model->buscaPorId($this->tabela, $chave);

        $retorno = "";

        if (!empty($usr)) {
            $status = $usr['status'];

            if ($status == 1) {
                $usr['status'] = 0;
                $retorno = $this->corretor_model->editar($this->tabela, $usr);
            } else {
                $usr['status'] = 1;
                $retorno = $this->corretor_model->editar($this->tabela, $usr);
            }
        }

        if ($retorno) {
            echo base_url('corretor');
        } else {
            echo 'error';
        }
    }

    public function editar() {

        $this->obj_gen->autoriza();

        $chave = $this->input->post('ukey');
        $resultado = $this->corretor_model->buscaPorId($this->tabela, $chave);

        $retorno = array(
            'ukey' => $resultado['ukey'],
            'nome' => $resultado['nome'],
            'cpf' => $resultado['cpf'],
            'email' => $resultado['email'],
            'telefone' => $resultado['telefone'],
            'celular' => $resultado['celular'],
            'cep' => $resultado['cep'],
            'endereco' => $resultado['endereco'],
            'bairro' => $resultado['bairro'],
            'complemento' => $resultado['complemento'],
            'cidade' => $resultado['cidade'],
            'estado' => $resultado['estado']
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

            $total_registros = $this->corretor_model->contarTodosPorBusca($this->tabela, $this->cia_ukey, $filtro, $valor);
            $this->session->unset_userdata("ultima_busca");
        } else {

            $filtro = $this->session->userdata("ultima_busca")['filtro'];
            $valor = $this->session->userdata("ultima_busca")['texto_digitado'];
            $total_registros = $this->session->userdata("ultima_busca")['total'];
        }


        $endereco_paginacao = 'corretor/b';

        $valores['filtro'] = $filtro;
        $valores['texto_digitado'] = $valor;
        $valores['total'] = $total_registros;

        $this->session->set_userdata("ultima_busca", $valores);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $resultado = $this->corretor_model->buscarPorFiltro($this->tabela, $filtro, $valor, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $html_footer_painel = $data['paginacao'];


        if ($resultado) {

            $corretor['lista_corretor'] = $resultado;

            $html_grid_corretor = $this->load->view('corretor/grid_corretor.php', $corretor, TRUE);

            $dados = array(
                'html_grid' => $html_grid_corretor,
                'html_footer' => $html_footer_painel
            );

            echo json_encode($dados);
        }
    }

}
