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
            <?php foreach ($lista_grupo_corretor as $grupo_corretor) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="check[]" itemid="000" class="esp_chk" id="<?= $grupo_corretor["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $grupo_corretor["codigo"] ?></td>
                    <td><?= $grupo_corretor["nome"] ?></td>
                    <td><?= $grupo_corretor["descricao"] ?></td>
                    <td style="text-align: center">
                        <?php
                            if ($grupo_corretor["status"] === '1'){
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

