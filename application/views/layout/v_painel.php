<?php $this->load->view('includes/cabecalho.php') ?>


<section id="id_sectionBodyPainel">

    <div class="container">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title" id="id_panel_h3_VPanel"><?= $painel['titulo'] ?></h3>
            </div>

            <div id="id_divFerramenta">

                <div class="row">
                    <div class="col-md-6">
                        <a href="script:;"  id="btn_painel_novo" data-target="#exampleModal"  class="btn btn-default btn-lg botaoFerramenta" title="Novo" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </a>

                        <a href="script:;" onclick="<?= $funcao_especifica['btn_editar'] ?>" class="btn btn-default btn-lg botaoFerramenta" title="Editar" aria-label="Left Align">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>

                        <a href="script:;" onclick="<?= $funcao_especifica['btn_excluir'] ?>" class="btn btn-default btn-lg botaoFerramenta" title="Excluir" aria-label="Left Align">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>

                        <a href="script:;" onclick="<?= $funcao_especifica['btn_excluir'] ?>" class="btn btn-default btn-lg botaoFerramenta" title="Visualizar" aria-label="Left Align">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>

                    </div>

                    <div class="col-md-2">
                        <select class="form-control" id="id_formGroup">
                            <option>Selecione...</option>
                            <option name="codigo" value="codigo">Código</option>
                            <option name="descricao" value="descricao">Descrição</option>
                            <option name="email" value="email">Email</option>
                        </select>
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

<!-- Janela Modal Generica -->
<div  class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a id="btn_modal_fechar" href="<?php echo $modal['fechar'] ?>" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                <h4 class="modal-title" id="exampleModalLabel"><?php echo $modal['titulo_modal']; ?></h4>
            </div>

            <div class="modal-body">

                <div style="display: none" id="msg_error" class="alert alert-danger  alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p><strong>Erro ao gravar registro... tente novamente</strong></p>
                </div>

                <div style="display: none" id="msg_sucesso" class="alert alert-success alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p><strong>Registro salvo com sucesso</h2></strong></p>
                </div>
                <?php echo $modal['formulario']; ?>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button style="float: left" id="btn_painel_limpar" type="button" class="btn btn-warning" >Limpar</button>
                    </div>
                    <div class="col-md-6">
                        <a id="btn_painel_fechar" href="<?php echo $modal['fechar'] ?>" type="button" class="btn btn-default" data-dismiss="modal">Fechar</a>
                        <button  id="btn_modal_salvar" itemid="<?php echo $modal['acao'] ?>" class="btn btn-primary"><?php echo $modal['btn_cadastrar']; ?></button>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- /.Janela Modal Generica  -->

<?php $this->load->view('includes/rodape.php') ?>

