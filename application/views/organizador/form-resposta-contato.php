<div class = "col-sm-8">
<h2><span class="glyphicon glyphicon-envelope"></span><b> Resposta</b></h2>
<hr>
<br>

<?php 
    $this->load->helper('html');
    echo alert($this->session);
?>

<?php echo form_open( $this->uri->uri_string(), 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Nome', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome'
            , 'placeholder' => "Nome"
            , 'class' => 'form-control estilo-input' 
            , 'value' => isset($resposta) ? $resposta->getNome() : ''
            ,'readonly' => 'readonly');
               echo form_input($data);
        ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'E-mail', 'email' ); ?></b>
        <?php $data = array( 'name' => 'email'
            , 'placeholder' => "E-mail"
            , 'class' => 'form-control estilo-input' 
            , 'value' => isset($resposta) ? $resposta->getEmail() : ''
            ,'readonly' => 'readonly');
               echo form_input($data);
        ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Assunto', 'assunto' ); ?></b>
        <?php $data = array( 'name' => 'assunto'
            , 'placeholder' => "Assunto"
            , 'class' => 'form-control estilo-input' 
            , 'value' => isset($resposta) ? $resposta->getAssunto() : '');
               echo form_input($data);
        ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Mensagem', 'mensagem' ); ?></b><br>
        <?php   $data = array( 'name' => 'mensagem'
            , 'placeholder' => 'Mensagem...'
            ,'cols' => 200
            , 'rows' =>10
            ,'class' => 'form-control estilo-input'
            , 'value' => isset($resposta) ? $resposta->getMensagem() : '');
            echo form_textarea( $data ); 
        ?>
    </div>
</div>

<?php echo "<br><center><a href='javascript: window.history.back()' class='btn btn-default button'>Voltar</a>&nbsp;"
.form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
</div>
