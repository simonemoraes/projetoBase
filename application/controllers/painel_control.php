<?php

class Painel_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function menu() {

        $dados['menu'] = $this->menu_model->listaMenus(1);

        $dados['titulo_site'] = 'Titulo site';

        $this->load->view('adm/v_painel.php', $dados);
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
