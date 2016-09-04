$(document).ready(function () {

    // Esse evento faz a abertura do formulario de cadastro
    $("#btn_painel_novo").click(function () {
        abrirCadastro();

    });


    $('#tbl_grade_comissionamento_empresa').delegate('a', 'click', function () {

        $('#vitalicio').val("");
        $('#percentual_vt').val("");
        $('#percentual_vt').attr('disabled', "disabled");
        $('#parcela').val("");
        $('#percentual').val("");
        $('#percentual').attr('disabled', "disabled");
        $(this).closest('tr').remove();
    });

    $('#tbl_grade_comissionamento_empresa').delegate('tr', 'click', function () {

      
        $(this).find('td').each(function (i) {

            switch (i) {
                case 0:
                    if ($(this).html() > 0) {

                        $('#parcela').val($(this).html());
                         $('#vitalicio').val("");
                        $('#parcela').removeAttr('disabled');
                        $('#percentual_vt').attr('disabled', "disabled");

                    }
                    break;


                case 1:
                    if ($(this).html() > 0) {
                        $('#percentual').val($(this).html());
                        $('#percentual_vt').val("");
                        $('#percentual').removeAttr('disabled');

                    }
                    break;



                case 2:
                    if ($(this).html() > 0) {
                        $('#select_colaborador').val($(this).html());

                    }
                    break;


                case 3:
                    if ($(this).html() > 0) {
                        $('#vitalicio').val($(this).html());
                         $('#parcela').val("");
                        $('#vitalicio').removeAttr('disabled');
                        $('#percentual').attr('disabled', "disabled");

                    }
                    break;

                case 4:

                    if ($(this).html() > 0) {
                        $('#percentual_vt').val($(this).html());
                         $('#percentual').val("");
                        $('#percentual_vt').removeAttr('disabled');

                    }
                    break;

            }


        });
    });




    $('#btn_adicionar_grade').click(function () {

        // pegando informações digitadas 
        var parcela = $('#parcela').val();
        var percentual_parc = $('#percentual').val();
        var colaborador = $("#select_colaborador option:selected").val();
        var vitalicio = $('#vitalicio').val();
        var parcela_vt = $('#percentual_vt').val();
        var validou = true;
        var mensagem = "";
        var html = "";

        $("#msg").html(mensagem);

        if (verificaVitalicioMenor(vitalicio)) {

            $("#msg").html("Vitalicio não pode ser menor ou igual a parcela existente!");
            return false;
        }

        validou = verificaVitalicio();

        // prograga começa aqui depois das validações
        if (validou) {

            if (verificaParcelaExitente(parcela, vitalicio)) {

                html = "<tr class = 'grade_parcelas'>";
                html = html + "<td style='text-align: center'>" + parcela + "</td>";
                html = html + "<td style='text-align: center'>" + percentual_parc + "</td>";
                html = html + " <td style='text-align: center'>" + colaborador + "</td>";
                html = html + " <td style='text-align: center'>" + vitalicio + "</td>";
                html = html + " <td style='text-align: center'>" + parcela_vt + "</td>";
                html = html + " <td style='text-align: center'>" + "<a href='#' class='label label-danger btn_remover_esp'>Remover</a>" + "</td>";
                html = html + "</tr>";

                $("#corpo_tabela_grade").append(html);

            } else {
                $("#msg").html("Essa parcela já existe e não pode ser preenchida novamente!");
            }




        } else {
            $("#msg").html("Vitalicio já foi informado e não é possivel inserir mais nenhuma parcela!");
        }


    });

    $('#percentual').blur(function () {
        if ($(this).val() > 0) {
            $('#btn_adicionar_grade').removeAttr("disabled");
        } else {
            $('#btn_adicionar_grade').attr('disabled', "disabled");
        }
    });


    $('#percentual_vt').blur(function () {
        if ($(this).val() > 0) {
            $('#btn_adicionar_grade').removeAttr("disabled");
        } else {
            $('#btn_adicionar_grade').attr('disabled', "disabled");
        }
    });


    // evento disparado na saida do campo parcela
    $('#parcela').blur(function () {

        if ($('#parcela').val() > 0 && $('#parcela').val() !== "") {
            $('#vitalicio').attr('disabled', "disabled");
            $('#percentual_vt').attr('disabled', "disabled");
            $('#percentual').removeAttr('disabled');
        } else {
            $('#vitalicio').val("");
            $('#vitalicio').removeAttr('disabled');
            $('#percentual').val("");
            $('#percentual').attr('disabled', "disabled");
            $('#btn_adicionar_grade').attr('disabled', "disabled");
        }

    });

    // evento disparado na saida do campo vitalicio
    $('#vitalicio').blur(function () {

        if ($('#vitalicio').val() > 0 && $('#vitalicio').val() !== "") {
            $('#parcela').attr('disabled', "disabled");
            $('#percentual_vt').removeAttr('disabled');
            $('#percentual').attr('disabled', "disabled");

        } else {
            $('#percentual_vt').val("");
            $('#percentual_vt').attr('disabled', "disabled");
            $('#percentual').val("");
            $('#parcela').removeAttr('disabled');
            $('#btn_adicionar_grade').attr('disabled', "disabled");
        }

    });

    // Esse enevento faz uma chamada para função assincrona para gravar usuario 
    $("#btn_modal_salvar").click(function () {
        var url = $(this).attr("itemid");

        var obj = new Object();

        var lista_de_parcelas = [];

        obj.ukey_grade = $("#select_grade option:selected").val();
        obj.ukey_condicao = $("#select_condicao option:selected").val();
        obj.ukey_seguradora = $("#select_seguradora option:selected").val();
        obj.ukey_produto = $("#select_produto option:selected").val();
        obj.inicio_vigencia = $('#inicio_vigencia').val();
        obj.fim_vigencia = $('#fim_vigencia').val();

        // pegando a tr do body e percorrendo 
        $('#tbl_grade_comissionamento_empresa tbody').find('tr').each(function (i) {

            var parcela = new Object();

            $(this).find('td').each(function (i) {

                switch (i) {
                    case 0:
                        parcela.parcela = $(this).html();
                        break;

                    case 1:
                        parcela.percentual = $(this).html();
                        break;


                    case 2:
                        parcela.colaborador = $(this).html();
                        break;

                    case 3:
                        parcela.vitalicio = $(this).html();

                        break;

                    case 4:
                        parcela.percentual_vt = $(this).html();

                        break;
                }

            });

            lista_de_parcelas.push(parcela);

        });


        obj.parcelas = lista_de_parcelas;

        var jsonObjs = JSON.stringify(obj);

        salvarGradeComissaoEmpresa(url, jsonObjs);


    });


    function verificaVitalicio() {

        var retorno = true;

        // pegando a tr do body e percorrendo 
        $('#tbl_grade_comissionamento_empresa tbody').find('tr').each(function (i) {

            $(this).find('td').each(function (i) {

                if (i === 3) {

                    if ($(this).html() > 0) {
                        retorno = false;
                    }

                }



            });


        });

        return retorno;
    }

    function verificaVitalicioMenor(vitalicio) {

        var retorno = false;

        // pegando a tr do body e percorrendo 
        $('#tbl_grade_comissionamento_empresa tbody').find('tr').each(function (i) {

            $(this).find('td').each(function (i) {

                if (i === 0 && vitalicio > 0) {

                    if ($(this).html() >= vitalicio) {
                        retorno = true;
                    }

                }

            });


        });

        return retorno;
    }

    function verificaParcelaExitente(parcela, parcela_vt) {

        var retorno = true;

        // pegando a tr do body e percorrendo 
        $('#tbl_grade_comissionamento_empresa tbody').find('tr').each(function (i) {

            $(this).find('td').each(function (i) {

                if ((parcela > 0 && parcela === $(this).html()) || (parcela_vt > 0 && parcela_vt === $(this).html())) {

                    retorno = false;

                }

            });


        });

        return retorno;
    }

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

        var ukey_grade = $("input[type=checkbox][name = 'check[]']:checked").attr("id");
        var url = $(this).attr("itemid");


        // chamando AJAX assincrono para fazer a busca para preencher a tela de edição
        // Retorno do callback json
        $.post(url, {
            ukey: ukey_grade,
        },
                function (data, status) {

                    if (status === "success") {

                        // metodo que preenche o objeto da tela com json retornado.
                        preencherObjetoGrupo(data);

                        abrirCadastro();

                    } else {
                        $("#msg_error").show();
                    }



                }, 'json');

    });




});

function  preencherObjetoGrupo(data) {
    $("#ukey").val(data.ukey);
    $("#nome").val(data.nome);
    $("#descricao").val(data.descricao);


}


function  salvarGradeComissaoEmpresa(url, objetoJson) {
    var chave = 'NOVO'

    if ($('#ukey').val() !== '') {
        chave = $('#ukey').val();
    }

   
    $.post(url, {
        ukey: chave,
        objeto: objetoJson
       

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