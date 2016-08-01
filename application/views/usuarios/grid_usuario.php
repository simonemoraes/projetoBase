<?php $this->load->view('includes/cabecalho.php') ?>

<div class="container">
    <section id="id_grid_usuario">

        <table class="table table-bordered">
            <thead>
                <tr class="info" >
                    <th style="text-align: center"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></th>
                    <th style="text-align: center">Nome</th>
                    <th style="text-align: center">Status</th>

                </tr>
            </thead>
            <tbody>
                <!--?php foreach ($lista_empresa as $empresa) : ?-->
                <tr>
                    <td style="text-align: center">
                        <input name="" itemid="000" class="esp_chk" id="" type="checkbox" value="">
                    </td>
                    <td><!--?= $empresa["codigo"] ?--></td>
                    <td><!--?= $empresa["razao_social"] ?--></td>
                </tr>
                <!--?php endforeach ?-->
            </tbody>  
        </table>

    </section>
</div>

<?php $this->load->view('includes/rodape.php') ?>


