$(document).ready(function () {


    $('#codigo_empresa').blur(function () {

        var texto_digitado = $(this).val();
        var url = $(this).attr("itemid");


        if (texto_digitado !== "") {

            $.post(url, {
                codigo: texto_digitado,
            },
                    function (data, status) {

                        if (data !== "") {
                            // Esse trecho é processado quando existe uma empresa correspondente ao codigo digitado.
                            $("#login").removeAttr("disabled");
                            $("#senha").removeAttr("disabled");
                            $("#btn_entrar").removeAttr("disabled");
                            $("#msg_error").hide();

                           

                        } else {
                            
                            // Esse trecho é chamado quando o usuario preenche o codigo da empresa e não é correspondente a uma empresa cadastrada.
                            
                            $('#texto_msg').html("Codigo informado não corresponde a um Empresa cadastrada... tente novamente!");
                            $("#msg_error").show();
                            $("#login").attr("disabled", "");
                            $("#senha").attr("disabled", "");
                            $("#btn_entrar").attr("disabled", "");
                        }



                    });


        } else {
            // Esse trecho é chamado quando o usuario não preenche o codigo da empresa.
            $("#login").attr("disabled", "");
            $("#senha").attr("disabled", "");
            $("#btn_entrar").attr("disabled", "");
            
            $('#texto_msg').html("Codigo não pode ser vazio!");
            $("#msg_error").show();

        }



    });


});

