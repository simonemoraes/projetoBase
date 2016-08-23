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
            <?php foreach ($lista_equipe as $equipe) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="check[]" itemid="000" class="esp_chk" id="<?= $equipe["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $equipe["codigo"] ?></td>
                    <td><?= $equipe["nome"] ?></td>
                    <td><?= $equipe["descricao"] ?></td>
                    <td style="text-align: center">
                        <?php
                            if ($equipe["status"] === '1'){
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

