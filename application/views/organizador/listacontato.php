<h2> <span class="glyphicon glyphicon-list"> </span> <b> Lista de Contatos </b> </h2>
<hr>
<br>

<div class="error"><?php echo validation_errors(); ?></div>
<br>
<?php if ($this->session->flashdata('success')) { ?>
	<div class="alert alert-success">
        <?= $this->session->flashdata('success') ?>
    </div>
<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error') ?>
    </div>
<?php } ?>


<div class="row">
    <div class="col-md-6 col-sm-6">
       <div class="input-group">
         <input type="text" class="form-control estilo-botao-busca" placeholder="Buscar por Título...">
         <span class="input-group-btn">
             <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
         </span>
       </div><!-- /input-group -->
     </div><!-- /.col-lg-6 -->
    <div class="col-md-6 col-sm-6">
         <a class="btn btn-default hidden-xs" href='<?php echo site_url('/contato/sendEmail'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Enviar Email</a>
    </div>
</div><!-- /row -->
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                <th class="col-md-6">Nome</th>
                <th><center>Assunto</center></th>
                <th><center>Email</center></th>
                <th><center>Mensagem</center></th>
                <th><center>Responder</center></th>
                <th><center>Excluir</center></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($content)):
                    foreach( $content as $item ):?>
                    <tr>
                        <td><?php echo $item->cont_nm; ?></td>
                        <td class="text-center"><?php echo $item->cont_assunto; ?></td>
                        <td class="text-center"><?php echo $item->cont_email; ?></td>
                        <td class="text-center"><h5 onclick= "show  ('msg');"><span class="glyphicon glyphicon-comment"></span></h5>
                            <div id="msg" style="display: none;">
                                <p> <?php echo $item->cont_msg; ?> </p>
                            </div></td>
                        <td class="text-center"><a href="<?php echo base_url('/contato/consultar/'.$item->cont_cd); ?>"><span class="glyphicon glyphicon-edit estilo-botao-edicao"></span></a></td>
                        <td class="text-center"><a href="#" data-toggle="modal" data-target="#modalExcluir"
                        onclick="setCodigo('<?php echo $item->cont_cd; ?>');
                        setLink('<?php echo base_url('contato/excluir/')?>');">
                        <span class="glyphicon glyphicon-trash estilo-botao-exclusao"></span></a></td>
                    </tr>
            <?php endforeach;
            endif;?>



        </tbody>
    </table>
</div><!-- /TABELA-->
<nav><!-- Paginação -->
    <ul class="pagination">
      <li>
        <a href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li>
      <li>
        <a href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
</nav><!-- /Paginação -->
