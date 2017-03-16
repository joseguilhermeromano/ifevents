<!-- Container (Login Section) -->
<div id="login" >
  <div class="inicio-header">
    <div class="banner">
      <img class="img-responsive banner-image" src="<?php echo base_url("assets/area-externa/img/fundo_login.jpg"); ?>" width="100%">
    </div>
    <div class="display-middle margin-top">
    <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-8 col-md-6">
                  <div class="boxshadow">
                    <?php echo form_open('');?>

                    
                    <div class="row">
                          <div class="col-md-10 col-md-offset-1">
                            <h1 style="font-size: 30px" class="estilo-h1">Recuperando senha...</h1>
                            <br><br>
                            <p style="font-size: 12px">Por favor, para que seja possível redefinir a sua senha, informe o seu e-mail!
                              Uma mensagem será enviada para o seu e-mail com o link e o passo a passo para redefinição de senha!
                            </p>
                                <?php   if ($this->session->flashdata('error')) { ?>
                                    <br>
                                    <div class="alert alert-warning"> 
                                        <?= $this->session->flashdata('error') ?> 
                                    </div>
                                <?php } ?> 
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label for="email">E-mail</label>
                                        <input type="text" class="form-control" name="email" placeholder="E-mail">
                                        <i class="fa fa-user icon-in-input"></i>
                                    </div>
                                </div>
                                <div align='center'>
                                    <br>
                                    <button class="btn btn-success" style="font-size: 14pt; font-weight: bold">
                                        Enviar
                                        <span class="glyphicon glyphicon-envelope"></span>
                                    </button>
                                    <br><br>   
                                    <hr>
                                </div>
                          </div>
                        </div>
                    <?php echo form_close();?>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


