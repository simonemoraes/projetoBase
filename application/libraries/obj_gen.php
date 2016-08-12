<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Obj_gen extends CI_Loader {

    var $ci;

    public function __construct() {
        $this->ci = &get_instance();
    }

    function autoriza() {

        $usuarioLogado = $this->ci->session->userdata("usuario_logado");
        if (!$usuarioLogado) {
            $this->ci->session->set_flashdata("erro", "Voce precisa estar logado!");
            redirect("login");
        }

        return $usuarioLogado;
    }

    function retornaPagina($html, $info_painel = array(), $funcao = array(), $modal = array()) {

        $dados['conteudo'] = $html;
        $dados['painel'] = $info_painel;
        $dados['funcao_especifica'] = $funcao;
        $dados['modal'] = $modal;

        $pagina = $this->ci->load->view('layout/v_painel', $dados, true);


        return $pagina;
    }

    function criaChaveprimaria($tipo = "") {

        $chave = "";
        // Essa informação vem da Sessão.
        $chave_do_usuario = substr($this->ci->session->userdata("usuario_logado")['ukey'], 8, 4);

        list($dia, $mes, $ano) = explode('/', date('d/m/Y'));

        $chave = $ano . $mes . $dia;


        if (empty($tipo)) {
            // Chave para todos os registros
            $chave = $chave . $chave_do_usuario . md5(rand(10000000, 99999999));
            $chave = substr($chave, 0, 20);
        } else {

            if ($tipo === "E") {

                // Chave para cadastro de empresa
                $chave = md5(rand(10000000, 99999999));
                $chave = substr($chave, 0, 4);
            } else {

                // Chave para cadastro usuario
                $chave = $chave . md5(rand(10000000, 99999999));
                $chave = substr($chave, 0, 12);
            }
        }

        return strtoupper($chave);
    }
    
    function getCiaUkey(){
        return $this->ci->session->userdata("empresa_logada")['ukey'];
    }

}
