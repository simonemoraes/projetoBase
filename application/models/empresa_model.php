<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Empresa_model extends CI_Model {

    public function inserirEmpresa($empresa) {
        return $this->db->insert("empresa",$empresa);
    }
    
    public function retornaEmpresas(){
        return $this->db->get("empresa")->result_array();
    }
    
    public function buscaPorId($id){
        $this->db->where("ukey",$id);
        return $this->db->get("empresa");
    }
    
    public function editarEmpresa($empresa){
        $this->db->where('ukey', $empresa['ukey']);
        return $this->db->update("empresa",$empresa);
    }
    
   
}
