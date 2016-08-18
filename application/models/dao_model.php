<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dao_model extends CI_Model {

    public function inserir($tabela, $objeto) {
        return $this->db->insert($tabela, $objeto);
    }

    
    public function retornaTodos($tabela, $ukey) {
        $this->db->where("cia_ukey", $ukey);
        return $this->db->get($tabela)->result_array();
    }

    public function retornaPorCodigo($tabela, $codigo) {
        $this->db->where("codigo", $codigo);
        return $this->db->get($tabela)->row_array();
    }

    public function buscaPorId($tabela, $id) {
        $this->db->where("ukey", $id);
        return $this->db->get($tabela)->row_array();
    }

    public function editar($tabela, $objeto) {
        $this->db->where('ukey', $objeto['ukey']);
        return $this->db->update($tabela, $objeto);
    }
    
    public function buscarPorFiltro($tabela,$filtro, $valor_procurado) {

        if ($filtro != "todos" && $filtro != "codigo") {
            $this->db->like($filtro, $valor_procurado);
        }

        if ($filtro == "codigo") {
            $this->db->where($filtro, $valor_procurado);
        }

        return $this->db->get($tabela)->result_array();
    }

}
