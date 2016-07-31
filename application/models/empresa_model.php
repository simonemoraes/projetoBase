<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Empresa_model extends CI_Model {

    public function inserirEmpresa($empresa) {
        return $this->db->insert("empresa",$empresa);
    }
    
    public function retornaEmpresas(){
        return $this->db->get("empresa")->result_array();
    }
    
   
}
