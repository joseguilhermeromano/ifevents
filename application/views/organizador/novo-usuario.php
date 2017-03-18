<div class="container-fluid">                  
<h2><span class="glyphicon glyphicon-plus"></span><b> Novo Usuário</b></h2>
<hr>
<br>
<?php
    if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger"> 
        <?= $this->session->flashdata('error') ?> 
    </div>
<?php } ?>
<?php
if(!empty(validation_errors())){
    echo '<div class="alert alert-danger">'.validation_errors().'</div>';
}
?>
<?php
 if ($this->session->flashdata('success')) { ?>
	<div class="alert alert-success"> 
        <?= $this->session->flashdata('success') ?> 
    </div>
<?php
 } 
 ?>

<?php echo form_open_multipart( 'usuario/cadastrar', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>
<h4><i>Dados pessoais e de acesso</i></h4><br>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'Tipo de Usuário', 'tipo_usuario' ); ?></b><br>
            <select name="tipo_usuario" class="form-control estilo-input">
                <option value="-1" selected disabled> Selecionar Tipo de Usuário</option>
                <option value="2" >Organizador</option>
                <option value="1" >Avaliador</option>
                <option value="0">Participante</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'Nome Completo', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'placeholder' => "Nome Completo", 'class' => 'form-control estilo-input');
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'Instituição/Empresa', 'instituicao' ); ?></b><br>
            <select class="select2 form-control estilo-input" id="uf" multiple="multiple">
                <option>Selecione uma instituição</option>
                <option>teste</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group" id='EmailPrincipal'>
        <b><?php echo form_label( 'E-mail de login', 'email' ); ?></b>
        <?php $data = array( 'name' => 'email[0]', 'placeholder' => 'E-mail','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( 'Confirmar e-mail de login', 'confirmaemail' ); ?></b>
        <?php $data = array( 'name' => 'confirmaemail', 'placeholder' => 'Confirma E-mail','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a href="#inputsEmails" id="addEmail" class="btn btn-success" style="margin-bottom:10px">
        <span class="glyphicon glyphicon-plus"></span> <b>Adicionar E-mail</b></a><br>
    </div>
</div>
<div id="inputsEmails" class="row">
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( 'Senha', 'senha' ); ?></b>
        <?php $data = array( 'name' => 'senha', 'type' => 'password','placeholder' => 'Senha','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( 'Confirmar Senha', 'confirmasenha' ); ?></b>
        <?php $data = array( 'name' => 'confirmasenha',  'type' => 'password', 'placeholder' => 'Confirmar Senha', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <b><?php echo form_label( 'Telefone', 'telefone' ); ?></b>
            <?php $data = array( 'name' => 'telefone[0]', 
                'id' => 'campoTelefone',
             'type' => 'text', 'placeholder' => 'Telefone',
              'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a href="#" id="addTelefone" class="btn btn-success" style="margin-bottom:10px">
        <span class="glyphicon glyphicon-plus"></span> <b>Adicionar Telefone</b></a><br>
    </div>
</div>
<div id="inputsTelefones" class="row">
</div>
<h4><i>Endereço</i></h4><br>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( 'Logradouro', 'logradouro' ); ?></b>
        <?php $data = array( 'name' => 'logradouro', 'placeholder' => 'Logradouro','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( 'Bairro', 'bairro' ); ?></b>
        <?php $data = array( 'name' => 'bairro', 'placeholder' => 'Bairro', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'Número', 'numero' ); ?></b>
        <?php $data = array( 'name' => 'numero', 'placeholder' => 'Número', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'Complemento', 'complemento' ); ?></b>
        <?php $data = array( 'name' => 'complemento', 'placeholder' => 'Complemento', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'CEP', 'cep' ); ?></b>
        <?php $data = array( 'name' => 'cep', 'placeholder' => 'CEP', 
            'id' => 'campoCep',
            'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( 'Cidade', 'cidade' ); ?></b>
        <?php $data = array( 'name' => 'cidade', 'placeholder' => 'Cidade', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( 'UF', 'uf' ); ?></b>
            <select class="form-control estilo-input" id="uf">
                    <option>AC</option>
                    <option>AL</option>
                    <option>AM</option>
                    <option>AP</option>
                    <option>BA</option>
                    <option>CE</option>
                    <option>DF</option>
                    <option>ES</option>
                    <option>GO</option>
                    <option>MA</option>
                    <option>MG</option>
                    <option>MS</option>
                    <option>MT</option>
                    <option>PA</option>
                    <option>PB</option>
                    <option>PE</option>
                    <option>PI</option>
                    <option>PR</option>
                    <option>RJ</option>
                    <option>RN</option>
                    <option>RO</option>
                    <option>RR</option>
                    <option>RS</option>
                    <option>SC</option>
                    <option>SE</option>
                    <option selected="selected">SP</option>
                    <option>TO</option>
                  </select>
        </div>
    </div>
</div>
<?php echo '<br><center>'.form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
</div>

