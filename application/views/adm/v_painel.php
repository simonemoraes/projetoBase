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

        <title>Painel de controle</title>


        <link rel="stylesheet" href="<?= base_url("css/estilo_painel.css") ?>">
        <link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css") ?>">

        <style>
            #id_panel_h3_VPanel {
                text-align: center;
                font-size: 22px;
            }

            .botaoFerramenta {
                /*                margin-right: -4px;*/
                /*                border-radius: 0px;*/
            }


            .input-group-lg>.form-control, .input-group-lg>.input-group-btn>.btn {
                /*                border-radius: 0;*/
            }

        </style>


    </head>

    <body>

        <!-- Inicio - Navbar -->
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Painel de controle</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Designer<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('painel_menu') ?>">Menu</a></li>

                            </ul>
                        </li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Fim - Navbar -->


        <section id="id_sectionBodyPainel">

            <div class="container">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" id="id_panel_h3_VPanel">Controle do Menu</h3>
                    </div>

                    <div style="border-bottom: 1px solid #337ab7; background-color: #EEEEEE; padding: 5px;">

                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-default btn-lg botaoFerramenta" title="Novo" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>

                                <button type="button" class="btn btn-default btn-lg botaoFerramenta" title="Editar" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </button>

                                <button type="button" class="btn btn-default btn-lg botaoFerramenta" title="Excluir" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>

                                <button type="button" class="btn btn-default btn-lg botaoFerramenta" title="Visualizar" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                </button>

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

                    </div>
                </div>

            </div>
        </section>
        <!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->


        <script src="<?= base_url("js/jquery-1.11.3.min.js") ?>"></script>
        <script src="<?= base_url("js/bootstrap.min.js") ?>"></script>
        <script src="<?= base_url("js/js_painel.js") ?>"></script>
    </body>
</html>