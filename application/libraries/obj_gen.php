<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Obj_gen extends CI_Loader {

    var $ci;

    public function __construct() {
        $this->ci = &get_instance();
    }

    function retornaPagina($html) {
        
        $dados['conteudo'] = $html;
        
        $pagina = $this->ci->load->view('layout/v_painel', $dados, true);


        return $pagina;
    }

}
