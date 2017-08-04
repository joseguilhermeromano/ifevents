<div class="container-fluid">
<h2> <span class="glyphicon glyphicon-list"> </span> <b> Instituições </b> </h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<div class="row">
    <form method="GET" action="<?php echo base_url('instituicao/consultar'); ?>">
        <div class="col-sm-6">
           <div class="input-group">
                 <input type="text" name="busca" class="form-control estilo-botao-busca" 
                 placeholder="Buscar por Nome ou Abreviação...">
                 <span class="input-group-btn">
                     <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                 </span>
           </div><!-- /input-group -->
         </div><!-- /.col-lg-6 -->
    </form>
</div>
<div class="row">
  <div class="col-sm-12">
    <a class="btn btn-default margin-button" href='<?php echo site_url('/instituicao/cadastrar'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Nova Instituição</a>
  </div>
</div>
<br><br>
<div class="table-responsive">
  <table class="table ls-table" id="tabela1">
    <thead>
      <tr>
        <th><center>Abreviação</center></th>
        <th>Nome</th>
        <th><center>Descrição</center></th>
        <th><center>Opções</center></th>
      </tr>
    </thead>
    <tbody>
<?php
  if(!empty($instituicoes)):
    foreach( $instituicoes as $item ): ?>
    <tr>
        <td class="text-center"><?= $item->inst_abrev; ?></td>
        <td class="col-md-3"><?= $item->inst_nm; ?></td>
        <td class="text-center col-md-4"><?= $item->inst_desc; ?></td>
        <td class="text-center col-md-3">
            <div class="text-left" style="display: inline-block">
                <a href="<?= base_url('instituicao/alterar/'.$item->inst_cd); ?>" class="btn-opcao">
                <span class="glyphicon glyphicon-pencil"></span>&#09;Ver/Editar</a><br>
                <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
                onclick="setCodigo('<?= $item->inst_cd; ?>'); 
                setLink('<?= base_url('instituicao/excluir/')?>');">
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
    Exibindo de 1 a <?= !empty($comites) ? sizeof($comites) : 0; ?> de um total de <?= !empty($comites) ? $totalRegistros : 0; ?> registros
    </div>
    <?= isset($paginacao) ? $paginacao : ''; ?>
  <!--/ PAGINAÇÃO -->

</div>
