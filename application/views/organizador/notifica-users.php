<div class="container-fluid">
<h2><span class="fa fa-exclamation-triangle"></span><b> Notificar Usuários</b></h2>
<hr>
<br>

<?php
        $this->load->helper('html');
        echo alert($this->session);
?>


<?php
    echo form_open_multipart( 'usuario/notificar', 'role="form" class="formsignin"' );
?>

<div id="divCarregando" class="progresso">
    <img src="<?php echo base_url('assets/area-interna/img/status-carregando.gif');?>">
</div>
<div id="fundoTelaDivCarregando">
</div>

<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group floating-label-form-group controls">
        <b>
        <?php echo form_label( '*Notificar', 'tipo_notificacao' ); ?>
        </b><br>
            <select name="tipo_notificacao" id="tipoNotificacao" class="form-control estilo-input selectComum">
                <option value="-1" selected disabled> Selecionar Tipo de Notificação</option>
                <option value="1" <?= (isset($notificacao) && $notificacao->tipo_notificacao == 1 ? 'selected' : ''); ?> >
                    Especificar e-mails
                </option>
                <option value="2" <?= (isset($notificacao) && $notificacao->tipo_notificacao == 2 ? 'selected' : ''); ?> >
                    Somente Participantes
                </option>
                <option value="3" <?= (isset($notificacao) && $notificacao->tipo_notificacao == 3 ? 'selected' : ''); ?> >
                    Somente Revisores
                </option>
                <option value="4" <?= (isset($notificacao) && $notificacao->tipo_notificacao == 4 ? 'selected' : ''); ?> >
                    Somente Organizadores
                </option>
                <option value="5" <?= (isset($notificacao) && $notificacao->tipo_notificacao == 5 ? 'selected' : ''); ?> >
                    Todos
                </option>
            </select>
        </div>
    </div>
</div>

<div class="row" id="notificacoesEmails" <?= ((isset($notificacao) && $notificacao->tipo_notificacao == 1)
|| isset($notificacao->emails) ? '' : 'style="display:none"'); ?>>
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Emails', 'emails' ); ?></b><br>
            <select name="emails[]" class="form-control estilo-input consultaEmails" multiple="multiple">
            <?php
            if(!empty($notificacao->emails)){
                foreach ($notificacao->emails as $key => $value) {
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
        <b><?php echo form_label( '*Assunto', 'assunto' ); ?></b>
        <?php $data = array( 'name' => 'assunto',
                             'placeholder' => "Assunto",
                             'class' => 'form-control estilo-input',
                             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Mensagem', 'mensagem' ); ?></b><br>
        <textarea name="mensagem" placeholder="Mensagem" id="editor" rows="10">
            <?php echo  (isset($notificacao) ? $notificacao->mensagem : ''); ?>
        </textarea>
        </div>
    </div>
</div>



<?php echo '<br><center><a href='.base_url($this->uri->segment(1)."/consultar/").' class="btn btn-default button">Voltar</a>&nbsp;&nbsp;'.form_submit("btn_atualizar", "Enviar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

echo form_close();
?>
</div>
