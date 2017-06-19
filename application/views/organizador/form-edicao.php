<div class="container-fluid">
<?= $tituloh2 ?>
<hr>
<br>

<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>


<?php
    echo form_open_multipart( $this->uri->segment(2) != 'alterar' ? 'edicao/cadastrar/' : $this->uri->uri_string(), 'role="form" class="formsignin"' );
?>

<h4 class="subtitulo"><i>Dados da Edição</i></h4><br>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Conferência', 'conferencia' ); ?></b><br>
            <select name="conferencia" class="form-control estilo-input consultaConferencia" multiple="multiple">
            <?php   if(isset($edicao->conferencia)){   ?>
                 <option value="<?php echo $edicao->conferencia->conf_cd; ?>" selected><?php echo $edicao->conferencia->conf_abrev;?></option>
            <?php   }   ?>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( '*Comitê', 'comite' ); ?></b><br>
            <select name="comite" class="form-control estilo-input consultaComite" multiple="multiple">
            <?php   if(isset($edicao->comite)){   ?>
          <option value="<?php echo $edicao->comite->comi_cd; ?>" selected><?php echo $edicao->comite->comi_nm;?></option>
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
             'value' => isset($edicao->edic_tema) ?  $edicao->edic_tema : '');
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <b><?php echo form_label( '*Link do Evento', 'linkevento' ); ?></b>
        <?php $data = array( 'name' => 'linkevento', 'placeholder' => "Link do Evento no site", 
            'class' => 'form-control estilo-input', 'id' => 'linkEvento',
             'value' => isset($edicao->edic_link) ?  base_url($edicao->edic_link) : '', 'readonly' => '');
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
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Apresentação (ficará visível no site)', 'apresentacao' ); ?></b><br>
        <textarea name="apresentacao" placeholder="Apresentação (ficará visível no site)" id="editor" rows="10">
            <?php echo  (isset($edicao) ? $edicao->edic_apresent : ''); ?>
        </textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group floating-label-form-group controls">
        <b><?php echo form_label( 'Parcerias', 'parcerias' ); ?></b><br>
            <select name="parcerias[]" class="form-control estilo-input consultaInstituicao" multiple="multiple">
            <?php   if(isset($edicao->parcerias[0]->inst_cd) && !empty($edicao->parcerias[0]->inst_cd)){   
                      foreach ($edicao->parcerias as $key => $value) {
                                                                            ?>
                        <option value="<?php echo $value->inst_cd; ?>" selected>
                        <?php echo $value->inst_abrev; ?>
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
             'value' => (isset($edicao->regra) ? desconverteDataMysql($edicao->regra->regr_even_ini_dt) : ''));
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
             'value' => (isset($edicao->regra) ? desconverteDataMysql($edicao->regra->regr_even_fin_dt) : '') );
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
             'value' => (isset($edicao->regra) ? desconverteDataMysql($edicao->regra->regr_pub_ini_dt) : '') );
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
             'value' => (isset($edicao->regra) ? desconverteDataMysql($edicao->regra->regr_pub_fin_dt) : '') );
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
             'value' => (isset($edicao->regra) ? desconverteDataMysql($edicao->regra->regr_insc_ini_dt) : ''));
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
             'value' => (isset($edicao->regra) ? desconverteDataMysql($edicao->regra->regr_insc_fin_dt) : '') );
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
        <?php $data = array( 'name' => 'cep', 'placeholder' => 'CEP', 
            'id' => 'campoCep',
            'class' => 'form-control estilo-input',
            'value' => (isset($edicao->localidade) ? $edicao->localidade->loca_cep : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group controls">
        <b><?php echo form_label( 'Logradouro', 'logradouro' ); ?></b>
        <?php $data = array( 'name' => 'logradouro', 'placeholder' => 'Logradouro',
            'class' => 'form-control estilo-input',
            'value' => (isset($edicao->localidade) ? $edicao->localidade->loca_lograd : ''));
              echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group controls">
        <b><?php echo form_label( 'Bairro', 'bairro' ); ?></b>
        <?php $data = array( 'name' => 'bairro', 'placeholder' => 'Bairro', 
            'class' => 'form-control estilo-input',
            'value' => (isset($edicao->localidade) ? $edicao->localidade->loca_bairro : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group controls">
        <b><?php echo form_label( 'Número', 'numero' ); ?></b>
        <?php $data = array( 'name' => 'numero', 'placeholder' => 'Número', 
            'class' => 'form-control estilo-input',
            'value' => (isset($edicao->localidade) ? $edicao->localidade->loca_num : ''));
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group controls">
        <b><?php echo form_label( 'Complemento', 'complemento' ); ?></b>
        <?php $data = array( 'name' => 'complemento', 'placeholder' => 'Complemento', 
            'class' => 'form-control estilo-input',
            'value' => (isset($edicao->localidade) ? $edicao->localidade->loca_comp : ''));
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
      <div class="col-sm-4">
        <div class="form-group controls">
        <b><?php echo form_label( 'Cidade', 'cidade' ); ?></b>
        <?php $data = array( 'name' => 'cidade', 'placeholder' => 'Cidade', 
            'class' => 'form-control estilo-input',
            'value' => (isset($edicao->localidade) ? $edicao->localidade->loca_cid : ''));
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
                if(!isset($edicao->localidade->loca_uf) && $value=='SP'){
                     echo "<option selected>".$value."</option>";
                }
                if(isset($edicao->localidade->loca_uf) && $edicao->localidade->loca_uf==$value){

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
             ,'value' => isset($edicao->email) ? $edicao->email->email_email : '');
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
             ,'value' => isset($edicao->telefone) ? $edicao->telefone->tele_fone : '');
              echo form_input( $data );?>
        </div>
    </div>
    
</div>


<?php echo "<br><center><a href='".base_url($this->uri->segment(1)."/consultar/")."' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;".form_submit("btn_atualizar", $this->uri->segment(2) != 'alterar' ? 'Cadastrar' : 'Atualizar',array('class' => 'btn btn-success button'))."</center>";

echo form_close();
?>
</div>