<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parcela_model extends Dao_model {
    
     public function inserirParcela($tabela, $objeto) {
        return $this->db->insert_batch($tabela, $objeto);
    }

}
