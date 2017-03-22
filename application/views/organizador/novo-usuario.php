<div class="container-fluid">                  
<h2><span class="glyphicon glyphicon-plus"></span><b> Novo Usuário</b></h2>
<hr>
<br>
<?php 

        $this->load->helper('html');
        echo alert($this);

                                             ?>
<?php echo form_open_multipart( 'usuario/cadastrar', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>
<h4><i>Dados de acesso</i></h4><br>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Tipo de Usuário', 'tipo_usuario' ); ?></b><br>
            <select name="tipo_usuario" id="tipoUsuario" class="form-control estilo-input">
                <option value="-1" selected disabled> Selecionar Tipo de Usuário</option>
                <option value="2" <?= (isset($user) && $user->user_tipo == 2 ? 'selected' : ''); ?> >
                    Organizador
                </option>
                <option value="1" <?= (isset($user) && $user->user_tipo == 1 ? 'selected' : ''); ?>>
                    Avaliador
                </option>
                <option value="0" <?= (isset($user) && $user->user_tipo == 0 ? 'selected' : ''); ?>>  
                    Participante
                </option>
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Nome Completo', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'placeholder' => "Nome Completo", 'class' => 'form-control estilo-input', 'value' => (isset($user) ? $user->user_nm : ''));
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'Instituição', 'instituicao' ); ?></b><br>
            <select name="instituicao" class="consultaInstituicao form-control estilo-input" id="consultaInstituicao" multiple="multiple">
            <?php   if(isset($user)){   ?>
                <option value="<?php echo $user->user_ins_emp; ?>" selected><?php echo $user->inst_nm; ?></option>
            <?php   }   ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group" id='EmailPrincipal'>
        <b><?php echo form_label( '*E-mail de login', 'email' ); ?></b>
        <?php $data = array( 'name' => 'email[0]', 'placeholder' => 'E-mail','class' => 'form-control estilo-input',
         'value' => (isset($user) ? $user->emailLogin : ''));
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Confirmar e-mail de login', 'confirmaemail' ); ?></b>
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
<?php   if(isset($user) && !empty($user->lista_emails)) { 


            foreach ($user->lista_emails as $key => $value) {
                                                        ?>
            <div class="col-sm-6">
            <b><label for="email<?php echo '['.$key.']'; ?>">E-mail alternativo <?php echo $key; ?></label></b>
                <div class="input-group">
                    <input type="text" name="email<?php echo '['.$key.']';?>" class="form-control estilo-botao-remove"
                    value="<?php echo $value;?>" />
                    <span class="input-group-btn">
                         <button class="btn btn-danger" onclick="this.parentNode.parentNode.parentNode.remove(this);" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                     </span>
                </div>
            </div>
<?php
            }
        }                    
                                                        ?>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Senha', 'senha' ); ?></b>
        <?php $data = array( 'name' => 'senha', 'type' => 'password','placeholder' => 'Senha','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Confirmar Senha', 'confirmasenha' ); ?></b>
        <?php $data = array( 'name' => 'confirmasenha',  'type' => 'password', 'placeholder' => 'Confirmar Senha', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( 'Biografia', 'biografia' ); ?></b>
        <i style="font-size:10pt;color:grey"> (Fale um pouco sobre suas formações!)</i>
        <textarea name="biografia" class="form-control estilo-input" rows="5"><?php echo (isset($user) ? $user->user_biografia : ''); ?></textarea>
        </div>
    </div>
    <div class="col-sm-6"  id="qtdMaxSubmissaoAval" 
      <?php (!isset($user->qtdSubmissoes) ? 'style="display:none"' : '')?> >
        <div class="form-group">
        <b><?php echo form_label( '*Qtd. Máxima de Submissões', 'qtdSubmissoes' ); ?></b>
        <?php $data = array( 'name' => 'qtdSubmissoes', 'type' => 'text','placeholder' => 'Qtd. Máxima de Submissões','class' => 'form-control estilo-input', 'onkeyup' => "somenteNumeros(this);", "maxlength" => "2",
            'value' => (isset($user->qtdSubmissoes) ? $user->qtdSubmissoes : ''));
              echo form_input( $data );?>
        </div>
    </div>
</div>



<h4><i>Documentos</i></h4><br>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <b><?php echo form_label( '*RG', 'rg' ); ?></b>
            <?php $data = array( 'name' => 'rg', 
                'id' => 'campoRG',
             'type' => 'text', 'placeholder' => 'RG',
              'class' => 'form-control estilo-input',
              'value' => (isset($user) ? $user->user_rg : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <b><?php echo form_label( 'CPF', 'cpf' ); ?></b>
            <?php $data = array( 'name' => 'cpf', 
                'id' => 'campoCPF',
             'type' => 'text', 'placeholder' => 'CPF',
              'class' => 'form-control estilo-input',
            'value' => (isset($user) ? $user->user_cpf : ''));
                    echo form_input( $data );?>
        </div>
    </div>
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
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'Cidade', 'cidade' ); ?></b>
        <?php $data = array( 'name' => 'cidade', 'placeholder' => 'Cidade', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
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

<h4><i>Contato</i></h4><br>
<div class="row">
    <div class="col-sm-12">
        <a href="#" id="addTelefone" class="btn btn-success" style="margin-bottom:10px">
        <span class="glyphicon glyphicon-plus"></span> <b>Adicionar Telefone</b></a><br>
    </div>
</div>
<div id="inputsTelefones" class="row">
<?php   if(isset($user) && !empty($user->lista_telefones)) { 


            foreach ($user->lista_telefones as $key => $value) {
                                                        ?>
            <div class="col-sm-4">
            <b><label for="telefone<?php echo '['.$key.']'; ?>">Telefone/Celular <?php echo $key; ?></label></b>
                <div class="input-group">
                    <input type="text" id="campoTelefone" name="telefone<?php echo '['.$key.']';?>" class="form-control estilo-botao-remove"
                    value="<?php echo $value;?>" />
                    <span class="input-group-btn">
                         <button class="btn btn-danger" onclick="this.parentNode.parentNode.parentNode.remove(this);" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                     </span>
                </div>
            </div>
<?php
            }
        }                    
                                                        ?>
</div>
<?php echo '<br><center>'.form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>

</div>

