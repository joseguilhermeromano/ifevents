<div class="container-fluid">
<div class="col-sm-8 col-md-7">
<?= $tituloh2 ?>
<hr>
<br>

<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>


<?php
    echo form_open_multipart( $this->uri->segment(2) != 'alterar' ? 'modalidade/cadastrar/' : $this->uri->uri_string(), 'role="form" class="formsignin"' );
?>


<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
        <b><?php echo form_label( '*Denominação', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'placeholder' => "Denominação", 
            'class' => 'form-control estilo-input',
             'value' => (isset($modalidade) ? $modalidade->mote_nm : '') );
               echo form_input($data);?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
        <b><?php echo form_label( '*Descrição', 'descricao' ); ?></b><br>
        <textarea name="descricao" class="estilo-input" placeholder="Descrição" rows="10"><?php echo  (isset($modalidade) ? $modalidade->mote_desc : ''); ?></textarea>
        </div>
    </div>
</div>



<?php echo "<br><center><a href='".base_url($this->uri->segment(1)."/consultar/")."' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;".form_submit("btn_atualizar", $this->uri->segment(2) != 'alterar' ? 'Cadastrar' : 'Atualizar',array('class' => 'btn btn-success button'))."</center>";

echo form_close();
?>
</div>
</div>