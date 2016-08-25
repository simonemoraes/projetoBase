<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supervisao_model extends Dao_model {
    
    // Select que retorna todos os dados
    public function retornaTodos($tabela, $ukey, $sort = 'supervisor', $order = 'asc', $limit = null, $offset = null) {

        $this->db->select('sup.ukey as ukey, sp.nome as supervisor, eq.nome as equipe, sup.data_inicio, sup.data_fim');
        $this->db->from($tabela . " as sup");
        $this->db->join('supervisores sp', 'sp.ukey = sup.supervisor_ukey');
        $this->db->join('equipes eq', 'eq.ukey = sup.equipe_ukey');

        $this->db->order_by($sort, $order);

        if ($limit)
            $this->db->limit($limit, $offset);

        $this->db->where("sup.cia_ukey", $ukey);
        $this->db->group_by("ukey"); 
        return $this->db->get($tabela)->result_array();
    }

    public function retornaEquipes($cia_ukey) {
        $this->db->where("cia_ukey", $cia_ukey);
        $this->db->where("status", 1);
        return $this->db->get("equipes")->result_array();
    }

    public function retornaSupervisores($cia_ukey) {
        $this->db->where("cia_ukey", $cia_ukey);
        $this->db->where("status", 1);
        return $this->db->get("supervisores")->result_array();
    }

    public function validaSupervisorPorEquipe($cia_ukey, $tabela, $supervisor, $equipe, $data_inicio) {

        $where = "(cia_ukey ='$cia_ukey' AND supervisor_ukey='$supervisor' and equipe_ukey = '$equipe' and data_fim = '0000-00-00') or ";
        $where = $where . "(cia_ukey ='$cia_ukey' AND supervisor_ukey='$supervisor' and equipe_ukey = '$equipe' and data_fim >= '$data_inicio')";

        $this->db->where($where);
        $this->db->from($tabela);

        return $this->db->get()->num_rows();
    }
    
    
    public function retornaPorUkey($tabela, $cia_ukey, $ukey) {

        $this->db->select('sup.ukey as ukey, sp.nome as supervisor, eq.nome as equipe, sup.data_inicio, sup.data_fim');
        $this->db->from($tabela . " as sup");
        $this->db->join('supervisores sp', 'sp.ukey = sup.supervisor_ukey');
        $this->db->join('equipes eq', 'eq.ukey = sup.equipe_ukey');


        $this->db->where("sup.ukey", $ukey);
        $this->db->where("sup.cia_ukey", $cia_ukey);
        return $this->db->get($tabela)->row_array();
    }
    
     public function desligar($tabela, $data_fim, $chave) {
        $this->db->where('ukey', $chave);
        $this->db->set("data_fim",$data_fim);
        return $this->db->update($tabela);
    }

}
