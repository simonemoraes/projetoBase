
<section id="id_grid_empresa">

    <table class="table table-bordered">
        <thead>
            <tr class="info" >
                <th style="text-align: center"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></th>
                <th style="text-align: center">Codigo</th>
                <th style="text-align: center">Razão Social</th>
                <th style="text-align: center">Responsável</th>
                <th style="text-align: center">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_empresa as $empresa) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="empresa[]" itemid="000" class="esp_chk" id="<?= $empresa["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $empresa["codigo"] ?></td>
                    <td><?= $empresa["razao_social"] ?></td>
                    <td><?= $empresa["responsavel"] ?></td>
                    <td><?= $empresa["email"] ?></td>

                </tr>
            <?php endforeach ?>
        </tbody>  
    </table>

</section>


