<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresa_control extends CI_Controller {

    var $cia_ukey = "";
    var $tabela = "empresa";
    
    public function __construct() {
        parent::__construct();
        // Instaciando o objeto empresa_model, só será usado aqui
        $this->load->model("empresa_model");
        $this->cia_ukey = $this->session->userdata("empresa_logada")['ukey'];
    }

    public function index() {
        
        $this->obj_gen->autoriza();

        $empresa['lista_empresa'] = $this->empresa_model->retornaTodos($this->tabela,$this->cia_ukey);
        $empresa['id_form'] = 'id_form_empresa';

        $html_grid_empresa = $this->load->view('empresa/grid_empresa.php', $empresa, TRUE);
        $html_form_empresa = $this->load->view('empresa/form_empresa.php', $empresa, TRUE);
        $html_opcoes_empresa = $this->load->view('empresa/opcao_pesquisa.php', "", TRUE);

        $dados_painel = array(
            'titulo' => 'Empresas',
            'opcoes' => $html_opcoes_empresa,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''",
            'endereco_btn_editar' => base_url('empresa/editar'),
            'estado_btn_inativar' => "disabled=''",
            'estado_btn_maps' => "disabled=''",
            'endereco_btn_ativar' => ''
        );


        $link_fechar = base_url('empresa');

        // Obeto para injeção de js  especifico.
        $obj_jS = array(
            'js_tela' => "js/empresa/empresa.js"
        );


        $endereco_salvar = base_url('empresa/salvar');

        // Obeto para o preenchmento dos componentes do modal
        $obj_modal = array(
            'titulo_modal' => 'Cadastro de Empresas',
            'btn_cadastrar' => 'Salvar',
            'acao' => $endereco_salvar,
            'fechar' => $link_fechar,
            'formulario' => $html_form_empresa
        );

        $dados['html_empresa'] = $this->obj_gen->retornaPagina($html_grid_empresa, $dados_painel, $obj_jS, $obj_modal);

        $this->load->view('empresa/v_empresa.php', $dados);
    }

    public function editar() {
        
        $this->obj_gen->autoriza();
        
        $chave = $this->input->post('ukey');
        $resultado = $this->empresa_model->buscaPorId($this->tabela,$chave);

        $retorno = array(
            'ukey' => $resultado['ukey'],
            'razao_social' => $resultado['razao_social'],
            'nome_fantasia' => $resultado['nome_fantasia'],
            'cnpj_cpf' => $resultado['cnpj_cpf'],
            'responsavel' => $resultado['responsavel'],
            'contato' => $resultado['contato'],
            'email' => $resultado['email'],
            'telefone_1' => $resultado['telefone_1'],
            'telefone_2' => $resultado['telefone_2'],
            'telefone_3' => $resultado['telefone_3'],
            'endereco' => $resultado['endereco'],
            'numero' => $resultado['numero'],
            'complemento' => $resultado['complemento'],
            'cep' => $resultado['cep'],
            'estado' => $resultado['estado'],
            'cidade' => $resultado['cidade']
        );

        echo json_encode($retorno);
    }

    public function salvar() {
        
        $this->obj_gen->autoriza();
        
        $acao = "EDITAR";

        $chave = $this->input->post('ukey');

        if ($this->input->post('ukey') == "NOVO") {
            $chave = $this->obj_gen->criaChaveprimaria("E");
            $acao = 'INSERIR';
        }

        // Preenchendo o objeto empresa com dados que vieram no post
        $empresa = array(
            'ukey' => $chave,
            'cia_ukey' => $chave,
            'razao_social' => $this->input->post('razao_social'),
            'nome_fantasia' => $this->input->post('nome_fantasia'),
            'cnpj_cpf' => $this->input->post('cnpj_cpf'),
            'responsavel' => $this->input->post('responsavel'),
            'contato' => $this->input->post('contato'),
            'email' => $this->input->post('email'),
            'telefone_1' => $this->input->post('telefone_1'),
            'telefone_2' => $this->input->post('telefone_2'),
            'telefone_3' => $this->input->post('telefone_3'),
            'endereco' => $this->input->post('endereco'),
            'numero' => $this->input->post('numero'),
            'complemento' => $this->input->post('complemento'),
            'cep' => $this->input->post('cep'),
            'estado' => $this->input->post('estado'),
            'cidade' => $this->input->post('cidade')
        );
        
        $retorno = "";
        
        if($acao == 'INSERIR'){
             $retorno = $this->empresa_model->inserir($this->tabela,$empresa);
        }
        
        if($acao == 'EDITAR'){
             $retorno = $this->empresa_model->editar($this->tabela,$empresa);
        }
       

        if ($retorno) {
            echo 'sucesso';
        } else {

            echo 'error';
        }
    }

}
