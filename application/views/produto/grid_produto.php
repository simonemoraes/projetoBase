<section id="id_grid_seguradora">

    <table class="table table-bordered">
        <thead>
            <tr class="info" >
                <th style="text-align: center"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                <th style="text-align: center">Codigo</th>
                <th style="text-align: center">Nome</th>
                <th style="text-align: center">Descrição</th>
                <th style="text-align: center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_produto as $produto) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="check[]" itemid="000" class="esp_chk" id="<?= $produto["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $produto["codigo"] ?></td>
                    <td><?= $produto["nome"] ?></td>
                    <td><?= $produto["descricao"] ?></td>
                    <td style="text-align: center">
                        <?php
                            if ($produto["status"] === '1'){
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

