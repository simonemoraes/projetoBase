$(document).ready(function () {

    $(".scp_btn").click(function () {

        var url = $(this).attr("itemid");
        var idBotao = $(this).attr("id");


        $.post(url, function (data, status) {
            if (data == "1") {
                $("#" + idBotao).html("Desativar").removeClass("btn-primary").addClass("btn-success");
            } else {
                $("#" + idBotao).html("Ativar").removeClass("btn-success").addClass("btn-primary");
            }
        });


    })
});
