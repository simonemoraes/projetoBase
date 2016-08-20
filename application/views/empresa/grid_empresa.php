
<section id="id_grid_empresa">

    <table class="table table-bordered">
        <thead>
            <tr class="info" >
                <th style="text-align: center"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                <th style="text-align: center">Codigo</th>
                <th style="text-align: center">Razão Social</th>
                <th style="text-align: center">Responsável</th>
                <th style="text-align: center">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_empresa as $objempresa) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="check[]" itemid="000" class="esp_chk" id="<?= $objempresa["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $objempresa["codigo"] ?></td>
                    <td><?= $objempresa["razao_social"] ?></td>
                    <td><?= $objempresa["responsavel"] ?></td>
                    <td><?= $objempresa["email"] ?></td>

                </tr>
            <?php endforeach ?>
        </tbody>  
    </table>
        <?php echo $paginacao; ?>
</section>


