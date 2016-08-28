<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grade_comissionamento_model extends Dao_model {
    
    public function retornaGradeComissao($tabela, $cia_ukey){
        $this->db->where("cia_ukey", $cia_ukey);
        return $this->db->get($tabela)->result_array();
    }
    public function retornaCondicaoComissao($tabela, $cia_ukey){
        $this->db->where("cia_ukey", $cia_ukey);
        return $this->db->get($tabela)->result_array();
    }
    public function retornaSeguradora($tabela, $cia_ukey){
        $this->db->where("cia_ukey", $cia_ukey);
        return $this->db->get($tabela)->result_array();
    }
    public function retornaProduto($tabela, $cia_ukey){
        $this->db->where("cia_ukey", $cia_ukey);
        return $this->db->get($tabela)->result_array();
    }

}
