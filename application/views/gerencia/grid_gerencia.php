<section id="id_grid_seguradora">

    <table class="table table-bordered">
        <thead>
            <tr class="info" >
                <th style="text-align: center"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                <th style="text-align: center">Gerente</th>
                <th style="text-align: center">Equipe</th>
                <th style="text-align: center">Data de Inicio</th>
                <th style="text-align: center">Data de desligamento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_gerencia as $gerencia) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="check[]" itemid="000" class="esp_chk" id="<?= $gerencia["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $gerencia["gerente"] ?></td>
                    <td><?= $gerencia["equipe"] ?></td>
                    <td><?= $this->obj_gen->dataMysqlParaPtBr($gerencia["data_inicio"]) ?></td>
                    <td><?= ($gerencia["data_fim"] !== "0000-00-00") ? $this->obj_gen->dataMysqlParaPtBr($gerencia["data_fim"]) : "" ?></td>
                   
                </tr>
            <?php endforeach ?>
        </tbody>  
    </table>

</section>

