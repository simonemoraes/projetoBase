<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_control extends CI_Controller {

    var $cia_ukey = "";
    var $tabela = "usuarios";

    public function __construct() {
        parent::__construct();
        // Instaciando o objeto usuario_model, só será usado aqui
        $this->load->model("usuario_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {
        
        $this->obj_gen->autoriza();

        $endereco_paginacao = 'usuario/p';

        $total_registros = $this->usuario_model->contarTodos('usuarios', $this->cia_ukey);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $usuario['lista_usuario'] = $this->usuario_model->retornaTodos($this->tabela, $this->cia_ukey, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $usuario['id_form'] = 'id_form_usuario';

        $html_grid_usuario = $this->load->view('usuario/grid_usuario.php', $usuario, TRUE);
        $html_form_usuario = $this->load->view('usuario/form_usuario.php', $usuario, TRUE);
        $html_opcoes_usuario = $this->load->view('usuario/opcao_pesquisa.php', "", TRUE);




        $dados_painel = array(
            'titulo' => 'Usuários',
            'opcoes' => $html_opcoes_usuario,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''",
            'endereco_btn_editar' => base_url('usuario/editar'),
            'estado_btn_inativar' => "disabled=''",
            'estado_btn_maps' => "disabled=''",
            'endereco_btn_ativar' => base_url('usuario/ativar'),
            'endereco_btn_localizar' => base_url('usuario/filtarRegistros'),
            'paginacao' => $data['paginacao']
        );


        $link_fechar = base_url('usuario');

        // Obeto para injeção de js  especifico.
        $obj_jS = array(
            'js_tela' => "js/usuario/usuario.js"
        );


        $endereco_salvar = base_url('usuario/salvar');

        // Obeto para o preenchmento dos componentes do modal
        $obj_modal = array(
            'titulo_modal' => 'Cadastro de Usuários',
            'btn_cadastrar' => 'Salvar',
            'acao' => $endereco_salvar,
            'fechar' => $link_fechar,
            'formulario' => $html_form_usuario
        );

        $dados['html_usuario'] = $this->obj_gen->retornaPagina($html_grid_usuario, $dados_painel, $obj_jS, $obj_modal);

        $this->load->view('usuario/v_usuario.php', $dados);
    }

    public function ativar() {

        $this->obj_gen->autoriza();

        $chave = $this->input->post('ukey');
        $usr = $this->usuario_model->buscaPorId($this->tabela, $chave);

        $retorno = "";

        if (!empty($usr)) {
            $status = $usr['status'];

            if ($status == 1) {
                $usr['status'] = 0;
                $retorno = $this->usuario_model->editar($this->tabela, $usr);
            } else {
                $usr['status'] = 1;
                $retorno = $this->usuario_model->editar($this->tabela, $usr);
            }
        }

        if ($retorno) {
            echo base_url('usuario');
        } else {
            echo 'error';
        }
    }

    public function editar() {

        $this->obj_gen->autoriza();

        $chave = $this->input->post('ukey');
        $resultado = $this->usuario_model->buscaPorId($this->tabela, $chave);

        $retorno = array(
            'ukey' => $resultado['ukey'],
            'nome' => $resultado['nome'],
            'cpf' => $resultado['cpf'],
            'login' => $resultado['login']
        );

        echo json_encode($retorno);
    }

    public function salvar() {

        $this->obj_gen->autoriza();

        $acao = "EDITAR";

        $chave = $this->input->post('ukey');

        if ($this->input->post('ukey') == "NOVO") {
            $chave = $this->obj_gen->criaChaveprimaria("U");
            $acao = 'INSERIR';
        }



        $retorno = "";

        if ($acao == 'INSERIR') {
            // criptografando a senha
            $senha = md5($this->input->post('senha'));



            // Preenchendo o objeto usuario com dados que vieram no post para inserção no banco
            $usuario = array(
                'ukey' => $chave,
                'cia_ukey' => $this->cia_ukey,
                'nome' => $this->input->post('nome'),
                'cpf' => $this->input->post('cpf'),
                'login' => $this->input->post('login'),
                'senha' => $senha,
                'status' => $this->input->post('status')
            );
            $retorno = $this->usuario_model->inserir($this->tabela, $usuario);
        }

        if ($acao == 'EDITAR') {
            // Preenchendo o objeto usuario com dados que vieram no post para alteração
            $usuario = array(
                'ukey' => $chave,
                'nome' => $this->input->post('nome'),
                'cpf' => $this->input->post('cpf'),
                'login' => $this->input->post('login')
            );
            $retorno = $this->usuario_model->editar($this->tabela, $usuario);
        }


        if ($retorno) {
            echo 'sucesso';
        } else {

            echo 'error';
        }
    }

    public function verificaLoginExistente() {

        $login = $this->input->post('login');
        $cia_ukey = $this->cia_ukey;

        $usuario = $this->usuario_model->verificaLoginExistente($login, $cia_ukey);

        if ($usuario) {
            echo 'sim';
        } else {
            echo 'nao';
        }
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

            $total_registros = $this->usuario_model->contarTodosPorBusca('usuarios', $this->cia_ukey, $filtro, $valor);
            $this->session->unset_userdata("ultima_busca");
        } else {

            $filtro = $this->session->userdata("ultima_busca")['filtro'];
            $valor = $this->session->userdata("ultima_busca")['texto_digitado'];
            $total_registros = $this->session->userdata("ultima_busca")['total'];
        }


        $endereco_paginacao = 'usuario/b';

        $valores['filtro'] = $filtro;
        $valores['texto_digitado'] = $valor;
        $valores['total'] = $total_registros;

        $this->session->set_userdata("ultima_busca", $valores);

        $data = $this->obj_gen->paginacao($endereco_paginacao, $total_registros);

        $resultado = $this->usuario_model->buscarPorFiltro("usuarios", $filtro, $valor, 'codigo', 'asc', $data['resultado_por_pg'], $data['offset']);

        $html_footer_painel = $data['paginacao'];


        if ($resultado) {

            $usuario['lista_usuario'] = $resultado;

            $usuario['id_form'] = 'id_form_usuario';

            $html_grid_usuario = $this->load->view('usuario/grid_usuario.php', $usuario, TRUE);

            $dados = array(
                'html_grid' => $html_grid_usuario,
                'html_footer' => $html_footer_painel
            );

            echo json_encode($dados);
        }
    }

}
