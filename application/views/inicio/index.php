<!DOCTYPE html>
<html>
    <head>
        <title>5ª Semana de Ciência e Tecnologia de Guarulhos</title>
        
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
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">SEMCITEC</a>
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

    <!-- Header -->
     <!-- Header -->
    <section class="header">            
            <img class="img-responsive"src="<?php echo base_url('assets/img/semcitec01.jpg');?>" align="center" width="2900px" height="1500px">            
    </section>


<section id="apresentacao">
    <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2> Apresentação</h2>
                    <hr class="star-primary">

                    <p>SEMCITEC é a Semana da Ciência Tecnologia Inovação e Desenvolvimento de Guarulhos, que celebra a ciência e a inovação, com o objetivo de incentivar alunos do ensino superior a buscar, através da ciência e tecnologia, soluções para os problemas do cotidiano, além de dar acesso à população ao conhecimento produzido no município. </p>

                    <p>Realizada desde 2012, recebe inscrição de trabalhos na modelidade de pesquisa científica e relato de experiência, segundo eixos temáticos específicos para cada edição. </p>

                    <p>Os trabalhos aceitos são apresentados em sessões de pôster e comunicação oral, abertas ao público.</p>

                    <p>Durante o período de sua realização, sempre em outubro, a SEMCITEC oferece gratuitamente à população palestras e oficinas com base na temática geral do evento, além de variada programação cultural.</p>

            </div>
        </div>
    </div>
</section>

<section id="datasImportantes" class="tod">
    <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 onclick= "aparece('datas');">+ Datas Importantes</h2>
                    <hr class="star-primary">
                    <div id="datas" style="display: none;">
                        <p> Até 30/8/2016   –   Inscrições para Submissão de Trabalhos</p>
                        <p> Até 30/9/2016   –  Publicação dos trabalhos aceitos</p>
                        <p> 17 a 21/10/2016   –     Realização da Semana</p>
                        <p> 18, 19, 21/10/2016  –  Sessões de pôster e comunicação oral</p>
                        <p> 21/10/2016  –  Encerramento e Cerimônia de premiação</p>
                    </div>

            </div>
        </div>
    </div>
</section>

<section id="coordenacao" class="tod">
    <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 onclick= "aparece('coord');">+ Quem Faz</h2>
                    <hr class="star-primary">
                    <div id="coord" style="display: none;">
                        <b>Coordenação Geral</b>
                        <p>Dra. Marinilzes Moradillo Mello
                            <br> Prefeitura de Guarulhos - PMG</p>

                        <b>Coordenação Acadêmica</b>
                        <p>Dra. Marinilzes Moradillo Mello
                        <br>Me. Maria de Jesus Ribeiro, PMG
                        <br>Profa. Dra. Cláudia Fonseca Rosès, IFSP – Campus Guarulhos
                        <br>Prof. Me. Robson Ferreira Lopes, IFSP – Campus Guarulhos</p>

                        <b>Equipe Responsável - Prefeitura de Guarulhos</b>
                        <p>Ademilson Cerqueira de Jesus
                        <br>Ailton Diller
                        <br>Alex Garcia Smith Angelo
                        <br>Ana Regina de Almeida
                        <br>Celso Massom
                        <br>Cilene de Oliveira
                        <br>Daniel Ribeiro Alves
                        <br>Erdnilza Santos Barretos
                        <br>Fernanda Milat
                        <br>Fernando de Oliveira Vieira
                        <br>José Luis de Jesus
                        <br>Leandro Gramulha
                        <br>Lilian Oliveira de Nascimento
                        <br>Luiza Ghidini
                        <br>Marli Neves Santos
                        <br>Merilin Vieira de Oliveira Alencar
                        <br>Milton Alves da Silva
                        <br>Rodrigo Luiz Afonso
                        <br>Sandra Sória
                        <br>Solange Marcia Araújo da Silva</p>

                        <b>Equipe Responsável pela Sala Temática – Prefeitura de Guarulhos</b>
                        <p>Ademir Luiz Alves Gabriel
                        <br>Aline Pires
                        <br>Antonio Perondi
                        <br>Carlos Artur Salgado
                        <br>Celi Pereira
                        <br>Mariana Parussolu
                        <br>Arq. Me. Marli Araújo (Coordenação)
                        <br>Miriam Petri
                        <br>Raul Campos Nascimento
                        <br>Robson Grizilli
                        <br>Sandra Carvalho</p>
                    </div>
            </div>
        </div>
    </div>
</section>

<section id="instituicoes" class="tod">
    <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 onclick= "aparece('inst');">+ Instituições Acadêmicas Parceiras</h2>
                    <hr class="star-primary">
                    <div id="inst" style="display: none;">
                        <b>Anhanguera</b>
                        <p>Prof. Carlos Alberto Abrantes
                        <br>Prof. Dr. Alex Candiago</p>

                        <b>Faculdade eniac</b>
                        <p>Prof. Me. Ruy Guérios</p>

                        <b>Fatec Guarulhos</b>
                        <p>Profa. Dra. Celia Pizzolato
                        <br>Prof. Dr. Marcos Antonio Maia de Oliveira</p>

                        <b>Fig-Unimesp</b>
                        <p>Prof. Ary Badini
                        <br>Prof. Dr. Eduardo Gimenez</p>

                        <b>IFSP-Campus Guarulhos</b>
                        <p>Profa. Dra. Cláudia Fonseca Rosès
                        <br>Prof. Me. Joel Saade
                        <br>Prof. Me. Robson Lopes Ferreira
                        <br>Douglas Andrade
                        <br>Jairo Filho Souza de Almeida
                        <br>Jessica Cristina Cáceres Gonzalez
                        <br>Juliana Brazelino Simões
                        <br>Sergio Andrade Silva Leal</p>

                        <b>Unifesp</b>
                        <p>Prof. Dr. Daniel Arias Vazquez
                        <br>Profa. Dra. Marineide de Oliveira Gomes</p>

                        <b>Universidade Guarulhos - UNG</b>
                        <p>Prof. Dr. Jânio Janguié Bezerra Diniz<br>
                        Profa. Lis Lakei Bertan</p>
                    </div>
            </div>
        </div>
    </div>
</section>

<section id="apoio" class="tod">
    <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 onclick= "aparece('ap');">+ Apoio</h2>
                    <hr class="star-primary">
                    <b id="ap" style="display: none;"> CNPq/MCTI</b>
            </div>
        </div>
    </div>
</section>

<footer class="text-center" id="page-down">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3 class="cor">Realização</h3>
                        <img src="<?php echo base_url('assets/img/prefeitura.png');?>" alt="Prefeitura" height="80">
                        <img src="<?php echo base_url('assets/img/if.png');?>" alt="Instituto Federal" height="80">                        
                    </div>
                    <div class="footer-col col-md-4">
                    <h3 class="cor">Contato</h3>
                    <p class="color">E-mail:</P>
                    <p class="branco">semciteccoordenacao@gmail.com</p>
                    </div>
                    <!-- Redes Sociais -->
                    <!--
                    <div class="footer-col col-md-4">
                        <h3>Redes Sociais</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                    -->
                    
                    <div class="footer-col col-md-4">
                        <h3 class="cor">Endereço</h3>
                        <p class="branco">Avenida Monteiro Lobato, 734.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                    <p class="branco">
                       equipe &copy; semcitec v
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>


    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="<?php echo base_url('assets/js/jquery/localization/jquery.js');?>"></script>

    <!-- assetststrap Core JavaScript -->
    <script src="js/assetststrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script> 

    <!-- Contact Form JavaScript -->
    <script src="js/jqassetststrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>
</body>
