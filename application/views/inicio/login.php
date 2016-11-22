<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Acesse sua Conta</h2>
            <hr class="star-primary">
        </div>
    </div>
    <?php echo form_open('administracao/Home/login');?>
    <div class="row text">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">                    
                    <?php echo form_label('Usuário', 'email');
                          $data = array('name' => 'email', 'placeholder' => 'Email' );
                          echo form_input($data);?>
                    </br>
                </div>
            </div>
        </div>
    </div>
    <div class="row text">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">                    
                    <?php echo form_label('Senha', 'senha');
                          $data = array('name' => 'senha', 'placeholder' => 'Senha' );  
                          echo form_password($data);?>
                    </br>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-lg-offset-3">
        <div align='right'>
            <a href="#">Esqueceu sua Senha?</a>
        </div>
        <div align='center'>
            <br>
            <?php echo form_submit('btnSubmit', 'Entrar','<button class="btn btn-primary", style="font-size: 14pt; font-weight: bold"><span class="glyphicon glyphicon-log-in"></span></button>');?><br><br>
            <?php echo form_close();?>       
            <hr>
            <h4>Não tem uma Conta? <a href="<?php echo base_url('cadastro'); ?>">Cadastra-se</a></h4>
            <br><br><br><br>
        </div>
    </div>
</div>


