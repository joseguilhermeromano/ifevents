<h2><span class="glyphicon glyphicon-envelope"></span><b> Resposta</b></h2>
<hr>
<div class="error"><?php echo validation_errors(); ?></div>
<br>
<?php
    $this->load->helper('html');
    echo alert($this->session);
?>
<div class="row">
<?php
	//if(isset($content)):
	//foreach ($content as $data):
		$email = (isset($content->cont_email) ? $content->cont_email : '');
		$nome  = (isset($content->cont_nm) ? $content->cont_nm : '');


	echo form_open_multipart( 'usuario/notificaUsers', 'role="form" class="formsignin"' );
		 $data = array(
           'tipo_notificacao'  => '1'
         );
		 echo form_hidden($data);


		 $dados = array(
		   'tipo'=> 'resposta'
		 );
		echo form_hidden($dados);
		?>
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Nome', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'placeholder' => "Nome", 'class' => 'form-control estilo-input' );
               echo form_input($data, set_value('nome', $nome));
	    ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Email', 'email' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'emails[]', 'placeholder' => "Email", 'class' => 'form-control estilo-input');
                echo form_input(  $data, set_value('email', $email) );
        	?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Assunto', 'assunto' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'assunto', 'class' => 'form-control estilo-input');
                echo form_input( $data );
        	?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Mensagem', 'mensagem' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'mensagem', 'id'=>'editor', 'cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                echo form_textarea( $data );
        	?>
        </div>
    </div>
</div>

<?php echo '<br><center>'.form_submit("btn_atualizar", "Enviar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

echo form_close();
//endforeach;

//endif;

?>
