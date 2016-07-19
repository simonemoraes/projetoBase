<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends CI_Model {
    
    public function listaMenus(){
        $this->db->where('status', 1);
        return $this->db->get("menu")->result_array();
    }
}
