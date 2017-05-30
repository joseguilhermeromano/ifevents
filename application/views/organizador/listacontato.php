<h2> <span class="glyphicon glyphicon-list"> </span> <b> Lista de Contatos </b> </h2>
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
                <th><center>Mensagem</center></th>
                <th><center>Opção</center></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($content)):
                    foreach( $content as $item ):?>
                    <tr>
                        <td><?php echo $item->cont_nm; ?></td>
                        <td class="text-center"><?php echo $item->cont_assunto; ?></td>
						<td class="text-center"><a href="#"
									data-container="body"
									data-toggle="popover"
									data-placement="bottom"
									data-content="<?php echo $item->cont_msg; ?>"><?php echo $item->cont_email; ?></span>
							</a>
						</td>

						<td <div class="text-left" style="display: inline-block">
                        		<a class="btn-opcao" href="<?php echo base_url('/contato/consultar/'.$item->cont_cd);?>">
                            		<span class="glyphicon glyphicon-pencil"></span>&#09;Responder
								</a><br>
								<a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
									onclick="setCodigo('<?php echo $item->cont_cd; ?>');
									setLink('<?php echo base_url('/contato/excluir/')?>');">
									<span class="glyphicon glyphicon-remove"></span>&#09;Excluir
								</a>
							</div>
						</td>
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

<!-- Modal de Exibição -->
<style>
	p{
		width: 500px;
		text-align: justify;
	}
</style>
	<div id="modalExibir" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Mensagem</h4>
				</div>
				<div class='container'>
					<div class="row">
						<div class="col-md-12">
							<div class="modal-body">

								<p><?php
									echo "<strong>Nome:</strong> ".$result->cont_nm;
									echo "<br><strong>Assunto:</strong> ".$result->cont_assunto;
									echo "<br><br>".$result->cont_msg;
									?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
					<button class="btn btn-success" onclick="Executa();">Responder</button>
				</div>
			</div>
		</div>
	</div>
