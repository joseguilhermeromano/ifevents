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
    </head>
    <body>
 <div id="wrapper">

        <!-- Sidebar -->
        <?php 
            $paginacorrente=$this->uri->segment(2); //Codigo php para identificar a pagina corrente e setar item de menu ativo
        ?>
        <div id="sidebar-wrapper"><!-- sidebar-wrapper -->
            <div class="borda"><!-- borda -->
            <ul class="sidebar-nav">
                
                <li class="sidebar-brand">
                    <a href="#">
                        SEMCITEC
                        <br>
                    </a>
                </li>
                <li class="<?php if($paginacorrente == 'index' || empty($paginacorrente)) {echo 'active';} ?>">
                    <a href="<?php echo base_url("participante/index");?>"><span class="glyphicon glyphicon-home"></span>  INÍCIO</a>
                </li>
                <li class="<?php if($paginacorrente == 'meuperfil') {echo 'active';} ?>">
                    <a href="<?php echo base_url("participante/meuperfil");?>"><span class="glyphicon glyphicon-user"></span>  MEU PERFIL</a>
                </li>
                <li class="<?php if($paginacorrente == 'novoartigo') {echo 'active';} ?>">
                    <a href="<?php echo base_url("participante/novoartigo");?>"><span class="glyphicon glyphicon-open-file"></span>  NOVO ARTIGO</a>
                </li>
                <li class="<?php if($paginacorrente == 'meusartigos') {echo 'active';} ?>">
                    <a href="<?php echo base_url("participante/meusartigos");?>"><span class="glyphicon glyphicon-list"></span>  MEUS ARTIGOS</a>
                </li>
                <li class="<?php if($paginacorrente == 'contato') {echo 'active';} ?>">
                    <a href="<?php echo base_url("participante/contato");?>"><span class="glyphicon glyphicon-envelope"></span>  CONTATO</a>
                </li>
                <li class="">
                    <a href="#"><span class="glyphicon glyphicon-log-out"></span>  SAIR</a>
                </li>
            </ul>
            </div><!-- /#borda -->
        </div><!-- /#sidebar-wrapper -->
        
        <div id="page-content-wrapper"><!-- Page Content -->
            <div class="container-fluid"><!-- Container-fluid -->
                <div class="row"><!-- row -->
                    <div class="col-lg-12"><!-- col-lg-12 -->

                        <a href="#menu-toggle" id="menu-toggle"><!-- Botão de exibir/ocultar menu lateral -->
                            <span class="glyphicon glyphicon-remove hidden-xs"></span>
                            <span class="glyphicon glyphicon-menu-hamburger hidden-lg hidden-md hidden-sm"></span>
                        </a><!-- /#Botão de exibir/ocultar menu lateral -->