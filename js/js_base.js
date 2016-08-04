$(document).ready(function () {

   



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
