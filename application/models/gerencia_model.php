<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gerencia_model extends Dao_model {

    public function retornaTodos($tabela, $ukey, $sort = 'gerente', $order = 'asc', $limit = null, $offset = null) {

        $this->db->select('ger.ukey as ukey, gr.nome as gerente, eq.nome as equipe, ger.data_inicio, ger.data_fim');
        $this->db->from($tabela . " as ger");
        $this->db->join('gerentes gr', 'gr.ukey = ger.gerente_ukey');
        $this->db->join('equipes eq', 'eq.ukey = ger.equipe_ukey');

       $this->db->order_by("gr.nome", "asc");
       $this->db->order_by("ger.data_fim", "desc");

        if ($limit) {
            $this->db->limit($limit, $offset);
        }


        $this->db->where("ger.cia_ukey", $ukey);
        $this->db->group_by("ukey");
        return $this->db->get($tabela)->result_array();
    }

    public function retornaEquipes($cia_ukey) {
        $this->db->where("cia_ukey", $cia_ukey);
        $this->db->where("status", 1);
        return $this->db->get("equipes")->result_array();
    }

    public function retornaGerentes($cia_ukey) {
        $this->db->where("cia_ukey", $cia_ukey);
        $this->db->where("status", 1);
        return $this->db->get("gerentes")->result_array();
    }

    public function validaGerentePorEquipe($cia_ukey, $tabela, $gerente, $equipe, $data_inicio) {

        $where = "(cia_ukey ='$cia_ukey' AND gerente_ukey='$gerente' and equipe_ukey = '$equipe' and data_fim = '0000-00-00') or ";
        $where = $where . "(cia_ukey ='$cia_ukey' AND gerente_ukey='$gerente' and equipe_ukey = '$equipe' and (data_fim >= '$data_inicio' and data_inicio <= '$data_inicio'))";

        $this->db->where($where);
        $this->db->from($tabela);

        return $this->db->get()->num_rows();
    }

    public function retornaPorUkey($tabela, $cia_ukey, $ukey) {

        $this->db->select('ger.ukey as ukey, gr.nome as gerente, eq.nome as equipe, ger.data_inicio, ger.data_fim');
        $this->db->from($tabela . " as ger");
        $this->db->join('gerentes gr', 'gr.ukey = ger.gerente_ukey');
        $this->db->join('equipes eq', 'eq.ukey = ger.equipe_ukey');


        $this->db->where("ger.ukey", $ukey);
        $this->db->where("ger.cia_ukey", $cia_ukey);
        return $this->db->get($tabela)->row_array();
    }

    public function desligar($tabela, $data_fim, $chave) {
        $this->db->where('ukey', $chave);
        $this->db->set("data_fim", $data_fim);
        return $this->db->update($tabela);
    }

    public function buscarPorFiltroGerencia($tabela, $filtro, $valor_procurado) {

        $this->db->select('ger.ukey as ukey, gr.nome as gerente, eq.nome as equipe, ger.data_inicio, ger.data_fim');
        $this->db->from($tabela . " as ger");
        $this->db->join('gerentes gr', 'gr.ukey = ger.gerente_ukey');
        $this->db->join('equipes eq', 'eq.ukey = ger.equipe_ukey');

        $this->db->where("ger.cia_ukey", $this->session->userdata("empresa_logada")['ukey']);
        
        if ($filtro != "todos") {
            $this->db->like($filtro, $valor_procurado);
        }

        $this->db->group_by("ukey");
        $this->db->order_by("gr.nome", "asc");
        return $this->db->get($tabela)->result_array();
    }

}
