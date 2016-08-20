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
    
    function paginacao($endereco,$total_rgistros){
        
        $config = array(
            "base_url" => base_url($endereco),
            "per_page" => 7,//numero de registro por link
            "num_links" => 3,// numero de links na pagina
            "uri_segment" => 3,
            "total_rows" => $total_rgistros,
            "full_tag_open" => "<ul id='ajaxPaginacao' class='pagination' style = 'margin: 0px;'>", //tag de abertura
            "full_tag_close" => "</ul>", //tag de fechamento
            "first_link" => false, //link puxando para a primeira pagina
            "last_link" => false, //link puxando para a ultima pagina
            "first_tag_open" => "<li>", //tag de abertura do primeiro link
            "first_tag_close" => "</li>", //tag de fechamento do primeiro link
            "prev_link" => "Anterior", //conteudo a ser exibido para o link de paginação que leva a pagina anterior 
            "prev_tag_open" => "<li class='prev'>", //tag de abertura para prev link
            "prev_tag_close" => "</li>", //tag de fechamento para prev link
            "next_link" => "Próxima", //conteudo a ser exibido para o link de paginação que leva a proxima pagina
            "next_tag_open" => "<li class='next'>", //tag de abertura para next link
            "next_tag_close" => "</li>", //tag de fechamento para next link
            "last_tag_open" => "<li>", //tag de abertura para a ultima pagina
            "last_tag_close" => "</li>", //tag de fechemento para a ultima pagina 
            "cur_tag_open" => "<li class='active'><a href='#'>", //tag de abertura a ser adicionada para o item ativo
            "cur_tag_close" => "</a></li>", //tag de fechamento a ser adicionada para o item ativo
            "num_tag_open" => "<li>", //tag de abertura a ser adicionada para os itens numericos(as paginas da nossa aplicação
            "num_tag_close" => "</li>"//tag de fechamento a ser adicionada para os itens numericos(as paginas da nossa aplicação
        );
        
        $this->ci->pagination->initialize($config);
        
        $data['paginacao'] = $this->ci->pagination->create_links();
        
        $offset = ($this->ci->uri->segment(3)) ? $this->ci->uri->segment(3) : 0;
        
        $resultado_por_pg = $config['per_page'];
        
        
        $data['offset'] = $offset;
        $data['resultado_por_pg'] = $resultado_por_pg;
        
        return $data;
        
    }

}
