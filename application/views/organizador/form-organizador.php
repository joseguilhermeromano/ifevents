<div class="container-fluid">                  
<h2><?= $tituloForm; ?></h2>
<hr>
<br>

<?php 

        $this->load->helper('html');
        echo alert($this->session);
                                             ?>

<?php echo form_open_multipart($this->uri->uri_string(), 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>

<h4 class="subtitulo"><i>Dados de acesso</i></h4><br>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Nome Completo', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'class' => 'form-control estilo-input'
                            , 'value' => (isset($organizador) ? $organizador->getNomeCompleto() : ''));
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Instituição', 'instituicao' ); ?></b><br>
            <select name="instituicao" class="form-control estilo-input consultaInstituicao">
            <?php   if(isset($organizador)){   ?>
                <option value="<?php echo $organizador->getInstituicao()->getCodigo(); ?>" selected>
                    <?php echo $organizador->getInstituicao()->getAbreviacao(); ?> 
                </option>
            <?php   }   ?>
            </select>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group  floating-label-form-group controls">
        <b><?php echo form_label( '*E-mail', 'email' ); ?></b>
        <?php $data = array( 'name' => 'email', 'class' => 'form-control estilo-input',
         'value' => (isset($organizador) && !empty($organizador->getEmail()) ? $organizador->getEmail() : ''));
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group  floating-label-form-group controls">
        <b><?php echo form_label( '*Confirmar e-mail', 'confirmaemail' ); ?></b>
        <?php $data = array( 'name' => 'confirmaemail', 'class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group  floating-label-form-group controls">
        <b><?php echo form_label( '*Senha', 'senha' ); ?></b>
        <?php $data = array( 'name' => 'senha', 'type' => 'password','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Confirmar Senha', 'confirmasenha' ); ?></b>
        <?php $data = array( 'name' => 'confirmasenha',  'type' => 'password', 'class' => 'form-control estilo-input');
              echo form_input( $data );?>
        </div>
    </div>
</div>


<h4 class="subtitulo"><i>Documentos</i></h4><br>


<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group floating-label-form-group-with-value controls">
            <b><?php echo form_label( '*RG', 'rg' ); ?></b>
            <?php $data = array( 
            'name' => 'rg'
            ,'id' => 'campoRG'
            ,'type' => 'text'
            ,'class' => 'form-control estilo-input'
            ,'value' => (isset($organizador) ? $organizador->getRg() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group floating-label-form-group-with-value controls">
            <b><?php echo form_label( 'CPF', 'cpf' ); ?></b>
            <?php $data = array( 
            'name' => 'cpf' 
            ,'id' => 'campoCPF'
            ,'type' => 'text'
            ,'class' => 'form-control estilo-input'
            ,'value' => (isset($organizador) ? $organizador->getCpf() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
</div>


<h4 class="subtitulo"><i>Endereço</i></h4><br>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'CEP', 'cep' ); ?></b>
        <?php $data = array( 'name' => 'cep', 
            'id' => 'campoCep',
            'class' => 'form-control estilo-input',
            'value' => (isset($organizador) ? $organizador->getCep() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Logradouro', 'logradouro' ); ?></b>
        <?php $data = array( 'name' => 'logradouro',
            'class' => 'form-control estilo-input',
            'value' => (isset($organizador) ? $organizador->getLogradouro() : ''));
              echo form_input( $data );?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Bairro', 'bairro' ); ?></b>
        <?php $data = array( 'name' => 'bairro', 
            'class' => 'form-control estilo-input',
            'value' => (isset($organizador) ? $organizador->getBairro() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Número', 'numero' ); ?></b>
        <?php $data = array( 'name' => 'numero', 
            'class' => 'form-control estilo-input',
            'value' => (isset($organizador) ? $organizador->getNumero() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Complemento', 'complemento' ); ?></b>
        <?php $data = array( 'name' => 'complemento', 
            'class' => 'form-control estilo-input',
            'value' => (isset($organizador) ? $organizador->getComplemento() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
</div>


<div class="row">
      <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Cidade', 'cidade' ); ?></b>
        <?php $data = array( 'name' => 'cidade'
            ,'class' => 'form-control estilo-input'
            ,'value' => (isset($organizador) ? $organizador->getCidade() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'UF', 'uf' ); ?></b>
            <select name ="uf" class="form-control estilo-input selectComum" id="uf">
            <?php 

            $uf = array('AC','AL','AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO');
            foreach($uf as $key => $value){
                if(!isset($organizador) && $value=='SP'){
                     echo "<option selected>".$value."</option>";
                }else if(isset($organizador) && $organizador->getUf()==$value){

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
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group floating-label-form-group-with-value controls"">
        <b><?php echo form_label( 'Telefone/Celular', 'telefone' ); ?></b>
        <?php $data = array( 'name' => 'telefone'
             ,'id' => 'campoTelefone'
             ,'class' => 'form-control estilo-input' 
             ,'value' => isset($organizador) ? $organizador->getTelefone() : '');
              echo form_input( $data );?>
        </div>
    </div>
</div>


<?php 
    $nomeBotao = $this->uri->segment(2) == "cadastrar" ? "Cadastrar" : "Atualizar";
    $botaoVoltar = $this->uri->segment(2) != "perfil" ? "<a href='".base_url('usuario/consultar')."' class='btn btn-default button' >Voltar</a>&nbsp;&nbsp;" : '';
    echo '<br><center>'.$botaoVoltar
    .form_submit("btn_cadastro", $nomeBotao, array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
</div>


