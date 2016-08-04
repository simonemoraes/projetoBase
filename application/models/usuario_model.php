<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {

   public function retornaUsuarios(){
        return $this->db->get("usuarios")->result_array();
    }

}
