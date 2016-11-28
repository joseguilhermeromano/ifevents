<h2><span class="glyphicon glyphicon-user"></span><b> Meu Perfil</b><a class="btn btn-default" style="float:right">Alterar Senha</a></h2>
<hr>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Nome Completo', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Nome Completo", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'RG', 'subm_orientador' ); ?></b><br>
        <?php   $data = array( 'name' => 'subm_orientador', 'placeholder' => 'RG', 'class' => 'form-control estilo-input' );
                    echo form_input( $data );  ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'CPF', 'subm_instituicao' ); ?></b>
        <?php $data = array( 'name' => 'subm_instituicao', 'placeholder' => 'CPF','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Instituição/Empresa', 'subm_orientador' ); ?></b><br>
        <?php   $data = array( 'name' => 'subm_orientador', 'placeholder' => 'Instituição/Empresa', 'class' => 'form-control estilo-input' );
                    echo form_input( $data );  ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'E-mail', 'subm_instituicao' ); ?></b>
        <?php $data = array( 'name' => 'subm_instituicao', 'placeholder' => 'E-mail','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Telefone', 'subm_instituicao' ); ?></b>
        <?php $data = array( 'name' => 'subm_instituicao', 'placeholder' => 'Telefone','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Celular', 'subm_instituicao' ); ?></b>
        <?php $data = array( 'name' => 'subm_instituicao', 'placeholder' => 'Celular','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Endereço', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Endereço", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Número', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Número", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Bairro', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Bairro", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Complemento', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Complemento", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'CEP', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "CEP", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Cidade', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Cidade", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Estado', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Estado", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>
<?php echo '<br><center>'.form_submit("btn_atualizar", "Atualizar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>

