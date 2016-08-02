$(document).ready(function () {

    // Esse evento faz a abertura do formulario de cadastro
    $("#btn_painel_novo").click(function () {
        abrirCadastro();

    });

    // Esse enevento faz uma chamada para função assincrona para gravar empresa 
    $("#btn_modal_salvar").click(function () {
        var url = $(this).attr("itemid");

        salvarEmpresa(url);
    });


    // Esse enevento faz uma chamada para função assincrona para abrir a edição da empresa
    $("#btn_painel_editar").click(function () {
        var ukey_empresa = $("input[type=checkbox][name = 'empresa[]']:checked").attr("id");
        alert(ukey_empresa);

        $("#modal_cadastro").modal({
            backdrop: false,
            keyboard: true
        }).modal('show');
    });



    // Evento para o botão limpar
    $("#btn_painel_limpar").click(function () {
        limpaCampos();

    });

    // Evento para o botão fechar DENTRO modal
    // Faz um refresh na pagina do grid
    $("#btn_painel_fechar").click(function () {
        var url = $(this).attr("href");
        window.location.href = url;

    });


    // Evento para o botão fechar EM CIMA NO modal
    // Faz um refresh na pagina do grid
    $("#btn_modal_fechar").click(function () {
        var url = $(this).attr("href");
        window.location.href = url;

    });


    // Esse evento trata a seleção unica dos checkbox da tela
    $(".esp_chk").click(function () {

        var id_clicado = $(this).attr("id");
        var itemid_clicado = $(this).attr("itemid");

        if (id_clicado === itemid_clicado) {

            $(this).prop("checked", false);
            $(".esp_chk").attr("itemid", "00000");
            desabilitaBotoes();

        } else {
            $(".esp_chk").attr("itemid", "00000");
            $(this).attr("itemid", id_clicado);
            $(".esp_chk").prop("checked", false);
            $(this).prop("checked", true);
            habilitaBotoes();
        }


    });



});

function habilitaBotoes() {
    $("#btn_painel_editar").removeAttr('disabled');
    $("#btn_painel_excluir").removeAttr('disabled');
    $("#btn_painel_visualizar").removeAttr('disabled');

}

function desabilitaBotoes() {
    $("#btn_painel_editar").attr('disabled', "disabled");
    $("#btn_painel_excluir").attr('disabled', "disabled");
    $("#btn_painel_visualizar").attr('disabled', "disabled");

}

// Função que chama a janela modal
function abrirCadastro() {

    $("#modal_cadastro").modal({
        backdrop: false,
        keyboard: true
    }).modal('show');

    limpaCampos();


}



// Função para enviar dados para control salvar.
// Envio de forma assincrona
function salvarEmpresa(endereco) {
    $.post(endereco, {
        ukey: "NOVO",
        razao_social: $("#razao_social").val(),
        nome_fantasia: $("#nome_fantasia").val(),
        cnpj_cpf: $("#cnpj_cpf").val(),
        responsavel: $("#responsavel").val(),
        contato: $("#contato").val(),
        email: $("#email").val(),
        telefone_1: $("#telefone_1").val(),
        telefone_2: $("#telefone_2").val(),
        telefone_3: $("#telefone_3").val(),
        endereco: $("#endereco").val(),
        numero: $("#numero").val(),
        complemento: $("#complemento").val(),
        cep: $("#cep").val(),
        estado: $("#estado").val(),
        cidade: $("#cidade").val()
    },
            function (data, status) {

                $("#msg_sucesso").hide();
                $("#msg_sucesso").hide();

                if (data === "sucesso") {
                    limpaCampos();
                    $("#msg_sucesso").show();
                } else {
                    $("#msg_sucesso").show();
                }



            });

}

// Função para limpar os campos do formulário
function limpaCampos() {
    $("#razao_social").val("");
    $("#nome_fantasia").val("");
    $("#cnpj_cpf").val("");
    $("#responsavel").val("");
    $("#contato").val("");
    $("#email").val("");
    $("#telefone_1").val("");
    $("#telefone_2").val("");
    $("#telefone_3").val("");
    $("#endereco").val("");
    $("#numero").val("");
    $("#complemento").val("");
    $("#cep").val("");
    $("#estado").val("");
    $("#cidade").val("");
}

