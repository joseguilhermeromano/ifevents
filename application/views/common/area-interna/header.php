<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Bootstrap Core CSS -->
         <link href="<?php echo base_url ('assets/area-interna/css/bootstrap.min.css');?>" rel="stylesheet">
<!--         <link href="<?php echo base_url('assets/area-externa/css/bootstrappaper.css'); ?>" rel="stylesheet" type="text/css" media="all" /> -->
        <link href="<?php echo base_url ('assets/area-interna/css/estilo.css');?>" rel="stylesheet">
        <!-- font awesome --> 
        <link href="<?php echo base_url ('assets/ambas-areas/css/font-awesome.min.css');?>" rel="stylesheet">
        <!-- plugin select 2 -->
        <link href="<?php echo base_url ('assets/ambas-areas/css/select2.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('assets/area-interna/css/jquery-ui.css');?>" rel="stylesheet">
        <!-- plugin niceEdit --> 
        <script src="<?php echo base_url ('assets/area-interna/nicedit/nicEdit-latest.js');?>"></script>
        <!--plugin bootstrap-input-file --> 
        <link href="<?php 
         echo base_url ('assets/area-interna/css/bootstrap-file-input-fileinput.css');?>" rel="stylesheet">
            <script type="text/javascript">
              //<![CDATA[
                bkLib.onDomLoaded(function() {
                      new nicEditor().panelInstance('editor');
                 });
                //]]>
            </script>
        <script type="text/javascript">
            var baseUrl = "<?php echo base_url(''); ?>";
        </script>
    </head>
    <body>
 <div id="wrapper">
        <div id="sidebar-wrapper"><!-- sidebar-wrapper -->
             <div class="borda"><!-- borda -->
                <a href="javascript:void(0)" href="#close-toggle" id="close-toggle" onclick="closeNav()">
                    <span class="glyphicon">&times;</span>
                </a>
            <ul class="sidebar-nav" id="sidenav">
                <div class="sidebar-brand">
                    <a href="#">
                        <img width="175px" height="50px" src="<?php echo base_url('assets/area-interna/img/logo_ifevents.svg'); ?>" />
                    </a>
                </div>
                <?php
                    $tipoUsuario = $this->session->userdata('usuario')->user_tipo;
                    switch($tipoUsuario){
                        case 3: 
                            include('links-organizador.php');
                        break;
                        case 2: 
                            include('links-revisor.php');
                        break;
                        default:
                            include('links-participante.php');
                        break;
                    }

                ?>

            </ul>
            </div><!-- /#borda -->
        </div><!-- /#sidebar-wrapper -->

        <div id="page-content-wrapper">
        <!-- Use any element to open the sidenav -->
        <a href="#menu-toggle" id="menu-toggle">
            <span onclick="openNav()" class="glyphicon glyphicon-menu-hamburger"></span>
        </a>

        <!-- Page Content -->
<!--             <a href="#menu-toggle" id="menu-toggle"><!-- Botão de exibir/ocultar menu lateral -->
                    <!--<span class="glyphicon glyphicon-remove hidden-xs"></span>
                    <span class="glyphicon glyphicon-menu-hamburger hidden-lg hidden-md hidden-sm"></span>
            </a><!-- /#Botão de exibir/ocultar menu lateral -->
            <div class="container-fluid"><!-- Container-fluid -->
                <div class="row"><!-- row -->
                <div class="col-lg-12"><!-- col-lg-12 -->