
                        
<h2><span class="glyphicon glyphicon-pencil"></span><b> Edita Usuário</b></h2>
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

<?php echo form_open_multipart( 'organizador/alterausuario', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>
<h4><i>Dados pessoais e de acesso</i></h4><br>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Nome Completo', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'placeholder' => "Nome Completo", 'value' => $usuario[0]['user_nm'], 'class' => 'form-control estilo-input');
               echo form_input($data);?>
        <?php $data = array( 'name' => 'codigo', 'placeholder' => "Nome Completo", 'type'=>'hidden','value' => $usuario[0]['user_id'], 'class' => 'form-control estilo-input');
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Instituição/Empresa', 'instituicao' ); ?></b><br>
        <?php   $data = array( 'name' => 'instituicao', 'placeholder' => 'Instituição/Empresa','value' => $usuario[0]['user_ins_emp'], 'class' => 'form-control estilo-input' );
                echo form_input($data); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Telefone', 'telefone' ); ?></b><br>
        <?php   $data = array( 'name' => 'telefone', 'placeholder' => 'Telefone','value' => $usuario[0]['user_fone'], 'class' => 'form-control estilo-input' );
                    echo form_input( $data );  ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'E-mail', 'email' ); ?></b>
        <?php $data = array( 'name' => 'email', 'placeholder' => 'E-mail','value' => $usuario[0]['user_email'],'class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Confirma E-mail', 'confirmaemail' ); ?></b>
        <?php $data = array( 'name' => 'confirmaemail', 'placeholder' => 'Confirma E-mail','value' => $usuario[0]['user_nm'],'class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Senha', 'senha' ); ?></b>
        <?php $data = array( 'name' => 'senha', 'type' => 'password','placeholder' => 'Senha', 'value' => $usuario[0]['user_pass'],'class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Confirmar Senha', 'confirmasenha' ); ?></b>
        <?php $data = array( 'name' => 'confirmasenha',  'type' => 'password', 'placeholder' => 'Confirmar Senha', 'value' => $usuario[0]['user_pass'], 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <select name="tipo" class="form-control estilo-input">
                <option value="<?php echo $usuario[0]['user_tipo']; ?>" selected hidden> 
                    <?php switch($usuario[0]['user_tipo']){
                       case 1: echo "Avaliador"; break;
                       case 2: echo "Organizador"; break;
                       default: echo "Participante"; break;
                    } ?>
                </option>
                <option value="2" >Organizador</option>
                <option value="1" >Avaliador</option>
                <option value="0">Participante</option>
            </select>
        </div>
    </div>
</div>
<h4><i>Endereço</i></h4><br>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Logradouro', 'logradouro' ); ?></b>
        <?php $data = array( 'name' => 'logradouro', 'placeholder' => 'Logradouro','value' => $usuario[0]['user_logradouro'],'class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Bairro', 'bairro' ); ?></b>
        <?php $data = array( 'name' => 'bairro', 'placeholder' => 'Bairro', 'value' => $usuario[0]['user_bairro'], 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Número', 'numero' ); ?></b>
        <?php $data = array( 'name' => 'numero', 'placeholder' => 'Número', 'value' => $usuario[0]['user_numero'], 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Complemento', 'complemento' ); ?></b>
        <?php $data = array( 'name' => 'complemento', 'placeholder' => 'Complemento', 'value' => $usuario[0]['user_complemento'], 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'CEP', 'cep' ); ?></b>
        <?php $data = array( 'name' => 'cep', 'placeholder' => 'CEP', 'value' => $usuario[0]['user_cep'], 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Cidade', 'cidade' ); ?></b>
        <?php $data = array( 'name' => 'cidade', 'placeholder' => 'Cidade', 'value' => $usuario[0]['user_cidade'], 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'UF', 'uf' ); ?></b>
        <?php $data = array( 'name' => 'uf', 'placeholder' => 'UF', 'value' => $usuario[0]['user_uf'], 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<?php echo '<br><center>'.form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>

