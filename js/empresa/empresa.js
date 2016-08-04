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
        var url = $(this).attr("itemid");
        // chamando AJAX assincrono para fazer a busca para preencher a tela de edição
        // Retorno do callback json
        $.post(url, {
            ukey: ukey_empresa,
        },
                function (data, status) {

                    $("#msg_sucesso").hide();
                    $("#msg_error").hide();

                    if (status === "success") {
                        
                        // metodo que preenche o objeto da tela com json retornado.
                        preencherObjeto(data);

                        abrirCadastro();

                    } else {
                         $("#msg_error").show();
                    }



                }, 'json');

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
    
    // Essa função trata a seleção unica dos checkbox da tela
    // Essa fução está no JS_base.
    controlaCheckbox(".esp_chk");


});




// Função para enviar dados para control salvar.
// Envio de forma assincrona
// metodo chamada para salvar ou editar registro
function salvarEmpresa(endereco) {

    var chave = 'NOVO'

    if ($('#ukey').val() !== '') {
        chave = $('#ukey').val();
    }

    $.post(endereco, {
        ukey: chave,
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
                $("#msg_error").hide();

                if (data === "sucesso") {
                    limpaCampos();
                    $("#msg_sucesso").show();
                } else {
                    $("#msg_error").show();
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

function preencherObjeto(data) {
    $("#ukey").val(data.ukey);
    $("#razao_social").val(data.razao_social);
    $("#nome_fantasia").val(data.nome_fantasia);
    $("#cnpj_cpf").val(data.cnpj_cpf);
    $("#responsavel").val(data.responsavel);
    $("#contato").val(data.contato);
    $("#email").val(data.email);
    $("#telefone_1").val(data.telefone_1);
    $("#telefone_2").val(data.telefone_2);
    $("#telefone_3").val(data.telefone_3);
    $("#endereco").val(data.endereco);
    $("#numero").val(data.numero);
    $("#complemento").val(data.complemento);
    $("#cep").val(data.cep);
    $("#estado").val(data.estado);
    $("#cidade").val(data.cidade);
}


