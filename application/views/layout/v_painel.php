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
                        <button <?php echo $painel['estado_btn_novo']; ?>  id="btn_painel_novo" data-target="#exampleModal"  class="btn btn-default btn-lg botaoFerramenta" title="Novo" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>

                        <button itemid="<?php echo $painel['endereco_btn_editar']; ?>" <?php echo $painel['estado_btn_editar']; ?> id="btn_painel_editar" class="btn btn-default btn-lg botaoFerramenta" title="Editar" aria-label="Left Align">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>

                        <button <?php echo $painel['estado_btn_excluir']; ?> id="btn_painel_excluir" class="btn btn-default btn-lg botaoFerramenta" title="Excluir" aria-label="Left Align">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>

                        <button <?php echo $painel['estado_btn_visualizar']; ?> id="btn_painel_visualizar" class="btn btn-default btn-lg botaoFerramenta" title="Visualizar" aria-label="Left Align">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </button>
                        
                         <button itemid="<?php echo $painel['endereco_btn_ativar']; ?>" <?php echo $painel['estado_btn_inativar']; ?> id="btn_painel_inativar" class="btn btn-default btn-lg botaoFerramenta" title="Ativar / Inativar" aria-label="Left Align">
                            <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
                        </button>
                        
                         <button <?php echo $painel['estado_btn_maps']; ?> id="btn_painel_maps" class="btn btn-default btn-lg botaoFerramenta" title="Google Maps" aria-label="Left Align">
                            <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                        </button>

                    </div>


                    <div class="col-md-2">
                        <select class="form-control" id="id_formGroup">
                            <?php echo $painel['opcoes']; ?> 
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
                
                <div id="div_error_validacao">
                    
                </div>

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
                        <button style="float: left" id="btn_painel_limpar" type="button" class="btn btn-warning">Limpar
                            <span style="margin-left: 15px;" class="glyphicon glyphicon-erase" aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a id="btn_painel_fechar" href="<?php echo $modal['fechar'] ?>" type="button" class="btn btn-default" data-dismiss="modal">Fechar
                            <span style="margin-left: 15px;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </a>

                        <button id="btn_modal_salvar" itemid="<?php echo $modal['acao'] ?>" class="btn btn-primary"><?php echo $modal['btn_cadastrar']; ?>
                            <span style="margin-left: 15px;" class="glyphicon glyphicon-floppy-save " aria-hidden="true"></span>
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- /.Janela Modal Generica  -->

<?php $this->load->view('includes/rodape.php') ?>

