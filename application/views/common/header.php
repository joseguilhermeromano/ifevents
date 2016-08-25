<!DOCTYPE html>
<html>
    <head>
        <title>5ª Semana de Ciência e Tecnologia de Guarulhos</title>
        <meta charset="UTF-8">

        <script src="<?php echo base_url('assets/js/jquery.js');?>"></script>    	

    	<!-- assetststrap Core JavaScript -->
    	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

    	<!-- Plugin JavaScript -->
    	<script src="<?php echo site_url('http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js');?>"></script>
    	<script src="<?php echo base_url('assets/js/classie.js');?>"></script>
    	<script src="<?php echo base_url('assets/js/cbpAnimatedHeader.js');?>"></script> 

    	<!-- Contact Form JavaScript -->
    	<script src="<?php echo base_url('assets/js/jqBootstrapValidation.js');?>"></script>
    	<script src="<?php echo base_url('assets/js/contact_me.js');?>"></script>

    	<!-- Custom Theme JavaScript -->
    	<script src="<?php echo base_url('assets/js/freelancer.js');?>"></script>

        <link href="<?php echo base_url ('assets/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('assets/css/new.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('assets/css/freelancer.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('assets/css/bootstrap.css');?>" rel="stylesheet">
        <link href="<?php echo base_url ('http://fonts.googleapis.com/css?family=Montserrat:400,700'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo site_url('http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');?>" rel="stylesheet" type="text/css">
        <!--<link rel="shortcut icon" <?php echo base_url('href="/favicon.ico"');?> type="image/x-icon">-->

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

    </head>
<body>
    <body id="page-top" class="index">
    	
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#so">
                    <span class="sr-only"><a class="navbar-brand" <?php echo anchor('InicioControl', 'SEMCITEC'); ?> </a></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
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
                </ul>
            </div>
        
        </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

