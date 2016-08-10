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
                                <h1 style="color: #999;"><strong>Redefinir Senha</strong></h1>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <div class="form-group-lg">
                                    <div>
                                        <label for="codigo_empresa" class="sr-only">Código Empresa</label>
                                    </div>
                                    <div>
                                        <input itemid="<!--?php echo base_url('') ?-->" type="text" class="form-control estilizaInput" id="codigo_empresa" name="codigo_empresa" placeholder="Código da Empresa">
                                    </div>
                                </div>
                                
                                <div class="form-group-lg">
                                    <div>
                                        <label for="cpf" class="sr-only">Cpf</label>
                                    </div>
                                    <div>
                                        <input type="text" disabled="" placeholder="Cpf" class="form-control estilizaInput" id="cpf" name="cpf">
                                    </div>
                                </div>

                                <div class="form-group-lg">
                                    <div>
                                        <label for="login" class="sr-only">Login</label>
                                    </div>
                                    <div>
                                        <input type="email" disabled="" placeholder="login@email.com.br" class="form-control estilizaInput" id="login" name="login">
                                    </div>
                                </div>

                                <div class="form-group-lg divBtnRedefinir" id="div_btn_redefinir">

                                    <input type="submit" disabled="" id="btn_redefinir" name="button" class="btn btn-primary btn-lg" value="Redefinir" required="autofocus">

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