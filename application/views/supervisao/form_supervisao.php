<form id="<?php echo $id_form ?>" onsubmit="return false">

    <input type="hidden" class="form-control" id="ukey" name="ukey">

    <div class="form-group">
        <label for="select_supervisor" class="control-label">Supervisor</label>

        <select class="form-control" id="select_supervisor">
            <?php foreach ($supervisores as $supervisor) : ?>
                <option id="<?php echo $supervisor['ukey']; ?>" name="<?php echo $supervisor['ukey']; ?>" value="<?php echo $supervisor['ukey']; ?>"><?php echo $supervisor['nome']; ?></option> 
            <?php endforeach ?>
        </select>

    </div>

    <div class="form-group">
        <label for="select_equipe" class="control-label">Equipe</label>

        <select class="form-control" id="select_equipe">
            <?php foreach ($equipes as $equipe) : ?>
                <option id="<?php echo $equipe['ukey']; ?>" name="<?php echo $equipe['ukey']; ?>" value="<?php echo $equipe['ukey']; ?>"><?php echo $equipe['nome']; ?></option> 
            <?php endforeach ?>
        </select>

    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="data">Data Inicio</label>
                <input required="" itemid="Data inicial" type="date" class="verificar form-control"  value="" name="data_inicio" id="data_inicio" >
            </div>

            <div class="col-md-6">
                <label for="data">Data Final</label>
                <input required="" type="date" class="form-control"  value="" name="data_fim" id="data_fim" maxlength="255" >
            </div>
        </div>
    </div>





</form>