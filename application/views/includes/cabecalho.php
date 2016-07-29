<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>SGS - Sistema Gestor de Seguros</title>


        <link rel="stylesheet" href="<?= base_url("css/estilo_painel.css") ?>" media="all">
        <link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css") ?>">



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
                        <li class="active"><a href="<?= base_url() ?>">Inicio</a></li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastro<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('empresa') ?>">Empresas</a></li>
                                <li><a href="#">Seguradora</a></li>
                                <li><a href="#">Corretor</a></li>
                                <li><a href="#">Supervisor</a></li>
                                <li><a href="#">Gerente</a></li>

                            </ul>
                        </li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Fim - Navbar -->