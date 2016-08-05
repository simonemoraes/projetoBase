<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function retornaUsuarios() {
        return $this->db->get("usuarios")->result_array();
    }
    
     public function inserirUsuario($usuario) {
        return $this->db->insert("usuarios",$usuario);
    }
    
     public function buscaPorId($id){
        $this->db->where("ukey",$id);
        return $this->db->get("usuarios")->row_array();
    }
    
    public function editarUsuario($usuario){
        $this->db->where('ukey', $usuario['ukey']);
        return $this->db->update("usuarios",$usuario);
    }

}
