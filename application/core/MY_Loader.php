<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
    
     
    
    public function template($nome = "", $dados = array(), $dadosmenu = array()) {
               
        $menus = array("menus" => $dadosmenu);
        
        $this->view("cabecalho.php",$menus);
        $this->view($nome, $dados);
        $this->view("sobre.php");
        $this->view("contato.php");
        $this->view("rodape.php");
    }
    
    
}
