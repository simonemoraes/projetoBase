<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Empresa_model extends Dao_model {

     public function retornaTodos($tabela, $ukey) {
        $this->db->where("ukey", $ukey);
        return $this->db->get($tabela)->result_array();
    }
   
}
