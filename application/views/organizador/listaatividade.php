<h2> <span class="glyphicon glyphicon-blackboard"> </span> <b> Atividades </b> </h2>
<hr>
<br>

<div class="error"><?php echo validation_errors(); ?></div>
<br>

<?php
        $this->load->helper('html');
        echo alert($this->session);
?>

<div class="row">
    <div class="col-md-6 col-sm-6">
       <div class="input-group">
         <input type="text" class="form-control estilo-botao-busca" placeholder="Buscar por Título...">
         <span class="input-group-btn">
             <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
         </span>
       </div><!-- /input-group -->
     </div><!-- /.col-lg-6 -->
</div><!-- /row -->
<?php if($flag != 'hidden' ):?>
<div class="row">
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" href='<?php echo site_url('/atividade/cadastrar'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Nova Atividade</a>
         <a class="btn btn-default margin-button" href='<?php echo site_url('/tipoatividade/consultarTudo'); ?>' style="float:right"><i class="glyphicon glyphicon-blackboard"></i> Tipos de Atividade</a>
    </div>
</div>
<?php endif; ?>

<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                <th><center>Título</center></th>
                <th><center>Descrição</center></th>
                <th><center>Data  </center></th>
                <th><center>Inicio</center></th>
                <th><center>Término</center></th>
                <th><center>Local</center></th>
                <th><center>Vagas</center></th>
                <?php if($flag != 'hidden'){ ?>
                <th><center>Opções</center></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php

                if(!empty($content)):
                    foreach( $content as $item ): ?>
                    <tr>
                        <td><?php echo $item->ativ_nm; ?></td>
                        <td class="text-center"><?php echo $item->ativ_desc; ?></td>
                        <td class="text-center"><?php echo date("d-m-Y", strtotime($item->ativ_dt)); ?></td>
                        <td class="text-center"><?php echo $item->ativ_hora_ini; ?></td>
                        <td class="text-center"><?php echo $item->ativ_hora_fin; ?></td>
                        <td class="text-center"><?php echo $item->ativ_local; ?></td>
                        <td class="text-center"><?php echo $item->ativ_vagas_qtd; ?></td>
                        <?php if($flag != 'hidden'): ?>
                        <td <div class="text-left" style="display: inline-block">
                        		<a class="btn-opcao" href="<?php echo base_url('/atividade/alterar/'.$item->ativ_cd);  ?>">
                            		<span class="glyphicon glyphicon-pencil"></span>&#09;Editar
								</a><br>
								<a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
									onclick="setCodigo('<?php echo $item->ativ_cd; ?>');
									setLink('<?php echo base_url('/atividade/excluir/')?>');">
									<span class="glyphicon glyphicon-remove"></span>&#09;Excluir
								</a>
							</div>
						</td>
                     <?php endif; ?>

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
