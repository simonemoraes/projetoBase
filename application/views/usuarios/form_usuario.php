<?php $this->load->view('includes/cabecalho.php') ?>
<div class="container">
    <form id="form_modal" onsubmit="return false">

        <div class="form-group">
            <label for="nome" class="control-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>

        <div class="form-group">
            <label for="login" class="control-label">Login</label>
            <input type="email" class="form-control" id="login" name="login">
        </div>

        <div class="form-group">
            <label for="senha" class="control-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha">
        </div>

        <div class="form-group">
            <label for="confirmar_senha" class="control-label">Confirmar Senha</label>
            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha">
        </div>
    </form>
    
    <div class="row">
            <div class="col-md-6">
                <button id="btn_painel_limpar" type="button" class="btn btn-warning">Limpar
                    <span style="margin-left: 15px;" class="glyphicon glyphicon-erase" aria-hidden="true"></span>
                </button> 
            </div>

            <div class="col-md-6">
                <a id="btn_painel_fechar" href="#" type="button" class="btn btn-default " data-dismiss="modal">Fechar
                    <span style="margin-left: 15px;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>

                <button id="btn_modal_salvar" itemid="" class="btn btn-primary">Salvar
                    <span style="margin-left: 15px;" class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                </button>
            </div>
        </div>


</div>

<?php $this->load->view('includes/rodape.php') ?>

