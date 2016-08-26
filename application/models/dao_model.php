<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dao_model extends CI_Model {

    public function inserir($tabela, $objeto) {
        return $this->db->insert($tabela, $objeto);
    }

    function contarTodos($tabela, $cia_ukey) {
        $this->db->where("cia_ukey", $cia_ukey);
        return $this->db->count_all($tabela);
    }
    
    function contarTodosPorBusca($tabela, $cia_ukey, $filtro, $valor_procurado) {
        
        $this->db->where("cia_ukey", $cia_ukey);
        
        if ($filtro != "todos" && $filtro != "codigo") {
            $this->db->like($filtro, $valor_procurado);
        }

        if ($filtro == "codigo") {
            $this->db->where($filtro, $valor_procurado);
        }
        
        $this->db->from($tabela);
        
        return $this->db->get()->num_rows();
    }

    public function retornaTodos($tabela, $ukey, $sort = 'codigo', $order = 'asc', $limit = null, $offset = null) {

        $this->db->order_by($sort, $order);

        if ($limit)
            $this->db->limit($limit, $offset);

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

    public function buscarPorFiltro($tabela, $filtro, $valor_procurado,
                                            $sort = 'codigo', $order = 'asc', $limit = null, $offset = null) {
        
        $this->db->order_by($sort, $order);

        if ($limit)
            $this->db->limit($limit, $offset);

        if ($filtro != "todos" && $filtro != "codigo") {
            $this->db->like($filtro, $valor_procurado);
        }

        if ($filtro == "codigo") {
            $this->db->where($filtro, $valor_procurado);
        }
        
        $this->db->where("cia_ukey", $this->session->userdata("empresa_logada")['ukey']);

        return $this->db->get($tabela)->result_array();
    }

}
