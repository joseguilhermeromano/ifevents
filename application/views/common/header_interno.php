<!DOCTYPE html>
<html>
    <head>
        <title>Parte Interna do Site...</title>
        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url ('assets_interno/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('assets_interno/css/simple-sidebar.css');?>" rel="stylesheet">
        <script>
            function aparece(ahhhh){
                if(document.getElementById(ahhhh).style.display== "none"){
                    document.getElementById(ahhhh).style.display = "block";
                }
                else {
                    document.getElementById(ahhhh).style.display = "none"
                }
            }
	</script>  
        
       
    </head>
    <body>
 <div id="wrapper">

        <!-- Menu Participante -->
        <?php 
            $paginacorrente=$this->uri->segment(2); //Codigo php para identificar a pagina corrente e setar item de menu ativo
            $usuario=$this->uri->segment(1);
            if ($usuario=="participante"){
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
                    <a href="<?php echo base_url("InicioControl");?>"><span class="glyphicon glyphicon-log-out"></span>  SAIR</a>
                </li>
            </ul>
            </div><!-- /#borda -->
        </div><!-- /#sidebar-wrapper -->
        
        <?php 
            }else if ($usuario=="organizador"){
        ?>
        <!-- Menu Organizador -->
        
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
                    <a href="<?php echo base_url("organizador/index");?>"><span class="glyphicon glyphicon-home"></span>  INÍCIO</a>
                </li>
                <li class="<?php if($paginacorrente == 'meuperfil') {echo 'active';} ?>">
                    <a href="<?php echo base_url("organizador/meuperfil");?>"><span class="glyphicon glyphicon-user"></span>  MEU PERFIL</a>
                </li>
                <li class="<?php if($paginacorrente == 'submissoes') {echo 'active';} ?>">
                    <a href="<?php echo base_url("organizador/submissoes");?>"><span class="glyphicon glyphicon-list"></span>  SUBMISSÕES</a>
                </li>
                <li class="<?php if($paginacorrente == 'conferencias') {echo 'active';} ?>">
                    <a href="<?php echo base_url("organizador/conferencias");?>"><span class="glyphicon glyphicon-list"></span>  CONFERÊNCIAS</a>
                </li>
                <li class="">
                    <a href="<?php echo base_url("InicioControl");?>"><span class="glyphicon glyphicon-log-out"></span>  SAIR</a>
                </li>
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
                
                <li class="sidebar-brand">
                    <a href="#">
                        SEMCITEC
                        <br>
                    </a>
                </li>
                <li class="<?php if($paginacorrente == 'index' || empty($paginacorrente)) {echo 'active';} ?>">
                    <a href="<?php echo base_url("avaliador/index");?>"><span class="glyphicon glyphicon-home"></span>  INÍCIO</a>
                </li>
                <li class="<?php if($paginacorrente == 'submissoes') {echo 'active';} ?>">
                    <a href="<?php echo base_url("avaliador/submissoes");?>"><span class="glyphicon glyphicon-list"></span>  SUBMISSÕES ATIVAS</a>
                </li>
                <li class="<?php if($paginacorrente == 'contato') {echo 'active';} ?>">
                    <a href="<?php echo base_url("avaliador/contato");?>"><span class="glyphicon glyphicon-envelope"></span>  CONTATO</a>
                </li>
                <li class="">
                    <a href="<?php echo base_url("InicioControl");?>"><span class="glyphicon glyphicon-log-out"></span>  SAIR</a>
                </li>
            </ul>
            </div><!-- /#borda -->
        </div><!-- /#sidebar-wrapper -->
        
        
        
        <?php
            }//fim else if $usuário == "avaliador"
            
        ?>
        
        <div id="page-content-wrapper"><!-- Page Content -->
            <div class="container-fluid"><!-- Container-fluid -->
                <div class="row"><!-- row -->
                <a href="#menu-toggle" id="menu-toggle"><!-- Botão de exibir/ocultar menu lateral -->
                            <span class="glyphicon glyphicon-remove hidden-xs"></span>
                            <span class="glyphicon glyphicon-menu-hamburger hidden-lg hidden-md hidden-sm"></span>
                            </a><!-- /#Botão de exibir/ocultar menu lateral -->
                    <div class="col-lg-12"><!-- col-lg-12 -->

                        
