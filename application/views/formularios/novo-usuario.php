<?php 

        $this->load->helper('html');
        echo alert($this->session);

         $nomeDiretorio = $this->session->userdata('nomeDiretorio'); 
         $view = $this->session->userdata('view'); 

                                             ?>
<?php echo form_open_multipart( 'usuario/cadastrar', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>
<h4 class="subtitulo"><i>Dados de acesso</i></h4><br>
<div class="row">
<?php   if($nomeDiretorio!='inicio'){ 
        $colsm6="col-sm-6";                                                                                  ?>
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b>
        <?php echo form_label( '*Tipo de Usuário', 'tipo_usuario' ); ?> 
        </b><br>
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
<?php   }//if($nomeDiretorio!='inicio')                                                                                  ?>
    <div class="<?php echo ($nomeDiretorio=='inicio' ? 'col-sm-6' : 'col-sm-4'); ?>">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Nome Completo', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'placeholder' => "Nome Completo", 'class' => 'form-control estilo-input', 'value' => (isset($user) ? $user->user_nm : ''));
               echo form_input($data);?>
        </div>
    </div>
    <div class="<?php echo ($nomeDiretorio=='inicio' ? 'col-sm-6' : 'col-sm-4'); ?>">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Instituição', 'instituicao' ); ?></b><br>
            <select name="instituicao" class="consultaInstituicao form-control estilo-input" id="consultaInstituicao" multiple="multiple">
            <?php   if(isset($instituicao->inst_nm)){   ?>
                <option value="<?php echo $instituicao->inst_cd; ?>" selected><?php echo $instituicao->inst_nm;?></option>
            <?php   }   ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group  floating-label-form-group controls" id='EmailPrincipal'>
        <b><?php echo form_label( '*E-mail de login', 'email' ); ?></b>
        <?php $data = array( 'name' => 'email[0]', 'placeholder' => 'E-mail','class' => 'form-control estilo-input',
         'value' => (isset($emails) && !empty($emails) ? $emails[0]->email_email : ''));
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group  floating-label-form-group controls">
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
<?php   if(isset($emails) && !empty($emails)) { 


            foreach ($emails as $key => $value) {
            if ($key !=0 ){
                                                        ?>
            <div class="col-sm-6">
            <b><label for="email<?php echo '['.$key.']'; ?>">E-mail alternativo <?php echo $key; ?></label></b>
                <div class="input-group floating-label-form-group controls">
                    <input type="text" name="email<?php echo '['.$key.']';?>" class="form-control estilo-botao-remove"
                    value="<?php echo $value->email_email;?>" />
                    <span class="input-group-btn">
                         <button class="btn btn-danger" onclick="this.parentNode.parentNode.parentNode.remove(this);" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                     </span>
                </div>
            </div>
<?php
            }
            }
        }                    
                                                        ?>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group  floating-label-form-group controls">
        <b><?php echo form_label( '*Senha', 'senha' ); ?></b>
        <?php $data = array( 'name' => 'senha', 'type' => 'password','placeholder' => 'Senha','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Confirmar Senha', 'confirmasenha' ); ?></b>
        <?php $data = array( 'name' => 'confirmasenha',  'type' => 'password', 'placeholder' => 'Confirmar Senha', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Biografia <i style="font-size:10pt;color:grey"> (Fale um pouco sobre suas formações!)</i>', 'biografia' ); ?></b>
        
        <textarea name="biografia" placeholder="Biografia:Fale um pouco sobre suas formações! " class="form-control estilo-input" rows="5"><?php echo (isset($user) ? $user->user_biograf : ''); ?></textarea>
        </div>
    </div>
    <div class="col-sm-6"  id="qtdMaxSubmissaoAval" 
      <?php 

        if((!isset($user->user_tipo)  &&  $view !== 'cadastro_avaliador') || (isset($user->user_tipo) && $user->user_tipo!=1)){
            echo 'style="display:none"';
        }

      ?> >
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Qtd. Máxima de Submissões', 'qtdSubmissoes' ); ?></b>
        <?php $data = array( 'name' => 'qtdSubmissoes', 'type' => 'text','placeholder' => 'Qtd. Máxima de Submissões','class' => 'form-control estilo-input', 'onkeyup' => "somenteNumeros(this);", "maxlength" => "2",
            'value' => (isset($user->user_qtd_subm) ? $user->user_qtd_subm : ''));
              echo form_input( $data );?>
        </div>
    </div>
</div>



<h4 class="subtitulo"><i>Documentos</i></h4><br>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group floating-label-form-group-with-value controls">
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
        <div class="form-group floating-label-form-group floating-label-form-group-with-value controls">
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


<h4 class="subtitulo"><i>Endereço</i></h4><br>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Logradouro', 'logradouro' ); ?></b>
        <?php $data = array( 'name' => 'logradouro', 'placeholder' => 'Logradouro',
            'class' => 'form-control estilo-input',
            'value' => (isset($localidade) ? $localidade->loca_lograd : ''));
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Bairro', 'bairro' ); ?></b>
        <?php $data = array( 'name' => 'bairro', 'placeholder' => 'Bairro', 
            'class' => 'form-control estilo-input',
            'value' => (isset($localidade) ? $localidade->loca_bairro : ''));
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Número', 'numero' ); ?></b>
        <?php $data = array( 'name' => 'numero', 'placeholder' => 'Número', 
            'class' => 'form-control estilo-input',
            'value' => (isset($user) ? $user->user_loca_num : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Complemento', 'complemento' ); ?></b>
        <?php $data = array( 'name' => 'complemento', 'placeholder' => 'Complemento', 
            'class' => 'form-control estilo-input',
            'value' => (isset($user) ? $user->user_loca_comp : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'CEP', 'cep' ); ?></b>
        <?php $data = array( 'name' => 'cep', 'placeholder' => 'CEP', 
            'id' => 'campoCep',
            'class' => 'form-control estilo-input',
            'value' => (isset($localidade) ? $localidade->loca_cep : ''));
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Cidade', 'cidade' ); ?></b>
        <?php $data = array( 'name' => 'cidade', 'placeholder' => 'Cidade', 
            'class' => 'form-control estilo-input',
            'value' => (isset($localidade) ? $localidade->loca_cid : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'UF', 'uf' ); ?></b>
            <select name ="uf" class="form-control estilo-input" id="uf">
            <?php 

            $uf = array('AC','AL','AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO');
            foreach($uf as $key => $value){
                if(!isset($localidade->loca_uf) && $value=='SP'){
                     echo "<option selected>".$value."</option>";
                }
                if(isset($localidade->loca_uf) && $localidade->loca_uf==$value){

                    echo "<option selected>".$value."</option>";

                }else{

                    echo "<option>".$value."</option>";
                }

            }

            ?>

            </select>
        </div>
    </div>
</div>

<h4 class="subtitulo"><i>Contato</i></h4><br>
<div class="row">
    <div class="col-sm-12">
        <a href="#" id="addTelefone" class="btn btn-success" style="margin-bottom:10px">
        <span class="glyphicon glyphicon-plus"></span> <b>Adicionar Telefone</b></a><br>
    </div>
</div>
<div id="inputsTelefones" class="row">
<?php   if(isset($telefones) && !empty($telefones)) { 


            foreach ($telefones as $key => $value) {
                                                        ?>
            <div class="col-sm-4">
            <b><label for="telefone<?php echo '['.$key.']'; ?>">Telefone/Celular <?php echo $key; ?></label></b>
                <div class="input-group  floating-label-form-group controls">
                    <input type="text" id="campoTelefone" name="telefone<?php echo '['.$key.']';?>" class="form-control estilo-botao-remove"
                    value="<?php echo $value->tele_fone;?>" />
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