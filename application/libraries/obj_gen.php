<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Obj_gen extends CI_Loader {

    var $ci;

    public function __construct() {
        $this->ci = &get_instance();
    }

    function retornaPagina($html, $info_painel = array()) {
        
        $dados['conteudo'] = $html;
        $dados['painel']= $info_painel;
        
        $pagina = $this->ci->load->view('layout/v_painel', $dados, true);


        return $pagina;
    }

}
