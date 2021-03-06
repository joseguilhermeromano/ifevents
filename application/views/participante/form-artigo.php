<div class="container-fluid">
<div class="col-md-10">
<?= $tituloh2 ?>
<hr>
<br>
<?php 
    $this->load->helper('html');
    echo alert($this->session);

    $segmento = $this->uri->segment(2);
    $linkCadastro = 'artigo/cadastrar/'.$this->uri->segment(3);
    $linkAltera = $this->uri->uri_string();
    echo form_open_multipart( $segmento != 'alterar' ? $linkCadastro : $linkAltera
            , 'role="form" class="formsignin"' );
?>

<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
        <b><?php echo form_label( 'Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo'
            , 'placeholder' => "Título"
            , 'class' => 'form-control estilo-input'
            ,'value' => isset($artigo) ? $artigo->getTitulo() : '');
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'Orientador(a)', 'orientador' ); ?></b><br>
        <?php   $data = array( 'name' => 'orientador'
            , 'placeholder' => 'Orientador'
            ,'class' => 'form-control estilo-input'
            , 'value' => isset($artigo) ? $artigo->getOrientador() : '' );
                    echo form_input( $data );  ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
        <b><?php echo form_label( 'Autor(es) ', 'autor' ); ?></b><br>
            <select name="autores[]" class="form-control consultaVariosUsuarios" multiple="multiple">
            <?php if(isset($artigo) && $artigo->getAutores()!==null){ ?>
                <?php foreach ($artigo->getAutores() as $key => $value) { ?>
                <option selected value="<?= $value; ?>">
                 <?= somenteLetras($value); ?> </option>
                <?php }?>
            <?php } ?>
            </select>
        </div>
    </div>
</div>

<?php if($this->session->userdata('usuario')->user_tipo == 3){ ?>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
        <b><?php echo form_label( 'Autor Responsável ', 'autorrespons' ); ?></b><br>
            <select name="autorrespons" class="form-control consultaUnicoUsuario" multiple="multiple">
            <?php if(isset($artigo) && $artigo->getAutorResponsavel()!== null){ ?>
                
                <option selected value="<?= $artigo->getAutorResponsavel()->getCodigo(); ?>">
                 <?= $artigo->getAutorResponsavel()->getNomeCompleto(); ?> </option>
                
            <?php } ?>
            </select>
        </div>
    </div>
</div>
<?php }?>

<div class="row">

    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'Tipo de Modalidade', 'modalidade' ); ?></b>
         <select name="modalidade" class="form-control selectComum">
         <?php if(isset($artigo) && $artigo->getModalidade()===null){ ?>
            <option selected value="-1" disabled>Selecionar Modalidade</option>
         <?php }?>
         <?php foreach ($modalidades as $key => $value): ?>
            <?php if (isset($artigo) && $artigo->getModalidade()!==null 
                    && $artigo->getModalidade() == $value->mote_cd) { ?>
                <option selected value="<?= $value->mote_cd; ?>"><?= $value->mote_nm; ?></option>
            <?php }?>
                <option value="<?= $value->mote_cd; ?>"><?= $value->mote_nm; ?></option>
         <?php endforeach; ?>
        </select>
        
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( 'Eixo Temático', 'area' ); ?></b>
         <select name="area" class="form-control selectComum">
         <?php if(isset($artigo) && $artigo->getEixoTematico()=== null){ ?>
            <option selected value="-1" disabled>Selecionar Eixo Temático</option>
         <?php }?>
         <?php foreach ($eixos as $key => $value): ?>
            <?php if (isset($artigo) && $artigo->getEixoTematico()!== null 
                    && $artigo->getEixoTematico() == $value->mote_cd) { ?>
                <option selected value="<?= $value->mote_cd; ?>"><?= $value->mote_nm; ?></option>
            <?php }?>
            <option value="<?= $value->mote_cd; ?>"><?= $value->mote_nm; ?></option>
         <?php endforeach; ?>
         </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <b><?php echo form_label( 'Resumo', 'resumo' ); ?></b><br>
        <?php   $data = array( 'name' => 'resumo'
            , 'id' => 'editor'
            , 'placeholder' => 'Resumo'
            ,'cols' => 200
            , 'rows' =>10
            ,'class' => 'form-control estilo-input'
            , 'value' => isset($artigo) ? $artigo->getResumo() : '');
                    echo form_textarea( $data ); ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-xs-6 col-xs-offset-2">

         <a class="btn btn-default margin-button" href='<?= site_url($regrasSubmissao); ?>' 
            style="float:right" target="_blank">
         <i class="glyphicon glyphicon-save-file" aria-hidden="true"></i> Diretrizes de Submissão</a>
    
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <?php $checked = $this->session->flashdata('checked');?>
        <input type="checkbox" name="aceite" <?= $checked; ?> > 
        Declaro que li e concordo com as diretrizes de submissão de trabalhos para este evento.
    </div>
</div>
<?php echo "<br><center><a href='javascript: window.history.back();' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;"
        .form_submit("btn_atualizar"
                , "Próximo"
                ,array('class' => 'btn btn-success button'))."</center>";
    echo form_close();
?>
</div>
</div>
