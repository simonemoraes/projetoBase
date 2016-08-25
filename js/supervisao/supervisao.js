$(document).ready(function () {

    // Esse evento faz a abertura do formulario de cadastro
    $("#btn_painel_novo").click(function () {
        abrirCadastro();

    });

    // Esse enevento faz uma chamada para função assincrona para gravar usuario 
    $("#btn_modal_salvar").click(function () {
        if (valida()) {
            var url = $(this).attr("itemid");
            salvarSupervisao(url);
        }

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

        var ukey_supervisao = $("input[type=checkbox][name = 'check[]']:checked").attr("id");
        var url = $(this).attr("itemid");


        // chamando AJAX assincrono para fazer a busca para preencher a tela de edição
        // Retorno do callback json
        $.post(url, {
            ukey: ukey_supervisao
        },
                function (data, status) {

                    if (status === "success") {

                        // metodo que preenche o objeto da tela com json retornado.
                        preencherObjetoSuprvisao(data);

                        abrirCadastro();

                    } else {
                        $("#msg_error").show();
                    }



                }, 'json');

    });




});

function  preencherObjetoSuprvisao(data) {
    
    $("#ukey").val(data.ukey);
    $("#select_supervisor").attr('disabled', "disabled");
    $("#select_equipe").attr('disabled', "disabled");
    $("#select_supervisor option").html(data.nome_supervisor).attr('disabled', "disabled");
    $("#select_equipe option").html(data.nome_equipe).attr('disabled', "disabled");
    $("#data_inicio").val(data.data_inicio).attr('disabled', "disabled");
    $("#data_fim").val(data.data_fim);
    
    if(data.data_fim === "0000-00-00"){
        $("#exampleModalLabel").html("Deligamento de Supervisão");
    }else{
        $("#exampleModalLabel").html("Supervisão já está desligada");
        $("#data_fim").attr('disabled', "disabled");
    }
   

}


function  salvarSupervisao(url) {
    var chave = 'NOVO'

    if ($('#ukey').val() !== '') {
        chave = $('#ukey').val();
    }

    var supervisor = $("#select_supervisor option:selected").val();
    var equipe = $("#select_equipe option:selected").val();
    var data_inicio = $("#data_inicio").val();
    var data_fim = $("#data_fim").val();
    
    if(chave !== "NOVO" && data_inicio > data_fim){
       
        $("#msg_error").html("Data de desligamento não pode ser anterior a entrada!");
        $("#msg_error").show();
        return false;
    }
        


    $.post(url, {
        ukey: chave,
        supervisor_ukey: supervisor,
        equipe_ukey: equipe,
        data_inicio: data_inicio,
        data_fim: data_fim


    },
            function (data, status) {

                $("#msg_sucesso").hide();
                $("#msg_error").hide();
                               
                if (data === "sucesso") {
                    $("#msg_sucesso").html("Supervisor deligado com sucesso!");
                    $("#msg_sucesso").show();
                    
                    if(chave !== "NOVO"){
                         $("#data_fim").attr('disabled', "disabled");
                    }
                    
                } else {

                    if (data === "existe") {
                        $("#msg_error").html("Supervisor já está associado a essa equipe na data informada e não pode ser associado novamente!");
                        $("#msg_error").show();

                    } else {
                        $("#msg_error").show();
                    }


                }

            });
}

function limparForm() {
    var id_form = $("form").attr("id");
    limparFormularios(id_form);
}

// Essa função trata a seleção unica dos checkbox da tela
// Essa fução está no JS_base.
var botoes_habilitar = ['#btn_painel_editar']
controlaCheckbox('.esp_chk', botoes_habilitar);