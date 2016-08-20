$(document).ready(function () {

    //Evento disparado na mudanção de opção na tela de pesquisa
    $("#select_painel").change(function () {

        url = $("#btn_painel_localizar").attr("url");

        // obtendo o valor do atributo value da tag option
        filtro = $("#select_painel option:selected").val();

        if (filtro === 'todos') {
            buscarPorFiltro(url, filtro, "nada");
        } else {
            $('#input_localizar').val("");
        }

    });
    //---------Final do evento disparado na mudanção de opção na tela de pesquisa


    // Evento disparado no click do botão pesquisar
    $("#btn_painel_localizar").click(function () {

        url = $(this).attr("url");

        //obtendo valor digitado na pesquisa
        texto_digitado = $('#input_localizar').val();

        // obtendo o valor do atributo value da tag option
        filtro = $("#select_painel option:selected").val();
        if (url !== "000") {
            buscarPorFiltro(url, filtro, texto_digitado);
        }

        $('#input_localizar').val("");
    });
    //------------Final do Evento disparado no click do botão pesquisar


});
//-------------- Final da função de carregamento do DOM

//Função para limpar formulários -> parametro id do form
function limparFormularios(form_id) {

    $("#" + form_id).each(function () {
        this.reset();
    });
}
//-------------Final da Função para limpar formulários -> parametro id do form


// Função generica que recebe a url e ativa qualquer cadastro com base na coluna status.
function ativar(url) {

    // o Seletor Jquery deve ser sempre esse : "input[type=checkbox][name = 'check[]']:checked"
    // a coluna do grid deve ter esse mesmo atributo
    var ukey = $("input[type=checkbox][name = 'check[]']:checked").attr("id");

    // chamando AJAX assincrono para fazer a busca para preencher a tela de edição
    // Retorno do callback json
    $.post(url, {
        ukey: ukey

    },
            function (data, status) {

                if (data === "Error") {

                    alert('Error!!');

                } else {

                    window.location.href = data;
                }



            });


}
//-------------Final da Função generica que recebe a url e ativa qualquer cadastro com base na coluna status.

// Função que habilita os botões da barra de ferramentas do painel -> Recebe como parametro um Array com ID dos botões a sere habilitados
function habilitaBotoes(botoes) {

    $.each(botoes, function (i, value) {
        if (botoes[i]) {
            $(botoes[i]).removeAttr('disabled');
        }
    });


}
//-------Final da Função que habilita os botões da barra de ferramentas do painel -> Recebe como parametro um Array com ID dos botões a sere habilitados

//Função que desabilita todos os botões
function desabilitaBotoes() {
    $("#btn_painel_editar").attr('disabled', "disabled");
    $("#btn_painel_excluir").attr('disabled', "disabled");
    $("#btn_painel_visualizar").attr('disabled', "disabled");
    $("#btn_painel_inativar").attr('disabled', "disabled");
    $("#btn_painel_maps").attr('disabled', "disabled");

}
//--------Final da Função que desabilita todos os botões

// Função que chama a janela modal
function abrirCadastro() {

    $("#modal_cadastro").modal({
        backdrop: false,
        keyboard: true
    }).modal('show');

}
//--------Final da Função que chama a janela modal



/* Esta função faz as validações dos campos input, caso estejam vazio não será feito o submit do formulario
 * até que todos os campos estejam preenchidos */
function valida() {

    var verificaInput = 'verificar';
    var inputs = $('form').find('input[class*="' + verificaInput + '"]');

    var erros = [];

    erros.length = 0;

    $("#div_error_validacao").hide();

    $.each(inputs, function (i, value) {
        if (inputs[i].value === "") {
            erros[i] = $(inputs[i]).attr("itemid") + " deve ser preenchido!";
        }
    });

    if (erros.length > 0) {

        var texto = "";

        $.each(erros, function (i, value) {
            if (erros[i]) {
                texto = texto + erros[i] + "<br/>";
            }
        });

        $("#div_error_validacao").html(texto).addClass("alert alert-danger").show();

        return false;
    }

    return true;
}
/* -----------Final da função faz as validações dos campos input, caso estejam vazio não será feito o submit do formulario
 * até que todos os campos estejam preenchidos */


//Função que executa a marcação da linha conforme checkbox -> Recebe commo paramero a classe e os botões a serem habilitados
function controlaCheckbox(classe, botoes) {

    // Esse evento trata a seleção unica dos checkbox da tela
    $(classe).click(function () {

        var id_clicado = $(this).attr("id");
        var itemid_clicado = $(this).attr("itemid");

        if (id_clicado === itemid_clicado) {

            $(this).prop("checked", false);
            $(classe).attr("itemid", "00000");
            $(this).closest("tr").removeClass("fundoLinhaPainel");
            desabilitaBotoes();

        } else {
            $(classe).attr("itemid", "00000");
            $(this).attr("itemid", id_clicado);
            $(classe).prop("checked", false);
            $(this).prop("checked", true);
            $(classe).closest("tr").removeClass("fundoLinhaPainel");
            $(this).closest("tr").addClass("fundoLinhaPainel");
            habilitaBotoes(botoes);
        }


    });


}
// ---------fim da Função que executa a marcação da linha conforme checkbox -> Recebe commo paramero a classe e os botões a serem habilitados


// Função que efetua a busca conforme informações digitadas no painel
function  buscarPorFiltro(url, filtro, texto_digitado) {

    $.post(url, {
        filtro: filtro,
        texto_digitado: texto_digitado


    },
            function (data, status) {

                desabilitaBotoes();
                if (data) {
                    $('.panel-body').html(data.html_grid);

                    $('#rodape_painel').html(data.html_footer);

                    controlaCheckbox('.esp_chk', botoes_habilitar);

                    paginacao();

                }

            }, 'json');
}
//----------Final da Função que efetua a busca conforme informações digitadas no painel

//Função para paginação dos grids
function paginacao() {

    // interceptando o click no link da paginação
    $('#ajaxPaginacao li a').on('click', function (e) {

        // previnindo o evento default
        e.preventDefault();

        //recupera a url do link clicado
        URL_pagina = $(this).attr('href');

        //chamada da requisição com AJAX
        $.ajax({
            //define o método da requisição
            method: 'GET',
            //define a url da requisição
            url: URL_pagina,
            //define o tipo de retorno
            dataType: 'json',
            //em caso de sucesso da requisição à url, executa a rotina
            success: function (data) {
                // verificação se houve retorno
                if (data) {
                    //remontando o grid 
                    $('.panel-body').html(data.html_grid);

                    // remontando o rodape do paineil com os link de paginação
                    $('#rodape_painel').html(data.html_footer);

                    // injetando a função para delegação de eventos novamente no DOM modificado
                    paginacao();

                    // injetando a função para delegação de eventos novamente no DOM modificado
                    controlaCheckbox('.esp_chk', botoes_habilitar);

                } else {
                    // $('#error').html('<p class="alert alert-info">Nenhum registro localizado.</p>', function () {});
                }
            },
            //em caso de erro, diz que a página não existe
            error: function () {
                //colocar novo html aqui
            }
        });

        //bloqueia a abertura da url definida no atributo href do link
        return false;


    });

}
//-------Final da Função para paginação dos grids
