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

    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
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
                </div><!--/.nav-collapse -->
            </div>
        </nav>



        <section id="id_sectionBodyPainel">

            <div class="container">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Controle do Menu</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="exampleInputName2">Titulo do site</label>
                                <input type="text" class="form-control" id="titulo_site" value="<?= $titulo_site ?>">
                            </div>

                            <button type="submit" class="btn btn-warning">Alterar</button>
                        </form>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>Menu</th>
                                    <th>Link</th>
                                    <th>Ação</th>
                                </tr>
                                <?php foreach ($menu as $objmenu) : ?>
                                    <tr id="<?= "menu_" . $objmenu['id'] ?>">
                                        <td><?= $objmenu['descricao'] ?></td>
                                        <td><?= $objmenu['link'] ?></td>

                                        <td>
                                            <a id="btn<?= $objmenu["id"] ?>" itemid= "<?= base_url("painel_control/ativar/" . $objmenu["id"]) ?>"  
                                               class="scp_btn btn <?= $objmenu["status"] == 0 ? "btn-primary" : "btn-success" ?>" role="button">
                                                <?= $objmenu["status"] == 0 ? "Ativar" : "Desativar" ?>
                                            </a>

                                        </td>


                                    </tr>
                                <?php endforeach ?>


                            </table>
                        </div>
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