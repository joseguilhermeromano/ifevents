<div class="container-fluid">
<h2><span class="fa fa-calendar-plus-o"></span><b> Nova Edição</b></h2>
<hr>
<br>

<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>


<?php
    echo form_open_multipart( 'usuario/notificaUsers', 'role="form" class="formsignin"' );
?>

<div id="divCarregando" class="progresso">
    <img src="<?php echo base_url('assets/area-interna/img/status-carregando.gif');?>">
</div>
<div id="fundoTelaDivCarregando">
</div>

<h4 class="subtitulo"><i>Dados da Edição</i></h4><br>

<div class="row">
    <div class="col-md-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Conferência', 'conferencia' ); ?></b><br>
            <select name="conferencia" class="form-control estilo-input consultaConferencia" multiple="multiple">
            <?php   //if(isset($instituicao->inst_nm)){   ?>
                <!-- <option value="<?php echo $instituicao->inst_cd; ?>" selected><?php echo $instituicao->inst_nm;?></option> -->
            <?php   //}   ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Comitê', 'comite' ); ?></b><br>
            <select name="comite" class="form-control estilo-input consultaComite" multiple="multiple">
            <?php   //if(isset($instituicao->inst_nm)){   ?>
                <!-- <option value="<?php echo $instituicao->inst_cd; ?>" selected><?php echo $instituicao->inst_nm;?></option> -->
            <?php   //}   ?>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Nome', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'placeholder' => "Nome da Edição", 
            'class' => 'form-control estilo-input',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Abreviação', 'abreviacao' ); ?></b>
        <?php $data = array( 'name' => 'abreviacao', 'placeholder' => "Abreviação da Edição", 
            'class' => 'form-control estilo-input',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
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
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( '*Link do Evento', 'linkevento' ); ?></b>
        <?php $data = array( 'name' => 'linkevento', 'placeholder' => "Link do Evento no site", 
            'class' => 'form-control estilo-input',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( '*Imagem do Evento', 'imagemevento' ); ?></b>
            <?php $data = array( 'name' => 'userfile','class' => 'form-control estilo-input');
              echo form_upload($data);?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Apresentação (ficará visível no site)', 'apresentacao' ); ?></b><br>
        <textarea name="apresentacao" placeholder="Mensagem" id="editor" rows="10">
            <?php echo  (isset($notificacao) ? $notificacao->mensagem : ''); ?>
        </textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Parcerias', 'parcerias' ); ?></b><br>
            <select name="parcerias" class="form-control estilo-input consultaInstituicao" multiple="multiple">
            <?php   //if(isset($instituicao->inst_nm)){   ?>
                <!-- <option value="<?php echo $instituicao->inst_cd; ?>" selected><?php echo $instituicao->inst_nm;?></option> -->
            <?php   //}   ?>
            </select>
        </div>
    </div>
</div>

<h4 class="subtitulo"><i>Regras</i></h4><br>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Data de Início do Evento', 'datainicioevento' ); ?></b>
        <?php $data = array( 'name' => 'datainicioevento', 'placeholder' => "Data de Início do Evento", 
            'class' => 'form-control estilo-input datepicker', 'id' => 'data_inicio_1',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Data de Término do Evento', 'datafimevento' ); ?></b>
        <?php $data = array( 'name' => 'datafimevento', 'placeholder' => "Data de Término do Evento", 
            'class' => 'form-control estilo-input datepicker', 'id' => 'data_fim_1',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Data inicial da publicação', 'datainiciopub' ); ?></b>
        <?php $data = array( 'name' => 'datainiciopub', 'placeholder' => "Data inicial da publicação do evento no site", 
            'class' => 'form-control estilo-input datepicker', 'id' => 'data_inicio_2',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Data final da publicação', 'datafimpub' ); ?></b>
        <?php $data = array( 'name' => 'datafimpub', 'placeholder' => "Data final da publicação do evento no site", 
            'class' => 'form-control estilo-input datepicker', 'id' => 'data_fim_2',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Data da abertura de submissões de trabalhos', 'datainiciopub' ); ?></b>
        <?php $data = array( 'name' => 'datainisub', 'placeholder' => "Data da abertura de submissões de trabalhos", 
            'class' => 'form-control estilo-input datepicker', 'id' => 'data_inicio_3',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Data de encerramento das submissões de trabalhos', 'datafimsub' ); ?></b>
        <?php $data = array( 'name' => 'datafimsub', 'placeholder' => "Data de encerramento das submissões de trabalhos", 
            'class' => 'form-control estilo-input datepicker', 'id' => 'data_fim_3',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Qtd mínima de submissões por revisor', 'qtdminsubrev' ); ?></b>
        <?php $data = array( 'name' => 'qtdminsubrev', 'placeholder' => "Quantidade mínima de submissões por revisor", 
            'class' => 'form-control estilo-input', 
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Prazo máximo de resposta do Revisor', 'prazorev' ); ?></b>
        <?php $data = array( 'name' => 'prazorev', 'placeholder' => "Prazo máximo de resposta do Revisor", 
            'class' => 'form-control estilo-input',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Prazo máximo de resposta do Participante', 'prazopart' ); ?></b>
        <?php $data = array( 'name' => 'prazopart', 'placeholder' => "Prazo máximo de resposta do Participante", 
            'class' => 'form-control estilo-input',
             'value' => (isset($notificacao) ? $notificacao->assunto : '') );
               echo form_input($data);?>
        </div>
    </div>
</div>

<?php echo '<br><center>'.form_submit("btn_atualizar", "Enviar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

echo form_close();
?>
</div>