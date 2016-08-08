<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_control extends CI_Controller {

    var $ukey = "";

    public function __construct() {
        parent::__construct();
        $this->load->model("empresa_model");
        $this->load->model("login_model");
    }

    public function index() {

        $this->load->view('login/login.php');
    }

    public function buscarEmpresa() {

        $codigo = $this->input->post('codigo');

        $empresa = $this->empresa_model->retornaEmpresaPorCodigo($codigo);

        $this->ukey = isset($empresa['ukey']) ? $empresa['ukey'] : "";

        echo $this->ukey;
    }

    public function entrar() {

        $codigo = $this->input->post('codigo_empresa');
        $login = $this->input->post('login');
        $senha = $this->input->post('senha');

        // primeiro pego a empresa pelo codigo informado.
        $empresa = $this->empresa_model->retornaEmpresaPorCodigo($codigo);

        $usuario = $this->login_model->logar($login, $senha, $empresa['ukey']);


        if (isset($usuario['ukey'])) {

            $this->session->set_userdata("usuario_logado", $usuario);
            $this->session->set_userdata("empresa_logada", $empresa);
            
            $this->session->set_flashdata("sucesso",$usuario['nome'] . '. Seja bem vindo ao sistema!');
        } else {

            $this->session->set_flashdata("erro", "Usuario e ou senha invalidos");
        }

        redirect('login');
    }

    public function sair() {
        $this->session->unset_userdata("usuario_logado");
        $this->session->unset_userdata("empresa_logada");
        redirect('login');
    }

}
