<div class="container-fluid">
<h2> <span class="glyphicon glyphicon-list"> </span> <b> Conferências </b> </h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>

	<div class="row">
            <form method="GET" action="<?php echo base_url('conferencia/consultar'); ?>">
                  <div class="col-sm-4">
                     <div class="input-group">
                           <input type="text" name="busca" class="form-control estilo-botao-busca" 
                           placeholder="Buscar por Título ou Abreviação...">
                           <span class="input-group-btn">
                               <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                           </span>
                     </div><!-- /input-group -->
                   </div><!-- /.col-lg-6 -->
            </form>

		<div class="col-md-8 col-sm-8">
  		<a class="btn btn-default hidden-xs" href='<?php echo site_url('/conferencia/cadastrar'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Nova Conferência</a>
  	</div>
	</div>
<br><br>
	<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                <th class="col-md-3">Título</th>
                <th><center>Abreviação</center></th>
                <th class="col-md-4"><center>Descrição</center></th>
                <th class="col-md-3"><center>Opções</center></th>
            </tr>
        </thead>
      <tbody>
      <?php
      if(!empty($content)):
      	foreach( $content as $item ):?>
            <tr>
                <td><?php echo $item->conf_nm; ?></td>
                <td class="text-center"><?php echo $item->conf_abrev; ?></td>
                <td><?php echo $item->conf_desc; ?></td>
                <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                        <a href="<?= base_url('conferencia/alterar/'.$item->conf_cd); ?>" class="btn-opcao">
                        <span class="glyphicon glyphicon-pencil"></span>&#09;Ver/Editar</a><br>
                        <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
                        onclick="setCodigo('<?= $item->conf_cd; ?>'); 
                        setLink('<?= base_url('conferencia/excluir/')?>');">
                        <span class="fa fa-trash"></span>&#09;Excluir</a>
                    </div>
                </td>
            </tr>
      <?php endforeach;
      endif;?>
      </tbody>
    </table>
</div><!-- /TABELA -->

 <!-- PAGINAÇÃO -->
    <div class="text-center">
    Exibindo de 1 a <?= !empty($content) ? sizeof($content) : 0; ?> de um total de <?= !empty($content) ? $totalRegistros : 0; ?> registros
    </div>
    <?= isset($paginacao) ? $paginacao : ''; ?>
  <!--/ PAGINAÇÃO -->

</div>
	
