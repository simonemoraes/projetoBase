<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Instaciando o objeto usuario_model, só será usado aqui
        $this->load->model("usuario_model");
    }

    public function index() {

        $usuario['lista_usuario'] = $this->usuario_model->retornaUsuarios();

        $html_grid_usuario = $this->load->view('usuario/grid_usuario.php', $usuario, TRUE);
        $html_form_usuario = $this->load->view('usuario/form_usuario.php', "", TRUE);
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

        $chave = $this->input->post('ukey');
        $usr = $this->usuario_model->buscaPorId($chave);
        
        $retorno = "";

        if (!empty($usr)) {
            $status = $usr['status'];

            if ($status == 1) {
                $usr['status'] = 0;
                $retorno = $this->usuario_model->editarUsuario($usr);
            } else {
                $usr['status'] = 1;
                $retorno = $this->usuario_model->editarUsuario($usr);
            }
        }
        
        if($retorno){
            echo base_url('usuario');
        }else{
            echo 'error';
        }
        
         
    }

    public function editar() {
        $chave = $this->input->post('ukey');
        $resultado = $this->empresa_model->buscaPorId($chave);

        $retorno = array(
            'ukey' => $resultado->row()->ukey,
            'razao_social' => $resultado->row()->razao_social,
            'nome_fantasia' => $resultado->row()->nome_fantasia,
            'cnpj_cpf' => $resultado->row()->cnpj_cpf,
            'responsavel' => $resultado->row()->responsavel,
            'contato' => $resultado->row()->contato,
            'email' => $resultado->row()->email,
            'telefone_1' => $resultado->row()->telefone_1,
            'telefone_2' => $resultado->row()->telefone_2,
            'telefone_3' => $resultado->row()->telefone_3,
            'endereco' => $resultado->row()->endereco,
            'numero' => $resultado->row()->numero,
            'complemento' => $resultado->row()->complemento,
            'cep' => $resultado->row()->cep,
            'estado' => $resultado->row()->estado,
            'cidade' => $resultado->row()->cidade
        );

        echo json_encode($retorno);
    }

    public function salvar() {

        $acao = "EDITAR";

        $chave = $this->input->post('ukey');

        if ($this->input->post('ukey') == "NOVO") {
            $chave = $this->obj_gen->criaChaveprimaria("U");
            $acao = 'INSERIR';
        }

        $senha = md5($this->input->post('senha'));

        // Preenchendo o objeto empresa com dados que vieram no post
        $usuario = array(
            'ukey' => $chave,
            'cia_ukey' => $chave,
            'nome' => $this->input->post('nome'),
            'cpf' => $this->input->post('cpf'),
            'login' => $this->input->post('login'),
            'senha' => $senha,
            'status' => $this->input->post('status')
        );

        $retorno = "";

        if ($acao == 'INSERIR') {
            $retorno = $this->usuario_model->inserirUsuario($usuario);
        }

        if ($acao == 'EDITAR') {
            $retorno = $this->usuario_model->editarUsuario($usuario);
        }


        if ($retorno) {
            echo 'sucesso';
        } else {

            echo 'error';
        }
    }

}
