<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seguradora_model extends CI_Model {

    public function inserirSeguradora($seguradora) {
        return $this->db->insert("seguradoras", $seguradora);
    }

    public function retornaSeguradoras($cia_ukey) {
        $this->db->where("cia_ukey", $cia_ukey);
        return $this->db->get("seguradoras")->result_array();
    }

    public function retornaSeguradoraPorCodigo($codigo) {
        $this->db->where("codigo", $codigo);
        return $this->db->get("seguradoras")->row_array();
    }

    public function buscaPorId($id) {
        $this->db->where("ukey", $id);
        return $this->db->get("seguradoras");
    }

    public function editarSeguradora($seguradora) {
        $this->db->where('ukey', $seguradora['ukey']);
        return $this->db->update("seguradoras", $seguradora);
    }

}
