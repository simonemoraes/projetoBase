$(document).ready(function () {

    // Esse evento faz a abertura do formulario de cadastro
    $("#btn_painel_novo").click(function () {
        abrirCadastro();

    });

    // Esse enevento faz uma chamada para função assincrona para gravar usuario 
    $("#btn_modal_salvar").click(function () {
        if (valida()) {

            if ($('#senha').val() !== $('#confirmar_senha').val()) {
                $("#div_error_validacao").html("Senha e confirmação não podem ser diferentes!").addClass("alert alert-danger").show();
            } else {
                var url = $(this).attr("itemid");
                salvarUsuario(url);
            }


        }

    });

    // Esse evento faz a abertura do formulario de cadastro
    $("#btn_painel_inativar").on('click',function () {
        var url = $(this).attr("itemid");
        //Função no js_base
        ativar(url);

    });




    // Evento para o botão limpar
    $("#btn_painel_limpar").click(function () {
        limparForm()
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

    // Esse enevento faz uma chamada para função assincrona para abrir a edição do usuario
    $("#btn_painel_editar").click(function () {

        var ukey_usuario = $("input[type=checkbox][name = 'check[]']:checked").attr("id");
        var url = $(this).attr("itemid");

        //escondendo esses campos na edição, pois não podem ser preenchidos.
        $("#box_confirma_senha").hide();
        $("#box_senha").hide();
        
        // removendo a classe verificar para que os campos não passem por validação
        // na edição.
        $('#senha').removeClass("verificar");
        $('#confirmar_senha').removeClass("verificar");

        $('#login').attr("disabled", "");
        $('#btn_painel_limpar').attr("disabled", "");


        // chamando AJAX assincrono para fazer a busca para preencher a tela de edição
        // Retorno do callback json
        $.post(url, {
            ukey: ukey_usuario,
        },
                function (data, status) {

                    if (status === "success") {

                        // metodo que preenche o objeto da tela com json retornado.
                        preencherObjetoUsuario(data);

                        abrirCadastro();

                    } else {
                        $("#msg_error").show();
                    }



                }, 'json');

    });

    // Chamama na saida do campo login
    // faz a verificação da existencia de login já existente no banco
    $('#login').change(function () {

        $('#div_error_validacao').hide();

        var sEmail = $(this).val();

        // filtros
        var emailFilter = /^.+@.+\..{2,}$/;
        var illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/
        // condição
        if (!(emailFilter.test(sEmail)) || sEmail.match(illegalChars)) {
            texto = "Digite um e-mail valido!"
            $('#div_error_validacao').html(texto).addClass("alert alert-danger").show();
            $(this).val("");
            $(this).focus();
        } else {

            url = $(this).attr("url");
            login = $(this).val();
            obj = $(this);

            verificaUsuarioExistente(url, login, obj)

        }




    });

});

function  preencherObjetoUsuario(data) {
    $("#ukey").val(data.ukey);
    $("#nome").val(data.nome);
    $("#cpf").val(data.cpf);
    $("#login").val(data.login);

}

function verificaUsuarioExistente(url, login, objeto) {

    $.post(url, {
        login: login,
    },
            function (data, status) {

                if (data === 'sim') {
                    texto = "Login " + objeto.val() + " já existe! Por favor escolha outro.";
                    $('#div_error_validacao').html(texto).addClass("alert alert-danger").show();


                    objeto.val("");
                    objeto.focus();
                }


            });

}


function  salvarUsuario(url) {
    var chave = 'NOVO'

    if ($('#ukey').val() !== '') {
        chave = $('#ukey').val();
    }

    $.post(url, {
        ukey: chave,
        nome: $("#nome").val(),
        cpf: $("#cpf").val(),
        login: $("#login").val(),
        senha: $("#senha").val(),
        status: 1

    },
            function (data, status) {

                $("#msg_sucesso").hide();
                $("#msg_error").hide();

                if (data === "sucesso") {
                    limparForm();
                    $("#msg_sucesso").show();
                } else {
                    $("#msg_error").show();
                }


            });
}

function limparForm() {
    var id_form = $("form").attr("id");
    limparFormularios(id_form);
}

// Essa função trata a seleção unica dos checkbox da tela
// Essa fução está no JS_base.
// Array deve receber os id dos botões que serão habilitados no clique do checkbox
var botoes_habilitar = ['#btn_painel_editar', "#btn_painel_inativar"]
controlaCheckbox('.esp_chk', botoes_habilitar);