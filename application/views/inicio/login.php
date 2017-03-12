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
                    <?php echo form_open('login/entrar');?>

                    
                    <div class="row">
                          <div class="col-md-10 col-md-offset-1">
                            <h1 class="estilo-h1">Login</h1>
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
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label for="senha">Senha</label>
                                        <input type="password" class="form-control" name="senha" placeholder="Senha">
                                        <i class="fa fa-key icon-in-input"></i>
                                    </div>
                                </div>
                                <div align='right'>
                                    <a href="#">Esqueceu sua Senha?</a>
                                </div>
                                <div align='center'>
                                    <br>
                                    <button class="btn btn-success" style="font-size: 14pt; font-weight: bold">
                                        Entrar
                                        <span class="glyphicon glyphicon-log-in"></span>
                                    </button>
                                    <br><br>   
                                    <hr>
                                    <h4>Não tem uma Conta? <a style="color:#969690;" href="<?php echo base_url('cadastro'); ?>">Cadastra-se</a></h4>
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


