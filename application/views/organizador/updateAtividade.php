
<div class="container-fluid">
<h2><span class="glyphicon glyphicon-floppy-save"></span><b> Atualizar Atividades</b></h2>
<hr>
<br>

<?php
        $this->load->helper('html');
        echo alert($this->session);
?>


<?php
    foreach( $content as $data ):
    echo form_open_multipart( 'atividade/alterar/'.$data->ativ_cd, 'role="form" class="formsignin"' );
?>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b>
        <?php echo form_label( '*Tipo de Atividade', 'tipo_atividade' ); ?>
        </b><br>
            <select name="tipo_atividade" id="tipoAtividade" class="form-control estilo-input">
                <?php //if(empty($content) and empty($atividade)):

                        foreach ( $atividade as $item ):
                            if($item->tiat_cd == $data->ativ_tiat_cd){ ?>
                                <option value="<?php echo $item->tiat_cd ?>" selected><?php echo $item->tiat_nm; ?></option>
                      <?php }else{ ?>
                             <option value="<?php echo $item->tiat_cd ?>"><?php echo $item->tiat_nm; ?></option>
                      <?php }
                        endforeach;
                                $descricao     = $data->ativ_desc;
                                $atividadeData = $data->ativ_dt;
                                $inicio        = $data->ativ_hora_ini;
                                $termino       = $data->ativ_hora_fin;
                                $local         = $data->ativ_local;
                                $quantidade    = $data->ativ_vagas_qtd;

                      ?>

            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo', 'placeholder' => "Titulo",
            'class' => 'form-control estilo-input', 'value'=> $data->ativ_nm );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'descricao', 'placeholder' => 'Descrição', 'id'=>'editor', 'cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input' );
                echo form_textarea( $data, set_value('descricao', $descricao));
        	?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Data', 'data' ); ?></b>
        <?php $data = array( 'name' => 'data', 'placeholder' => "Data",
            'class' => 'form-control estilo-input' );
               echo form_input($data, set_value('atividadeData', date("d-m-Y", strtotime($atividadeData ))));?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Hora do Início', 'início' ); ?></b>
        <?php $data = array( 'name' => 'inicio', 'placeholder' => "Início",
            'class' => 'form-control estilo-input' );
               echo form_input($data, set_value('inicio', $inicio) );?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Hora do Término', 'termino' ); ?></b>
        <?php $data = array( 'name' => 'termino', 'placeholder' => "Término",
            'class' => 'form-control estilo-input' );
               echo form_input($data, set_value('termino', $termino));?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong><?php echo form_label( '*Local', 'local'); ?> </strong>
            <?php $data = array( 'name'        => 'local',
                                 'placeholder' => 'Local',
                                 'class'       => 'form-control estilo-input' );
                          echo form_input($data, set_value('local', $local));?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong><?php echo form_label( '*Quantidade de Vagas', 'vagasQtd' )?></strong>
                    <?php $data = array( 'name' => 'vagasQtd',
                                         'placeholder' => 'Quantidade de Vagas',
                                         'class' => 'form-control estilo-input' );
                          echo form_input($data, set_value('quantidade', $quantidade));?>
        </div>
    </div>
</div>

<?php echo '<br><center>'.form_submit("btn_atualizar", "Atualizar", array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

echo form_close();


    endforeach;?>

</div>
