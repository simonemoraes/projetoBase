<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <link rel="icon" href="../../favicon.ico"/>

        <title>SGS - Sistema Gestor de Seguros</title>

        <link rel="stylesheet" href="<?= base_url("css/estilo_painel.css") ?>" media="all"/>
        <link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css") ?>"/>
        <link rel="stylesheet" href="<?= base_url("css/font_awesome/css/font-awesome.min.css") ?>"/>

    </head>

    <body>


        <!-- Inicio - Navbar -->
        <nav style="" class="navbar navbar-inverse" id="navBar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SGS</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= base_url() ?>"><i class="fa fa-home" aria-hidden="true"></i> &nbsp;Inicio</a></li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-folder-open-o" aria-hidden="true"></i> &nbsp;Cadastros<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('empresa') ?>"><i class="fa fa-building" aria-hidden="true"></i> &nbsp;Empresas</a></li>
                                <li><a href="<?= base_url('usuario') ?>"><i class="fa fa-user-plus" aria-hidden="true"></i> &nbsp;Usuarios</a></li>
                                <li><a href="<?= base_url('seguradora') ?>"><i class="fa fa-hospital-o" aria-hidden="true"></i> &nbsp;Seguradoras</a></li>
                                <li><a href="<?= base_url('produto') ?>"><i class="fa fa-medkit" aria-hidden="true"></i> &nbsp;Produtos</a></li>
                                <li><a href="<?= base_url('condicao_comissionamento') ?>"><i class="fa fa-cc" aria-hidden="true"></i> &nbsp;Condições de Comissionamentos</a></li>
                                <li><a href="<?= base_url('grade_comissao') ?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i> &nbsp;Grade de Comissão</a></li>
                                <li><a href="<?= base_url('equipe') ?>"><i class="fa fa-users" aria-hidden="true"></i> &nbsp;Equipes</a></li>
                                <li><a href="<?= base_url('encargo') ?>"><i class="fa fa-credit-card" aria-hidden="true"></i> &nbsp;Encargos</a></li>
                                <li><a href="<?= base_url('corretor') ?>"><i class="fa fa-user-md" aria-hidden="true"></i> &nbsp;Corretores</a></li>
                                <li><a href="<?= base_url('supervisor') ?>"><i class="fa fa-user-secret" aria-hidden="true"></i> &nbsp;Supervisores</a></li>
                                <li><a href="<?= base_url('gerente') ?>"><i class="fa fa-universal-access" aria-hidden="true"></i> &nbsp;Gerentes</a></li>


                            </ul>
                        </li>
                        
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-times" aria-hidden="true"></i> &nbsp;Coordenação<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('supervisao') ?>"><i class="fa fa-key" aria-hidden="true"></i> &nbsp;Supervisão</a></li>
                                <li><a href=""><i class="fa fa-key" aria-hidden="true"></i> &nbsp;Gerência</a></li>
                            </ul>
                        </li>
                        
                        
                        
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cogs" aria-hidden="true"></i> &nbsp;Configurações<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('configuracao') ?>"><i class="fa fa-key" aria-hidden="true"></i> &nbsp;Alterar Senha</a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>


                            </ul>
                        </li>
                        <li><a href="<?= base_url('login/sair') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp;Sair</a></li>
                    </ul>

                    <p class="navbar-text navbar-right">
                        <i class="fa fa-user" aria-hidden="true"></i> 
                        <strong><?php echo $this->session->userdata("usuario_logado")['nome']; ?></strong>
                    </p>
                </div>
            </div>
        </nav>
        <!-- Fim - Navbar -->