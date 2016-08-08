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

            <?= $this->session->flashdata("erro") ?>
       
     
            <div style="display: none" id="msg_error" class="alert alert-danger  alert-dismissable" role="alert">
                <p><strong id="texto_msg"></strong></p>
            </div>

            <form class="form-horizontal" id="form_login" method="post" action="login/entrar">
                <div class="row">

                    <h1>Login do sistema</h1>

                    <div class="form-group">
                        <label for="codigo_empresa" class="control-label">Código Empresa</label>
                        <input itemid="<?php echo base_url('/login/buscarempresa') ?>" type="text" class="form-control" id="codigo_empresa" name="codigo_empresa">
                    </div>

                    <div class="form-group">
                        <label for="login" class="control-label">Login</label>
                        <input type="email" disabled="" placeholder="login@email.com.br" class="form-control" id="login" name="login">
                    </div>

                    <div class="form-group" id="box_senha">
                        <label for="senha" class="control-label">Senha</label>
                        <input type="password" disabled="" class="form-control" id="senha" name="senha">
                    </div>

                    <div class="row form-group" id="div_btn_entrar">

                        <input type="submit" disabled="" id="btn_entrar" name="button" class="btn btn-primary" value="Entrar" placeholder="Senha" required="autofocus">

                    </div>

                    <div class="row form-group-lg">
                        <div>
                            <a href="recuperasenha">Esqueci minha senha</a>
                        </div>
                    </div>

                </div>


            </form>
        <?php endif ?>


        <!--        tiver usuario logado-->
        <?php if ($this->session->userdata("usuario_logado")) : ?>
            <h1><?= $this->session->flashdata("sucesso") ?></h1>

            <?php
            echo '<pre>';
            print_r($this->session->userdata("usuario_logado"));
            echo '</pre>';

            echo '<pre>';
            print_r($this->session->userdata("empresa_logada"));
            echo '</pre>';
            
            echo $this->session->userdata("empresa_logada")['razao_social'];
            
            ?>
        <?php endif ?>



    </div>
</section>
<!-- /.container -->


<?php $this->load->view('includes/rodape.php') ?>



