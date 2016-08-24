<section id="id_grid_seguradora">

    <table class="table table-bordered">
        <thead>
            <tr class="info" >
                <th style="text-align: center"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                <th style="text-align: center">Supervisor</th>
                <th style="text-align: center">Equipe</th>
                <th style="text-align: center">Data de Inicio</th>
                <th style="text-align: center">Data de desligamento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_supervisao as $supervisao) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="check[]" itemid="000" class="esp_chk" id="<?= $supervisao["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $supervisao["supervisor"] ?></td>
                    <td><?= $supervisao["equipe"] ?></td>
                    <td><?= $this->obj_gen->dataMysqlParaPtBr($supervisao["data_inicio"]) ?></td>
                    <td><?= ($supervisao["data_fim"] !== "0000-00-00") ? $this->obj_gen->dataMysqlParaPtBr($supervisao["data_fim"]) : "" ?></td>
                   
                </tr>
            <?php endforeach ?>
        </tbody>  
    </table>

</section>

