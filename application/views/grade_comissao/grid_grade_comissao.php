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
            <?php foreach ($lista_grade_comissao as $grade_comissao) : ?>
                <tr>
                    <td style="text-align: center">
                        <input name="check[]" itemid="000" class="esp_chk" id="<?= $grade_comissao["ukey"] ?>" type="checkbox" value="">
                    </td>
                    <td><?= $grade_comissao["codigo"] ?></td>
                    <td><?= $grade_comissao["nome"] ?></td>
                    <td><?= $grade_comissao["descricao"] ?></td>
                    <td style="text-align: center">
                        <?php
                            if ($grade_comissao["status"] === '1'){
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

