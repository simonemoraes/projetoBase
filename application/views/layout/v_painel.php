<?php $this->load->view('includes/cabecalho.php') ?>


<section id="id_sectionBodyPainel">

    <div class="container">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title" id="id_panel_h3_VPanel"><?=$painel['titulo'] ?></h3>
            </div>

            <div style="border-bottom: 1px solid #337ab7; background-color: #EEEEEE; padding: 5px;">

                <div class="row">
                    <div class="col-md-6">
                        <a href="script:;" class="btn btn-default btn-lg botaoFerramenta" title="Novo" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </a>

                        <a href="script:;" class="btn btn-default btn-lg botaoFerramenta" title="Editar" aria-label="Left Align">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>

                        <a href="script:;" class="btn btn-default btn-lg botaoFerramenta" title="Excluir" aria-label="Left Align">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>

                        <a href="script:;" class="btn btn-default btn-lg botaoFerramenta" title="Visualizar" aria-label="Left Align">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>

                    </div>

                    <div class="col-md-2">
                        <div class="dropdown ">
                            <button class="btn btn-default dropdown-toggle btn-lg" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Selecione
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Código</a></li>
                                <li><a href="#">Descrição</a></li>
                                <li><a href="#">Email</a></li>

                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-lg" style= "margin-right: 4px;">
                            <input type="text" class="form-control" aria-label="" placeholder="Buscar">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default btn-lg botaoFerramenta" title="Excluir" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="panel-body">

                <?php echo $conteudo; ?>
            </div>
        </div>

    </div>
</section>
<!-- /.container -->

<?php $this->load->view('includes/rodape.php') ?>