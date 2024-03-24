<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Administracion</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URL.RQ; ?>css/system/menu.css" />
    <link rel="stylesheet" href="<?php echo URL.RQ; ?>css/system/graficos.css">
    <link rel="stylesheet" href="<?php echo URL.RQ; ?>css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL.RQ; ?>css/bootstrap-datepicker.css">
</head>
<style>
    #sidebarToggle #icon {
        transition: all 0.4s ease 0s;
    }
</style>

<body class="sb-nav-fixed">
    <?php
    $user = Session::getSession("nombre");
    if (null != $user) {
    ?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-darkr">
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i style="font-size: x-large;" class="fas fa-bars" id="icon"></i></button>
            <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0"></ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" style="background:maroon" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                                <div class="sb-nav-link-icon">
                                    <img style='width:35px; height:35px; object-fit: cover;' class=' rounded-circle' src="<?php echo URL . RQ ?>images/default.png">
                                </div>

                                <?php echo $user["nombre"] ?>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseUser" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="javascript:void(0);" onclick="logout('<?php echo URL ?>')">Salir</a>
                                </nav>
                            </div>
                            <hr style="margin: 0rem 0; color: inherit;border: 0; border-top: 1px solid; opacity: 0.25;">

                            <a class="nav-link" href="<?php echo URL ?>Main">
                                <div class="sb-nav-link-icon"><i class="fa fa-home" aria-hidden="true"></i></div>
                                Inicio
                            </a>


                            <a class="nav-link" href="<?php echo URL ?>User">
                                <div class="sb-nav-link-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                Usuarios
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        OLD SPICE
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <?php } ?>