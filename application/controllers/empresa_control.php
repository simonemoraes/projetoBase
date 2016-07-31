<?php

class Empresa_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Instaciando o objeto empresa_model, só será usado aqui
        $this->load->model("empresa_model");
    }

    public function index() {

        $empresa['lista_empresa'] = $this->empresa_model->retornaEmpresas();

        $html_grid_empresa = $this->load->view('empresa/grid_empresa.php', $empresa, TRUE);
        $html_form_empresa = $this->load->view('empresa/form_empresa.php', "", TRUE);
        $html_opcoes_empresa = $this->load->view('empresa/opcao_pesquisa.php', "", TRUE);

        $dados_painel = array(
            'titulo' => 'Empresas',
            'opcoes' => $html_opcoes_empresa,
            'estado_btn_novo' => "",
            'estado_btn_editar' => "disabled=''",
            'estado_btn_excluir' => "disabled=''",
            'estado_btn_visualizar' => "disabled=''"
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

    public function salvar() {

        $chave = "";

        if ($this->input->post('ukey') == "NOVO") {
            $chave = $this->obj_gen->criaChaveprimaria("E");
        } else {
            $chave = $this->input->post('ukey');
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



        $retorno = $this->empresa_model->inserirEmpresa($empresa);

        if ($retorno) {
            echo 'sucesso';
        } else {

            echo 'error';
        }
    }

}
