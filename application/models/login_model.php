<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function logar($usuario, $senha, $cia_ukey) {

        $this->db->where("login", $usuario);
        $this->db->where("senha", md5($senha));
        $this->db->where("cia_ukey", $cia_ukey);
        $this->db->where("status", 1);

        return $this->db->get("usuarios")->row_array();
    }

   

}
