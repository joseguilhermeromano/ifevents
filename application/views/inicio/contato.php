<div id="inicio">
  <div class="inicio-header">
    <div class="banner">
      <img class="img-responsive banner-image" src="<?php echo base_url("assets/area-externa/img/banner-contato.jpg"); ?>" width="100%">
    </div>
    <div class="display-middle margin-top">
      <h4>IFEVENTS</h4>
      <h1>CONTATE-NOS</h1>
      <hr>
        <!-- arrow bounce --> 
        <div class="agileits-arrow bounce animated"><a href="#contato" class="scroll"><i class="glyphicon glyphicon-menu-down" aria-hidden="true"></i></a></div>
        <!-- //arrow bounce -->
    </div>
  </div>
</div>

<!-- contato -->
	<div class="mail section" id="contato">
		<div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="estilo-h1">Contato</h1><br><br>
                            
                            <?php 
                                $this->load->helper('html');
                                echo alert($this->session);
                            ?>
                            <div class="col-md-4 wthree_contact_left">
                                    <h4>Localização</h4>
                                    <p>Todos os eventos são organizados pelo IFSP - Câmpus Guarulhos que se encontra na
                                            <span>Av. Salgado Filho, 3501 - Centro,Guarulhos - SP, 07115-000</span></p>
                                    <ul>
                                            <li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Telefone fixo: (11) 2304-4250</li>
                                            <li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:coordenacao@ifsp.edu.br">coordenacao@ifsp.edu.br</a></li>
                                    </ul>
                            </div>
                            <div class="col-md-8 wthree_contact_left">
                                <h4>Formulário de Contato</h4>
                                <form action="<?= base_url('inicio/contato'); ?>" method="post">
                                        <div class="col-md-6 wthree_contact_left_grid">
                                            <input type="text" name="nome" placeholder="Nome*" value="<?= isset($contato) ? $contato->getNome() : ''?>">
                                        </div>
                                        <div class="col-md-6 wthree_contact_left_grid">
                                            <input type="email" name="email" placeholder="E-mail" value="<?= isset($contato) ? $contato->getEmail() : ''?>">
                                        </div>
                                        <div class="col-md-12 wthree_contact_left_grid">
                                            <input type="text" name="assunto" placeholder="Assunto*" value="<?= isset($contato) ? $contato->getAssunto() : ''?>">
                                        </div>
                                        <textarea  name="mensagem" placeholder="Mensagem..."><?= isset($contato) ? $contato->getMensagem() : ''?></textarea>
                                        <input type="submit" value="Enviar">
                                        <input type="reset" value="Limpar">
                                </form>
                            </div>
                            <div class="clearfix"> </div>
                            <br><br>
                            <div class="row wthree_contact_left">
                                <h4>Como nos encontrar...</h4>
                                <div class="w3ls_map">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3078.1802283888346!2d-46.539470668152596!3d-23.439035182535957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cef51fbe5f8681%3A0x1f8cf929993dc97!2sInstituto+Federal+de+Educa%C3%A7%C3%A3o%2C+Ci%C3%AAncia+e+Tecnologia+de+S%C3%A3o+Paulo%2C+Campus+Guarulhos!5e0!3m2!1spt-BR!2sbr!4v1510279787654" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                            
                        </div>
                    </div>
		</div>
	</div>
<!-- //contato -->
