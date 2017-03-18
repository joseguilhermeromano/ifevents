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
        <link href="<?php echo base_url ('assets/area-interna/css/estilo.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('assets/area-interna/css/select2.min.css');?>" rel="stylesheet">
    </head>
    <body>
 <div id="wrapper">
        <?php 

            $usuario = $this->session->userdata('usuario'); 
            $paginacorrente = $this->session->userdata('pagina'); 

            if ($usuario[0]['user_tipo']==0){
        ?>
        <div id="sidebar-wrapper"><!-- sidebar-wrapper -->
            <div class="borda"><!-- borda -->
            <ul class="sidebar-nav">
                <div class="sidebar-brand">
                    <a href="#">
                        <img width="175px" height="50px" src="<?php echo base_url('assets/area-interna/img/logo_ifevents.svg'); ?>" />
                    </a>
                </div>
                <hr>
                <li class="<?php if($paginacorrente == 'index') {echo 'active';} ?>">
                    <a href="<?php echo base_url("usuario/inicioParticipante");?>"><span class="glyphicon glyphicon-home"></span>  INÍCIO</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'meuperfil') {echo 'active';} ?>">
                    <a href="<?php echo base_url("usuario/perfil");?>"><span class="glyphicon glyphicon-user"></span>  MEU PERFIL</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'novoartigo') {echo 'active';} ?>">
                    <a href="<?php echo base_url('artigo/cadastrar');?>"><span class="glyphicon glyphicon-open-file"></span>  NOVO ARTIGO</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'meusartigos') {echo 'active';} ?>">
                    <a href="<?php echo base_url("artigo/consultarTudo");?>"><span class="glyphicon glyphicon-list"></span>  MEUS ARTIGOS</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'contato') {echo 'active';} ?>">
                    <a href="<?php echo base_url("contato/cadastrar");?>"><span class="glyphicon glyphicon-envelope"></span>  CONTATO</a>
                </li>
                <hr>
                <li class="">
                    <a href="<?php echo base_url("login/sair");?>"><span class="glyphicon glyphicon-log-out"></span>  SAIR</a>
                </li>
                <hr>
            </ul>
            </div><!-- /#borda -->
        </div><!-- /#sidebar-wrapper -->
        <?php
            }else if ($usuario[0]['user_tipo']==2){
        ?>
        <!-- Menu Organizador -->
        <div id="sidebar-wrapper"><!-- sidebar-wrapper -->
            <div class="borda"><!-- borda -->
            <ul class="sidebar-nav">
                <div class="sidebar-brand">
                    <a href="#">
                        <img width="175px" height="50px" src="<?php echo base_url('assets/area-interna/img/logo_ifevents.svg'); ?>">
                    </a>
                </div>
                <hr>
                <li class="<?php if($paginacorrente == 'index') {echo 'active';} ?>">
                    <a href="<?php echo base_url("usuario/inicioOrganizador");?>"><span class="glyphicon glyphicon-home"></span>  INÍCIO</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'novo-usuario') {echo 'active';} ?>">
                    <a href="<?php echo base_url("usuario/cadastrar");?>"><span class="glyphicon glyphicon-user"></span>  NOVO USUÁRIO</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'meuperfil') {echo 'active';} ?>">
                    <a href="<?php echo base_url("usuario/perfil");?>"><span class="glyphicon glyphicon-user"></span>  MEU PERFIL</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'listatodassubmissoes') {echo 'active';} ?>">
                    <a href="<?php echo base_url("organizador/listatodassubmissoes");?>"><span class="glyphicon glyphicon-list"></span>  SUBMISSÕES</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'listaconferencia') {echo 'active';} ?>">
                    <a href="<?php echo base_url("organizador/listaconferencia");?>"><span class="glyphicon glyphicon-list"></span>  CONFERÊNCIAS</a>
                </li>
                <hr>
                 <li class="<?php if($paginacorrente == 'novo-comite') {echo 'active';} ?>">
                    <a href="<?php echo base_url("comite/cadastrar");?>"><span class="glyphicon glyphicon-list"></span>  NOVO COMITÊ</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'enviaconvite') {echo 'active';} ?>">
                   <a href="<?php echo base_url("organizador/enviaConvite");?>"><span class="glyphicon glyphicon-list"></span>  CONVITES</a>
               </li>
               <hr>
                <li class="">
                    <a href="<?php echo base_url("login/sair");?>"><span class="glyphicon glyphicon-log-out"></span>  SAIR</a>
                </li>
                <hr>
            </ul>
            </div><!-- /#borda -->
        </div><!-- /#sidebar-wrapper -->
        <?php
            //fim else if $usuário == "organizador"
            }else{
        ?>
        <!-- Menu Avaliador -->
        <div id="sidebar-wrapper"><!-- sidebar-wrapper -->
            <div class="borda"><!-- borda -->
            <ul class="sidebar-nav">
                <div class="sidebar-brand">
                    <a href="#">
                        <img width="175px" height="50px" src="<?php echo base_url('assets/area-interna/img/logo_ifevents.svg'); ?>">
                    </a>
                </div>
                <hr>
                <li class="<?php if($paginacorrente == 'index' || empty($paginacorrente)) {echo 'active';} ?>">
                    <a href="<?php echo base_url("usuario/inicioAvaliador");?>"><span class="glyphicon glyphicon-home"></span>  INÍCIO</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'meuperfil') {echo 'active';} ?>">
                    <a href="<?php echo base_url("usuario/perfil");?>"><span class="glyphicon glyphicon-user"></span>  MEU PERFIL</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'listaartigosativos') {echo 'active';} ?>">
                    <a href="<?php echo base_url("avaliador/listaartigosativos");?>"><span class="glyphicon glyphicon-list"></span>  ARTIGOS ATIVOS</a>
                </li>
                <hr>
                <li class="<?php if($paginacorrente == 'contato') {echo 'active';} ?>">
                    <a href="<?php echo base_url("contato/cadastrar");?>"><span class="glyphicon glyphicon-envelope"></span>  CONTATO</a>
                </li>
                <hr>
                <li class="">
                    <a href="<?php echo base_url("login/sair");?>"><span class="glyphicon glyphicon-log-out"></span>  SAIR</a>
                </li>
                <hr>
            </ul>
            </div><!-- /#borda -->
        </div><!-- /#sidebar-wrapper -->
        <?php
            }//fim else if $usuário == "avaliador"
        ?>
        <div id="page-content-wrapper"><!-- Page Content -->
            <a href="#menu-toggle" id="menu-toggle"><!-- Botão de exibir/ocultar menu lateral -->
                    <span class="glyphicon glyphicon-remove hidden-xs"></span>
                    <span class="glyphicon glyphicon-menu-hamburger hidden-lg hidden-md hidden-sm"></span>
            </a><!-- /#Botão de exibir/ocultar menu lateral -->
            <div class="container-fluid"><!-- Container-fluid -->
                <div class="row"><!-- row -->
                <div class="col-lg-12"><!-- col-lg-12 -->