<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css") ?>">
        <link rel="stylesheet" href="<?= base_url("css/estilo.css") ?>">

    </head>

    <body>

        <header id="id_header"></header>

        <nav class="navbar navbar-default" role="navigation" id="navPrincipal">
            <div class="container-fluid" id="id_containerFluid">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#id_navbarCollapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a href="<?= base_url("/") ?>" class="navbar-brand ">[ Nome do site ]</a>
                </div>

                <div class="collapse navbar-collapse" id="id_navbarCollapse">

                    <ul class="nav navbar-nav" id="id_ulNavbar">
                        
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <?php foreach ($menus as $menu) : ?>
                            <li><a href="<?= base_url("index.php/".$menu['descricao']) ?>"><?= $menu['descricao'] ?></a></li>
                        <?php endforeach ?>
                        <li><a href="<?= base_url() ?>">Sobre</a></li>
                        <li><a href="<?= base_url() ?>">Contato</a></li>                       
                    </ul>
                </div>

            </div>
        </nav>

