<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function listaMenus($select = 0) {
        if ($select == 0) {
            $this->db->where('status', 1);
        }

        return $this->db->get("menu")->result_array();
    }
    
    public function retornaMenuById($id){
        $this->db->where('id', $id);
        return $this->db->get("menu")->row_array();
    }
    
    public function ativarMenu($id,$menu){
        $this->db->where('id', $id);
        return $this->db->update("menu",$menu);
    }

}
