<!DOCTYPE html>
<html>
    <head>
        <title>5ª Semana de Ciência e Tecnologia de Guarulhos</title>
        <meta charset="UTF-8">
                
        
        <link href="<?php echo base_url('font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url ('assets/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('assets/css/new.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('assets/css/freelancer.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('assets/css/bootstrap.css');?>" rel="stylesheet">
       

    	<!-- assetststrap Core JavaScript -->
    	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.js');?>"></script>   
        
    	<!-- Plugin JavaScript -->

    	<script src="<?php echo base_url('assets/js/classie.js');?>"></script>
    	<script src="<?php echo base_url('assets/js/cbpAnimatedHeader.js');?>"></script> 

    	<!-- Contact Form JavaScript -->
    	<script src="<?php echo base_url('assets/js/jqBootstrapValidation.js');?>"></script>
    	<script src="<?php echo base_url('assets/js/contact_me.js');?>"></script>

    	<!-- Custom Theme JavaScript -->
    	<script src="<?php echo base_url('assets/js/freelancer.js');?>"></script>

        <img src="<?php echo base_url ('assets/img/favicon.ico');?>" rel="icon" type="image/x-icon">
 
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
        <img src="<?php echo base_url ('assets/img/favicon.ico');?>" rel="icon" type="image/x-icon">       

    </head>
<body>
    <body id="page-top" class="index">
    	
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#so">
                    <span class="sr-only"><a class="navbar-brand" href=""></a></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">SEMCITEC</a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="so">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="/"></a>
                    </li>
                    <?php /*<li class="page-scroll">
                        <a href="/">Histórico</a>
                    </li>*/ ?>
                    <li class="page-scroll">
                        <?php echo anchor('InicioControl/submissao', 'Submissão'); ?>                        
                    </li>
                    <li class="page-scroll">
                        <?php echo anchor('InicioControl/cadastro', 'Cadastro'); ?>                        
                    </li>
                    
                    <li class="page-scroll">
                        <a href="/#page-down">Informações</a>
                    </li>
                    <li class="page-scroll">
                        <?php echo anchor('InicioControl/login', 'Login'); ?>                        
                    </li>
                </ul>
            </div>
        
        </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

 <section class="header">            
            <img class="img-responsive"src="<?php echo base_url('assets/img/semcitec01.jpg');?>" align="center" width="2900px" height="1500px">            
    </section>