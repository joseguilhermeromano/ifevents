<div class="container-fluid">
<h2> <span class="glyphicon glyphicon-list"> </span> <b> Comitês </b> </h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<div class="row">
    <form method="GET" action="<?php echo base_url('comite/consultar'); ?>">
        <div class="col-sm-4">
           <div class="input-group">
                 <input type="text" name="busca" class="form-control estilo-botao-busca" 
                 placeholder="Buscar por Denominação...">
                 <span class="input-group-btn">
                     <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                 </span>
           </div><!-- /input-group -->
         </div><!-- /.col-lg-6 -->
    </form>
    
    <div class="col-md-8 col-sm-8">
        <a class="btn btn-default hidden-xs" href='<?= base_url('/comite/cadastrar'); ?>' style="float:right">
            <span class="glyphicon glyphicon-plus"></span> Novo Comitê</a>
    </div>
</div><!-- /row -->
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    
                    <th><center>Denominação</center></th>
                    <th class="col-sm-6">Descrição</th>
                    <th><center>Opções</center></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($comites)):
                  foreach( $comites as $item ):?>
            <tr>
                    
                    
                    <td class="text-center"><?php echo $item->comi_nm; ?></td>
                    <td><?php echo $item->comi_desc; ?></td>
                    <td class="text-center">
                        <div class="text-left" style="display: inline-block">
                            <a href="<?= base_url('comite/alterar/'.$item->comi_cd); ?>" class="btn-opcao">
                            <span class="glyphicon glyphicon-pencil"></span>&#09;Ver/Editar</a><br>
                            <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
                            onclick="setCodigo('<?= $item->comi_cd; ?>'); 
                            setLink('<?= base_url('comite/excluir/')?>');">
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




