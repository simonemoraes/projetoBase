<section id="id_grid_usuario">

    <table class="table table-bordered">
        <thead>
            <tr class="info" >
                <th style="text-align: center"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                <th style="text-align: center">Codigo</th>
                <th style="text-align: center">Nome</th>
                <th style="text-align: center">Status</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_supervisor as $supervisor) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="check[]" itemid="000" class="esp_chk" id="<?= $supervisor["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $supervisor["codigo"] ?></td>
                    <td><?= $supervisor["nome"] ?></td>
                    <td style="text-align: center">
                        <?php
                        if ($supervisor["status"] === '1') {
                            echo '<span class="label label-success">Ativo</span>';
                        } else {
                            echo '<span class="label label-danger">Inativo</span>';
                        }
                        ?>
                    </td>


                </tr>
            <?php endforeach ?>
        </tbody>  
    </table>
    
</section>


