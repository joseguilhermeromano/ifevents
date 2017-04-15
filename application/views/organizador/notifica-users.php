<div class="container-fluid">
<h2><span class="glyphicon glyphicon-envelope"></span><b> Notificar Usuários</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>


<div class="row">
<?php
    echo form_open_multipart( 'usuario/notificaUsers', 'role="form" class="formsignin"' );?>
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Emails', 'emails' ); ?></b><br>
            <select name="emails[]" class="form-control estilo-input consultaEmails" multiple="multiple">
            <?php 
            if(!empty($notificacao['emails'])){
                foreach ($notificacao['emails'] as $key => $value) {
            ?>
                <option value="<?php echo $value; ?>" selected><?php echo $value;?></option>
            <?php 
                }
            }
            ?>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Assunto', 'assunto' ); ?></b>
        <?php $data = array( 'name' => 'assunto', 'placeholder' => "Assunto", 
            'class' => 'form-control estilo-input',
             'value' => (isset($notificacao) ? $notificacao['assunto'] : '') );
               echo form_input($data);?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Mensagem', 'mensagem' ); ?></b><br>
        <textarea name="mensagem" placeholder="Mensagem" class="form-control" id="editor" rows="10">
            <?php echo  (isset($notificacao) ? $notificacao['mensagem'] : ''); ?>
        </textarea>
        </div>
    </div>
</div>



<?php echo '<br><center>'.form_submit("btn_atualizar", "Enviar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

echo form_close();
?>
</div>