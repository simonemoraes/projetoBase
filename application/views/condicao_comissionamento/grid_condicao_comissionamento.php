<section id="id_grid_seguradora">

    <table class="table table-bordered">
        <thead>
            <tr class="info" >
                <th style="text-align: center"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                <th style="text-align: center">Codigo</th>
                <th style="text-align: center">Condição</th>
                <th style="text-align: center">Descrição</th>
                <th style="text-align: center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_condicao_comissionamento as $objcondicao) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="check[]" itemid="000" class="esp_chk" id="<?= $objcondicao["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $objcondicao["codigo"] ?></td>
                    <td><?= $objcondicao["nome"] ?></td>
                    <td><?= $objcondicao["descricao"] ?></td>
                    <td style="text-align: center">
                        <?php
                            if ($objcondicao["status"] === '1'){
                                echo '<span class="label label-success">Ativo</span>';
                            }else{
                                echo '<span class="label label-danger">Inativo</span>';
                            }
                            
                        ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>  
    </table>

</section>

