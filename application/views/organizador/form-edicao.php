<div class="container-fluid">
<?= $tituloh2 ?>
<hr>
<br>

<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>


<?php
    $segmento = $this->uri->segment(2);
    $linkCadastro = 'edicao/cadastrar/';
    $linkAltera = $this->uri->uri_string();
    echo form_open_multipart( $segmento != 'alterar' ? $linkCadastro : $linkAltera, 'role="form" class="formsignin"' );
?>

<h4 class="subtitulo"><i>Dados da Edição</i></h4><br>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Conferência', 'conferencia' ); ?></b><br>
            <select name="conferencia" class="form-control estilo-input consultaConferencia">
            <?php   if(isset($edicao) && !empty($edicao->getConferencia())){   ?>
                 <option value="<?php echo $edicao->getConferencia()->getCodigo(); ?>" selected><?php echo $edicao->getConferencia()->getAbreviacao();?></option>
            <?php   }   ?>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Comitê', 'comite' ); ?></b><br>
            <select name="comite" class="form-control estilo-input consultaComite">
            <?php   if(isset($edicao) && !empty($edicao->getComite())){   ?>
          <option value="<?php echo $edicao->getComite()->getCodigo(); ?>" selected><?php echo $edicao->getComite()->getNome();?></option>
            <?php   }   ?>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Tema da Edição', 'tema' ); ?></b>
        <?php $data = array( 'name' => 'tema', 'placeholder' => "Tema da Edição", 
            'class' => 'form-control estilo-input',
             'value' => isset($edicao) ?  $edicao->getTema() : '');
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Link do Evento', 'linkevento' ); ?></b>
        <?php $data = array( 'name' => 'linkevento', 'placeholder' => "Link do Evento no site", 
            'class' => 'form-control estilo-input', 'id' => 'linkEvento',
             'value' => isset($edicao) ?  base_url($edicao->getLinkEdicao()) : '', 'readonly' => '');
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Imagem do Evento', 'image_field' ); ?></b>
            <?php $data = array( 'name' => 'image_field', 'id' => 'fileImage','type' => 'file',  
              'class' =>'file-uploading');
              echo form_upload($data);?>
        <input type="hidden" name="link_imagem_salva" id="link_imagem" value="<?= isset($edicao) ? $edicao->getImagemEdicao() : ''; ?>">
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Apresentação (ficará visível no site)', 'apresentacao' ); ?></b><br>
        <textarea name="apresentacao" placeholder="Apresentação (ficará visível no site)" id="editor" rows="10">
            <?php echo  (isset($edicao) ? $edicao->getApresentacao() : ''); ?>
        </textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Parcerias', 'parcerias' ); ?></b><br>
            <select name="parcerias[]" class="form-control estilo-input consultaInstituicao" multiple="multiple">
            <?php   if(isset($edicao) && $edicao->getParcerias() !== null){   
                    foreach ($edicao->getParcerias() as $key => $value) {
                                                                            ?>
                        <option value="<?php echo $value->getCodigo(); ?>" selected>
                        <?php echo $value->getAbreviacao(); ?>
                        </option>

            <?php     }
                    }                                                        ?>
            </select>
        </div>
    </div>
</div>

<h4 class="subtitulo"><i>Agendamento do Evento</i></h4><br>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data de Início do Evento', 'datainicioevento' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datainicioevento', 'placeholder' => "Data de Início do Evento", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($edicao) ? desconverteDataMysql($edicao->getDataInicioEvento()) : ''));
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data de Término do Evento', 'datafimevento' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datafimevento', 'placeholder' => "Data de Término do Evento", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($edicao) ? desconverteDataMysql($edicao->getDataFimEvento()) : '') );
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data inicial da publicação', 'datainiciopub' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datainiciopub', 'placeholder' => "Data inicial da publicação do evento no site", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($edicao) ? desconverteDataMysql($edicao->getDataInicioPublicacao()) : '') );
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data final da publicação', 'datafimpub' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datafimpub', 'placeholder' => "Data final da publicação do evento no site", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($edicao) ? desconverteDataMysql($edicao->getDataFimPublicacao()) : '') );
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data de Início das inscrições no evento', 'datainicioinsc' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datainicioinsc', 'placeholder' => "Data de Início do Evento", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($edicao) ? desconverteDataMysql($edicao->getDataInicioInscricao()) : ''));
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data de Término de inscrições no evento', 'datafiminsc' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datafiminsc', 'placeholder' => "Data de Término do Evento", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($edicao) ? desconverteDataMysql($edicao->getDataFimInscricao()) : '') );
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
</div>

