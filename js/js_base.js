$(document).ready(function () {

   



});

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


function habilitaBotoes() {
    $("#btn_painel_editar").removeAttr('disabled');
    $("#btn_painel_excluir").removeAttr('disabled');
    $("#btn_painel_visualizar").removeAttr('disabled');
    $("#btn_painel_inativar").removeAttr('disabled');
    $("#btn_painel_maps").removeAttr('disabled');

}

function desabilitaBotoes() {
    $("#btn_painel_editar").attr('disabled', "disabled");
    $("#btn_painel_excluir").attr('disabled', "disabled");
    $("#btn_painel_visualizar").attr('disabled', "disabled");
     $("#btn_painel_inativar").attr('disabled',"disabled");
    $("#btn_painel_maps").attr('disabled',"disabled");

}

// Função que chama a janela modal
function abrirCadastro() {

    $("#modal_cadastro").modal({
        backdrop: false,
        keyboard: true
    }).modal('show');

}


 function controlaCheckbox(classe) {

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
                habilitaBotoes();
            }


        });


    }
    // fim da função
