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
    
    
    // Essa função trata a seleção unica dos checkbox da tela
    // Essa fução está no JS_base.
    controlaCheckbox('.esp_chk');
    
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
    
      // Esse enevento faz uma chamada para função assincrona para abrir a edição da empresa
    $("#btn_painel_editar").click(function () {
        
        var ukey_usuario = $("input[type=checkbox][name = 'usuario[]']:checked").attr("id");
        var url = $(this).attr("itemid");
        
        alert(ukey_usuario);
        
        alert(url);
        
        // chamando AJAX assincrono para fazer a busca para preencher a tela de edição
        // Retorno do callback json
        $.post(url, {
            ukey: ukey_usuario,
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

   


});

function  limpaCampos(){
    alert("Informar os campos do form a serem apagados");
}

function  salvarEmpresa(url){
    alert(url);
}