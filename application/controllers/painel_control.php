<?php

class Painel_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function menu() {
        
        $conteudo_painel = $this->load->view('adm/testerui.php',"",TRUE);
        
        $dados['paginaok'] = $this->obj_gen->retornaPagina($conteudo_painel);

        $this->load->view('adm/v_clientes.php',$dados);
        
        
    }

    public function ativar($id_menu) {
        
              
       $menu = $this->menu_model->retornaMenuById($id_menu);

        if ($menu['status'] == 0) {
            $menu['status'] = 1;
        } else {
            $menu['status'] = 0;
        }
       
        $ok = $this->menu_model->ativarMenu($id_menu, $menu);

        if ($ok) {
            echo $menu['status'];
        } else {
            echo 'Falha';
        }
    }

}
