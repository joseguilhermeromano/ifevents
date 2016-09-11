<!DOCTYPE html>
<html>
    <head>
        <title>Parte Interna do Site...</title>
        <meta charset="UTF-8">
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url ('assets_interno/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('assets_interno/css/simple-sidebar.css');?>" rel="stylesheet">
        
        <!-- assetststrap Core JavaScript -->
        <script src="<?php echo base_url('assets_interno/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets_interno/js/jquery.min.js');?>"></script>
        
    <script>
    $( document ).ready(function() {
        $('.sidebar-nav li').click(function() {
            $(this).closest('.sidebar-nav').find('li').removeClass('active');
            $(this).addClass('active');
        });
    });
    </script>
        
    </head>
    <body>
 <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                
                <li class="active">
                    <a href="#"><span class="glyphicon glyphicon-home"></span>  INÍCIO</a>
                </li>
                <li>
                    <a href="#"><span class="glyphicon glyphicon-user"></span>  MEU PERFIL</a>
                </li>
                <li>
                    <a href="#"><span class="glyphicon glyphicon-open-file"></span>  NOVO ARTIGO</a>
                </li>
                <li>
                    <a href="#"><span class="glyphicon glyphicon-list"></span>  MEUS ARTIGOS</a>
                </li>
                <li>
                    <a href="#"><span class="glyphicon glyphicon-envelope"></span>  CONTATO</a>
                </li>
                <li>
                    <a href="#"><span class="glyphicon glyphicon-log-out"></span>  SAIR</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Simple Sidebar</h1>
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                        <br><br>
                        <div id="capa">
                        Esta camada é independiente e vou adicionar e eliminar classes css sobre ela
                        </div>
                        <br><br>
                        <a href="#">Adicionar e tirar classe na camada de cima</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        
       
    








   
        
    

