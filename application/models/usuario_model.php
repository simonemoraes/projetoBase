<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_model extends Dao_model {

    public function verificaLoginExistente($usuario, $cia_ukey) {

        $this->db->where("login", $usuario);
        $this->db->where("cia_ukey", $cia_ukey);
        return $this->db->get("usuarios")->row_array();
    }

    

}
