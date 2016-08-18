$(document).ready(function () {

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


    // Esse evento faz a abertura do formulario de cadastro
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



});

function limparFormularios(form_id) {

    $("#" + form_id).each(function () {
        this.reset();
    });
}

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


function habilitaBotoes(botoes) {

    $.each(botoes, function (i, value) {
        if (botoes[i]) {
            $(botoes[i]).removeAttr('disabled');
        }
    });


}

function desabilitaBotoes() {
    $("#btn_painel_editar").attr('disabled', "disabled");
    $("#btn_painel_excluir").attr('disabled', "disabled");
    $("#btn_painel_visualizar").attr('disabled', "disabled");
    $("#btn_painel_inativar").attr('disabled', "disabled");
    $("#btn_painel_maps").attr('disabled', "disabled");

}

// Função que chama a janela modal
function abrirCadastro() {

    $("#modal_cadastro").modal({
        backdrop: false,
        keyboard: true
    }).modal('show');

}




/* Esta função fz as validações dos campos input, caso estejam vazio não será feito o submit do formulario
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
// fim da função


function  buscarPorFiltro(url, filtro, texto_digitado) {

    $.post(url, {
        filtro: filtro,
        texto_digitado: texto_digitado


    },
            function (data, status) {
                desabilitaBotoes();
                if (data) {
                    $('.panel-body').html(data);
                    controlaCheckbox('.esp_chk', botoes_habilitar);
                } 

            }, 'text');
}
