<!-- footer -->
  <div class="footer">
    <div class="container">
      <div class="col-md-5 w3agile_footer_grid">
        <h3>Sobre</h3>
        <p>O IFEVENTS é uma plataforma interativa de eventos, criado especialmente
            para atender as necessidades do IFSP - Câmpus Guarulhos!</p>
            <br><p>Seja bem vindo e aproveite ao máximo os eventos da instituição!</p>
          <br>
          <a href="#">
            <div class="footer-logo"></div>
          </a>
      </div>
      <div class="col-md-2 w3agile_footer_grid">  
        <h3>Links</h3>
       <ul>
          <li><a href="<?php echo base_url('index'); ?>">Início</a></li>
          <li><a href="<?php echo base_url('sobre'); ?>">Sobre</a></li>
          <li><a href="<?php echo base_url('inicio/cadastrar/participante'); ?>">Cadastro</a></li>
          <li><a href="<?php echo base_url('contato'); ?>">Contato</a></li>
          <li><a href="<?php echo base_url('login'); ?>">Login</a></li>
        </ul>
      </div>
      <div class="col-md-5 w3agile_footer_grid">
        <h3>Contato</h3>
        <p> <span class="glyphicon glyphicon-home"></span> &nbsp;&nbsp;Av. Salgado Filho, 3501 - Centro, 
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guarulhos - SP, 07115-000</p>
        <br>
        <p> <span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp;example@ifsp.edu.gov.br</p>
        <br>
        <p> <span class="glyphicon glyphicon-phone-alt"></span> &nbsp;&nbsp;(11) 2304-4250</p>
          <br>
          <a href="#">
            <div class="footer-logo-if"></div>
          </a>
        <div class="clearfix"> </div>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
  <div class="agileinfo_copy_right">
    <div class="container">
      <div class="agileinfo_copy_right_left">
        <p>© 2017 IFEVENTS. Todos os direitos reservados. Desenvolvido por <a href="<?= base_url('sobre'); ?>">equipe.</a></p>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
<!-- //footer -->

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<a class="btn btn-danger" id="back-to-top">
  <i class="glyphicon glyphicon-menu-up"></i>
</a>

<script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>



<script src="<?php echo base_url('assets/area-externa/js/jquery.min.js');?>"></script> 
<script src="<?php echo base_url('assets/area-externa/js/jquery.easing.min.js'); ?>"></script>   
<script src="<?php echo base_url('assets/area-externa/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/area-externa/js/classie.js'); ?>"></script>
<script src="<?php echo base_url('assets/area-externa/js/cbpAnimatedHeader.js'); ?>"></script> 
<script src="<?php echo base_url('assets/area-externa/js/slideanim.js'); ?>"></script> 
<script src="<?php echo base_url('assets/area-externa/js/efeitos.js'); ?>"></script>
<script src="<?php echo base_url('assets/ambas-areas/js/jquery.maskedinput.js');?>"></script>
<script src="<?php echo base_url('assets/ambas-areas/js/jquery-ui.js');?>"></script>
<script src="<?php echo base_url('assets/ambas-areas/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/ambas-areas/js/select2.min.js');?>"></script>
<script src="<?php echo base_url('assets/ambas-areas/js/funcoes-jquery-ajax.js');?>"></script>

</body>
</html>