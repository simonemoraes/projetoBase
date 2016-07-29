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
                        <a href="script:;"  id="modalteste" data-target="#exampleModal" onclick="<?= $funcao_especifica['btn_novo'] ?>" class="btn btn-default btn-lg botaoFerramenta" title="Novo" aria-label="Left Align">
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
<div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>
<!-- /.Janela Modal Generica  -->

<?php $this->load->view('includes/rodape.php') ?>

