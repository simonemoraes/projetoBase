<?php if (!$this->session->userdata("usuario_logado")) : ?>
    <?php $this->load->view('includes/cabecalho_sem_menu.php') ?>
<?php endif ?>

<!--        tiver usuario logado-->
<?php if ($this->session->userdata("usuario_logado")) : ?>
    <?php $this->load->view('includes/cabecalho.php') ?>
<?php endif ?>

<section id="id_sectionRdefinirSenha">

    <div class="container">

        <div class="row">
            <div style="top: 40px;" class="col-md-offset-3 col-md-6">
                <form class="form-horizontal" id="form_login" method="post" action="#">

                    <div class="panel panel-info">
                        <div class="panel-heading">

                            <img style="margin-left: 90px;" src="<?= base_url("images/cadeado.png") ?>">

                            <div style="float: right; margin-top: 20px; margin-right: 80px; font-family: 'Droid Sans', sans-serif;">
                                <h1 style="color: #999;"><strong>Alterar Senha</strong></h1>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group-lg" id="box_senha">
                                <div>
                                    <label for="senhaatual" class="sr-only">Senha atual</label>
                                </div>
                                <div>
                                    <input type="password" placeholder="Senha Atual" class="form-control estilizaInput" id="senhaatual" name="senhaatual">
                                </div>
                            </div>
                            <div class="form-group-lg" id="box_senha">
                                <div>
                                    <label for="novasenha" class="sr-only">Nova Senha</label>
                                </div>
                                <div>
                                    <input type="password" disabled="" placeholder="Nova Senha" class="form-control estilizaInput" id="novasenha" name="novasenha">
                                </div>
                            </div>
                            <div class="form-group-lg" id="box_senha">
                                <div>
                                    <label for="confirmenovasenha" class="sr-only">Confirme Nova Senha</label>
                                </div>
                                <div>
                                    <input type="password" disabled="" placeholder="Confirme Nova Senha" class="form-control estilizaInput" id="confirmenovasenha" name="confirmenovasenha">
                                </div>
                            </div>

                            <div class="form-group-lg divBtnAlterarSenha" id="div_btn_alterarSenha">

                                <input type="submit" disabled="" id="btn_alterarSenha" name="button" class="btn btn-primary btn-lg" value="Alterar" required="autofocus">

                            </div>

                        </div>
                    </div>
            </div>

            </form>

        </div>
    </div>

</div>
</div>


<?php $this->load->view('includes/rodape.php') ?>

