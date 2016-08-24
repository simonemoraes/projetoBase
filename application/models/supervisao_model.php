<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supervisao_model extends Dao_model {
    
     public function retornaTodos($tabela, $ukey, $sort = 'supervisor', $order = 'asc', $limit = null, $offset = null) {

        $this->db->select('sup.ukey as ukey, sp.nome as supervisor, eq.nome as equipe, sup.data_inicio, sup.data_fim');
        $this->db->from($tabela . " as sup");
        $this->db->join('supervisores sp', 'sp.ukey = sup.supervisor_ukey');
        $this->db->join('equipes eq', 'eq.ukey = sup.equipe_ukey');
               
         $this->db->order_by($sort, $order);

        if ($limit)
            $this->db->limit($limit, $offset);

        $this->db->where("sup.cia_ukey", $ukey);
        return $this->db->get($tabela)->result_array();
    }
    
     public function retornaEquipes($cia_ukey){
          $this->db->where("cia_ukey", $cia_ukey);
          $this->db->where("status", 1);
          return $this->db->get("equipes")->result_array();
     }
     
     
      public function retornaSupervisores($cia_ukey){
          $this->db->where("cia_ukey", $cia_ukey);
          $this->db->where("status", 1);
          return $this->db->get("supervisores")->result_array();
     }

}
