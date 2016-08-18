<form id="<?php echo $id_form ?>" onsubmit="return false;">
    
     <input type="hidden" class="form-control" id="ukey" name="ukey">

    <div class="form-group">
        <label for="nome" class="control-label">Nome</label>
        <input itemid="Nome do usuário" type="text" class="verificar form-control" id="nome" name="nome">
    </div>
    
     <div class="form-group">
        <label for="cpf" class="control-label">CPF</label>
        <input itemid="CPF " type="text" class="verificar form-control" id="cpf" name="cpf">
    </div>

    <div class="form-group">
        <label for="login" class="control-label">Login</label>
        <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  itemid="Login" url="<?php echo base_url('usuario/verificarlogin') ?>" type="email" class="verificar form-control" id="login" name="login">
    </div>
    
     <div class="form-group" id="box_senha">
        <label for="senha" class="control-label">Senha</label>
        <input itemid="Senha" type="password" class="verificar form-control" id="senha" name="senha">
    </div>

    <div class="form-group" id="box_confirma_senha">
        <label for="confirmar_senha" class="control-label">Confirmar Senha</label>
        <input itemid="Confirmação de senha" type="password" class="verificar form-control" id="confirmar_senha" name="confirmar_senha">
    </div>
     
   
</form>
