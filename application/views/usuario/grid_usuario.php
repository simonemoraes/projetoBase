
<section id="id_grid_usuario">

    <table class="table table-bordered">
        <thead>
            <tr class="info" >
                <th style="text-align: center"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></th>
                <th style="text-align: center">Codigo</th>
                <th style="text-align: center">Nome</th>
                <th style="text-align: center">Status</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_usuario as $usuario) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="usuario[]" itemid="000" class="esp_chk" id="<?= $usuario["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $usuario["ukey"] ?></td>
                    <td><?= $usuario["nome"] ?></td>
                    <td><?= $usuario["status"] ?></td>


                </tr>
            <?php endforeach ?>
        </tbody>  
    </table>

</section>


