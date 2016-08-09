<?php if (!$this->session->userdata("usuario_logado")) : ?>
    <?php $this->load->view('includes/cabecalho_sem_menu.php') ?>
<?php endif ?>

<!--        tiver usuario logado-->
<?php if ($this->session->userdata("usuario_logado")) : ?>
    <?php $this->load->view('includes/cabecalho.php') ?>
<?php endif ?>


<section id="id_sectionBodyPainel">

    <div class="container">

        <!--        quando não tiver usuario logado-->
        <?php if (!$this->session->userdata("usuario_logado")) : ?>


            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <?php if ($this->session->flashdata("erro")) : ?>
                        <p class="alert alert-danger" id="msg_flashdata_login_erro">
                            <strong><?= $this->session->flashdata("erro") ?></strong>
                        </p>
                    <?php endif ?>

                    <div style="display: none" id="msg_error" class="alert alert-danger  alert-dismissable" role="alert">
                        <p><strong id="texto_msg"></strong></p>
                    </div>
                </div>

            </div>

            <div class="row">
                <div style="top: 40px;" class="col-md-offset-3 col-md-6">
                    <form class="form-horizontal" id="form_login" method="post" action="login/entrar">

                        <div class="panel panel-info">
                            <div class="panel-heading">

                                <img style="margin-left: 90px;" src="<?= base_url("images/cadeado.png") ?>">

                                <div style="float: right; margin-top: 20px; margin-right: 80px; font-family: 'Droid Sans', sans-serif;">
                                    <h1 style="color: #999;"><strong>Login do sistema</strong></h1>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="container-fluid">
                                    <div class="form-group-lg">
                                        <div>
                                            <label for="codigo_empresa" class="sr-only">Código Empresa</label>
                                        </div>
                                        <div>
                                            <input itemid="<?php echo base_url('/login/buscarempresa') ?>" type="text" class="form-control estilizaInputLogin" id="codigo_empresa" name="codigo_empresa" placeholder="Código da Empresa">
                                        </div>
                                    </div>

                                    <div class="form-group-lg">
                                        <div>
                                            <label for="login" class="sr-only">Login</label>
                                        </div>
                                        <div>
                                            <input type="email" disabled="" placeholder="login@email.com.br" class="form-control estilizaInputLogin" id="login" name="login">
                                        </div>
                                    </div>

                                    <div class="form-group-lg" id="box_senha">
                                        <div>
                                            <label for="senha" class="sr-only">Senha</label>
                                        </div>
                                        <div>
                                            <input type="password" disabled="" placeholder="Senha" class="form-control estilizaInputLogin" id="senha" name="senha">
                                        </div>
                                    </div>

                                    <div class="form-group-lg divBtnEntrar" id="div_btn_entrar">

                                        <input type="submit" disabled="" id="btn_entrar" name="button" class="btn btn-primary btn-lg" value="Entrar" placeholder="Senha" required="autofocus">

                                    </div>

                                    <div class="form-group-lg divBtnEntrar">
                                        <div>
                                            <a href="recuperasenha">Esqueci minha senha</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        <?php endif ?>


        <!--        tiver usuario logado-->
        <?php if ($this->session->userdata("usuario_logado")) : ?>
            <?= $this->session->flashdata("sucesso") ?>
            <div id="testando"></div>
        <?php endif ?>




    </div>
</section>
<!-- /.container -->


<?php $this->load->view('includes/rodape.php') ?>



