<form id="<?php echo $id_form ?>" onsubmit="return false;">

    <input type="hidden" class="form-control" id="ukey" name="ukey">

    <div class="form-group">
        <label for="nome" class="control-label">Nome</label>
        <input itemid="Nome do supervisor " type="text" class="verificar form-control" id="nome" name="nome">
    </div>

    <div class="form-group">
        <label for="cpf" class="control-label">CPF</label>
        <input itemid="CPF " type="text" class="verificar form-control" id="cpf" name="cpf">
    </div>

    <div class="form-group">
        <label for="e-mail" class="control-label">E-mail</label>
        <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  itemid="e-mail"  type="email" class="verificar form-control" id="email" name="email">
    </div>

    <div class="form-group">
        <label for="telefne" class="control-label">Telefone</label>
        <input itemid="Telefone  " type="text" class="verificar form-control" id="telefone" name="telefone">
    </div>

    <div class="form-group">
        <label for="celular" class="control-label">Celular</label>
        <input itemid="Celular  " type="text" class="verificar form-control" id="celular" name="celular">
    </div>

    <div class="form-group">
        <label for="cep" class="control-label">CEP</label>
        <p style="display: none;" id="valida_cep" class="label label-danger"></p>
        <input itemid="CEP   " type="text" class="verificar form-control" id="cep" name="cep">
    </div>

    <div class="form-group">
        <label for="endereco" class="control-label">Endereço</label>
        <input itemid="Endereço " disabled="" type="text" class="verificar form-control" id="endereco" name="endereco">
    </div>

    <div class="form-group">
        <label for="complemento" class="control-label">Complemento</label>
        <input itemid="complemento " disabled="" type="text" class="form-control" id="complemento" name="complemento">
    </div>

    <div class="form-group">
        <label for="bairro" class="control-label">Bairro</label>
        <input itemid="Bairro " disabled="" type="text" class="verificar form-control" id="bairro" name="bairro">
    </div>

    <div class="form-group">
        <label for="cidade" class="control-label">Cidade</label>
        <input itemid="Cidade " disabled="" type="text" class="verificar form-control" id="cidade" name="cidade">
    </div>

    <div class="form-group">
        <label for="estado" class="control-label">Estado</label>
        <input itemid="Estado " disabled="" type="text" class="verificar form-control" id="estado" name="estado">
    </div>



</form>
