$(document).ready(function () {
    
    $("#nome").blur(function(){
        removeMsg();
    });

    // Esse evento faz a abertura do formulario de cadastro
    $("#btn_painel_novo").click(function () {
        abrirCadastro();

    });

    // Esse enevento faz uma chamada para função assincrona para gravar usuario 
    $("#btn_modal_salvar").click(function () {
        if (valida()) {
            var url = $(this).attr("itemid");
            salvarSeguradora(url);
        }

    });

    // Esse evento faz a abertura do formulario de cadastro
    $("#btn_painel_inativar").click(function () {
        var url = $(this).attr("itemid");
        //Função no js_base
        ativar(url);

    });




    // Evento para o botão limpar
    $("#btn_painel_limpar").click(function () {
        limparForm();

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

    // Esse enevento faz uma chamada para função assincrona para abrir a edição da empresa
    $("#btn_painel_editar").click(function () {

        var ukey_usuario = $("input[type=checkbox][name = 'check[]']:checked").attr("id");
        var url = $(this).attr("itemid");


        // chamando AJAX assincrono para fazer a busca para preencher a tela de edição
        // Retorno do callback json
        $.post(url, {
            ukey: ukey_usuario,
        },
                function (data, status) {

                    if (status === "success") {

                        // metodo que preenche o objeto da tela com json retornado.
                        preencherObjetoSeguradora(data);

                        abrirCadastro();

                    } else {
                        $("#msg_error").show();
                    }



                }, 'json');

    });




});

function  preencherObjetoSeguradora(data) {
    $("#ukey").val(data.ukey);
    $("#nome").val(data.nome);
    $("#descricao").val(data.descricao);


}


function  salvarSeguradora(url) {
    var chave = 'NOVO'

    if ($('#ukey').val() !== '') {
        chave = $('#ukey').val();
    }

    var nome = $("#nome").val();
    var descricao = $("#descricao").val();

    $.post(url, {
        ukey: chave,
        nome: nome,
        descricao: descricao

    },
            function (data, status) {

                $("#msg_sucesso").hide();
                $("#msg_error").hide();

                if (data === "sucesso") {
                    limparForm();
                    $("#msg_sucesso").show();
                    $("#msg_sucesso").html("<p>Seguradora salva com sucesso!</p>");
                    $("#nome").focus();
                } else {
                    $("#msg_error").show();
                    $("#msg_error").html("<p>Erro gravando seguradota, tente novamente!</p>");
                    $("#nome").focus();
                }

            });
}

function limparForm() {
    var id_form = $("form").attr("id");
    limparFormularios(id_form);
}

// Essa função trata a seleção unica dos checkbox da tela
// Essa fução está no JS_base.
var botoes_habilitar = ['#btn_painel_editar', "#btn_painel_inativar"]
controlaCheckbox('.esp_chk', botoes_habilitar);