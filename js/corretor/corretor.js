$(document).ready(function () {

    $('#cep').blur(function () {
        var cep = $('#cep').val();
        var url = 'http://cep.republicavirtual.com.br/web_cep.php?cep=' + cep + '&formato=json';

        $('#valida_cep').hide();


        $.get(url, function (data, status) {
            if (data.resultado === '1') {
                $("#endereco").val(data.tipo_logradouro + " "+data.logradouro);
                $("#bairro").val(data.bairro);
                $("#complemento").val(data.complemento);
                $("#cidade").val(data.cidade);
                $("#estado").val(data.uf);

                $("#endereco").removeAttr('disabled');
                $("#bairro").removeAttr('disabled');
                $("#complemento").removeAttr('disabled');
                $("#cidade").removeAttr('disabled');
                $("#estado").removeAttr('disabled');


            } else {
                $("#endereco").attr('disabled', '');
                $("#bairro").attr('disabled', '');
                $("#complemento").attr('disabled', '');
                $("#cidade").attr('disabled', '');
                $("#estado").attr('disabled', '');

                $("#endereco").val("");
                $("#bairro").val("");
                $("#complemento").val("");
                $("#cidade").val("");
                $("#estado").val("");
                $('#valida_cep').html("Preencha um CEP valido!");
                $('#valida_cep').show();
                $('#cep').focus();
            }
        }, 'json');
    });

    // Esse evento faz a abertura do formulario de cadastro
    $("#btn_painel_novo").click(function () {
        abrirCadastro();

    });

    // Esse enevento faz uma chamada para função assincrona para gravar usuario 
    $("#btn_modal_salvar").click(function () {
        if (valida()) {
            var url = $(this).attr("itemid");
            salvarCorretor(url);
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

        var ukey_produto = $("input[type=checkbox][name = 'check[]']:checked").attr("id");
        var url = $(this).attr("itemid");


        // chamando AJAX assincrono para fazer a busca para preencher a tela de edição
        // Retorno do callback json
        $.post(url, {
            ukey: ukey_produto,
        },
                function (data, status) {

                    if (status === "success") {

                        // metodo que preenche o objeto da tela com json retornado.
                        preencherObjetoCorretor(data);

                        abrirCadastro();

                    } else {
                        $("#msg_error").show();
                    }



                }, 'json');

    });




});

function  preencherObjetoCorretor(data) {
    $("#ukey").val(data.ukey);
    $("#nome").val(data.nome);
    $("#cpf").val(data.cpf);
    $("#email").val(data.email);
    $("#telefone").val(data.telefone);
    $("#celular").val(data.celular);
    $("#cep").val(data.cep);
    $("#endereco").val(data.endereco);
    $("#bairro").val(data.bairro);
    $("#complemento").val(data.complemento);
    $("#cidade").val(data.cidade);
    $("#estado").val(data.estado);


}


function  salvarCorretor(url) {
    var chave = 'NOVO'

    if ($('#ukey').val() !== '') {
        chave = $('#ukey').val();
    }

    var nome = $("#nome").val();
    var cpf = $("#cpf").val();
    var email = $("#email").val();
    var telefone = $("#telefone").val();
    var celular = $("#celular").val();
    var cep = $("#cep").val();
    var endereco = $("#endereco").val();
    var complemento = $("#complemento").val();
    var bairro = $("#bairro").val();
    var cidade = $("#cidade").val();
    var estado = $("#estado").val();

    $.post(url, {
        ukey: chave,
        nome: nome,
        cpf: cpf,
        email: email,
        telefone: telefone,
        celular: celular,
        cep: cep,
        endereco: endereco,
        complemento: complemento,
        bairro: bairro,
        cidade: cidade,
        estado: estado

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
var botoes_habilitar = ['#btn_painel_editar', "#btn_painel_inativar"]
controlaCheckbox('.esp_chk', botoes_habilitar);