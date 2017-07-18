<h2> <span class="glyphicon glyphicon-list"> </span> <b> Conferências </b> </h2>
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
         <a class="btn btn-default hidden-xs" href='<?php echo site_url('/conferencia/cadastrar'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Nova Conferência</a>
    </div>
</div><!-- /row -->
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                <th class="col-md-6">Título</th>
								<th><center>Abreviação</center></th>
								<th><center>Descrição</center></th>
                <th><center>Editar</center></th>
                <th><center>Excluir</center></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($content)):
                    foreach( $content as $item ):?>
                    <tr>
                        <td><?php echo $item->conf_nm; ?></td>
												<td class="text-center"><?php echo $item->conf_abrev; ?></td>
                        <td class="text-center"><?php echo $item->conf_desc; ?></td>
                        <td class="text-center"><a href="<?php echo base_url('/conferencia/alterar/'.$item->conf_cd); ?>"><span class="glyphicon glyphicon-edit estilo-botao-edicao"></span></a></td>
                        <td class="text-center"><a href="#" data-toggle="modal" data-target="#modalExcluir"
                        onclick="setCodigo('<?php echo $item->conf_cd; ?>');
                        setLink('<?php echo base_url('/conferencia/excluir/')?>');">
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