<h4 class="subtitulo"><i>Endereço</i></h4><br>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group controls">
        <b><?php echo form_label( 'CEP', 'cep' ); ?></b>
        <?php $data = array( 'name' => 'cep', 
            'id' => 'campoCep',
            'class' => 'form-control estilo-input',
            'value' => ( isset($edicao) ? $edicao->getCep() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group controls">
        <b><?php echo form_label( 'Logradouro', 'logradouro' ); ?></b>
        <?php $data = array( 'name' => 'logradouro',
            'class' => 'form-control estilo-input',
            'id' => 'logradouro',
            'value' => ( isset($edicao) ? $edicao->getLogradouro() : ''));
              echo form_input( $data );?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-4">
        <div class="form-group controls">
        <b><?php echo form_label( 'Bairro', 'bairro' ); ?></b>
        <?php $data = array( 'name' => 'bairro', 
            'class' => 'form-control estilo-input',
            'id' => 'bairro',
            'value' => ( isset($edicao) ? $edicao->getBairro() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group controls">
        <b><?php echo form_label( 'Número', 'numero' ); ?></b>
        <?php $data = array( 'name' => 'numero', 
            'class' => 'form-control estilo-input',
            'value' => ( isset($edicao) ? $edicao->getNumero() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group controls">
        <b><?php echo form_label( 'Complemento', 'complemento' ); ?></b>
        <?php $data = array( 'name' => 'complemento', 
            'class' => 'form-control estilo-input',
            'value' => ( isset($edicao) ? $edicao->getComplemento() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
</div>


<div class="row">
      <div class="col-sm-4">
        <div class="form-group controls">
        <b><?php echo form_label( 'Cidade', 'cidade' ); ?></b>
        <?php $data = array( 'name' => 'cidade'
            ,'class' => 'form-control estilo-input'
            ,'id' => 'cidade'
            ,'value' => ( isset($edicao) ? $edicao->getCidade() : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group controls">
        <b><?php echo form_label( 'UF', 'uf' ); ?></b>
            <select name ="uf" class="form-control estilo-input" id="uf">
            <?php 

            $uf = array('AC','AL','AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO');
            foreach($uf as $key => $value){
                if(!isset($edicao) && $value == 'SP'){
                     echo "<option>".$value."</option>";
                }else if(isset($edicao) && $edicao->getUf() !== null && $edicao->getUf() == $value){

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

<h4 class="subtitulo"><i>Contato do Organizador Responsável</i></h4><br>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group floating-label-form-group-with-value controls"">
        <b><?php echo form_label( '*E-mail', 'telefone' ); ?></b>
        <?php $data = array( 'name' => 'email'
             ,'placeholder' => 'E-mail'
             ,'class' => 'form-control estilo-input' 
             ,'value' => isset($edicao) ? $edicao->getEmail() : '');
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group floating-label-form-group-with-value controls"">
        <b><?php echo form_label( 'Telefone/Celular', 'telefone' ); ?></b>
        <?php $data = array( 'name' => 'telefone'
             ,'id' => 'campoTelefone'
             ,'placeholder' => 'Telefone/Celular'
             ,'class' => 'form-control estilo-input' 
             ,'value' => isset($edicao) ? $edicao->getTelefone() : '');
              echo form_input( $data );?>
        </div>
    </div>
    
</div>


<?php echo "<br><center><a href='".base_url("edicao/consultar/")."' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;"
        .form_submit("btn_atualizar"
                , $segmento != 'alterar' ? 'Cadastrar' : 'Atualizar'
                ,array('class' => 'btn btn-success button'))."</center>";
    echo form_close();
?>
</div>
