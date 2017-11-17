<div class="container-fluid">
<h2> <span class="glyphicon glyphicon-list"> </span> <b> Lista de Contatos </b> </h2>
<hr>
<br>

<?php
    $this->load->helper('html');
    echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('contato/consultarTudo'); ?>" name="form-busca">
<div class="row">
        <div class="col-sm-4">
           <div class="input-group">
                 <input type="text" name="busca" id="busca" value="<?= isset($busca) ? $busca : ''?>"  class="form-control estilo-botao-busca" 
                 placeholder="Buscar por Nome do Contato...">
                 <span class="input-group-btn">
                     <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                 </span>
           </div><!-- /input-group -->
         </div><!-- /.col-lg-6 -->
</div><!-- /row -->
<br><br>
<div class="row">
        <div class="col-lg-2 col-lg-offset-10 
             col-md-3 col-md-offset-9 
             col-sm-4 col-sm-offset-8 
             col-xs-6 col-xs-offset-6
             form-group">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                    <p style="font-size: 13px; margin-top:10px">
                        <?php echo form_label( 'Registros:', 'limite'); ?>
                    </p>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <select name="limitereg" id="limitereg" class="selectComum form-control estilo-input" onchange="document.forms['form-busca'].submit();">
                        <option value="10" <?= $limiteReg == "10" ? 'selected' : ''?>>10</option>
                        <option value="25" <?= $limiteReg == "25" ? 'selected' : ''?>>25</option>
                        <option value="50" <?= $limiteReg == "50" ? 'selected' : ''?>>50</option>
                        <option value="100" <?= $limiteReg == "100" ? 'selected' : ''?>>100</option>
                        <option value="500"<?= $limiteReg == "500" ? 'selected' : ''?> >500</option>
                        <option value="0"<?= $limiteReg == "0" ? 'selected' : ''?> >Tudo</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>
    <div class="row" id="ListagemRegistros">
        <div class="col-md-12" id="RegistrosPagina">
            <div class="table-responsive"><!-- TABELA-->
                <table class="table ls-table" id="tabela1">
                    <thead>
                        <tr>
                            <th class="col-md-3">Nome</th>
                            <th class="col-md-3">Assunto</th>
                            <th><center>E-mail</center></th>
                            <th class="col-md-2"><center>Mensagem</center></th>
                            <th class="col-md-2"><center>Status</center></th>
                            <th class="col-md-2"><center>Opção</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($content)){
                                foreach( $content as $item ):?>
                                <tr>
                                    <td><?php echo $item->cont_nm; ?></td>
                                    <td><?php echo $item->cont_assunto; ?></td>
                                    <td class="text-center"><?php echo $item->cont_email; ?></td>
                                                            <td class="text-center"><a href="#"
                                                                                    class="btn-opcao"
                                                                                    data-container="body"
                                                                                    data-toggle="popover"
                                                                                    data-placement="bottom"
                                                                                    data-content="<?php echo $item->cont_msg; ?>">
                                                            <i class="fa fa-envelope-open btn-"></i>&nbsp;Ver Mensagem
                                                                    </a>
                                                            </td>
                                    <td class="text-center"><?= $item->cont_status == 0 ? 'Não Respondido' : 'Respondido' ?></td>
                                                            <td class="text-center"> 
                                                                <div class="text-left" style="display: inline-block">
                                                                    <a class="btn-opcao" href="<?php echo base_url('/contato/responder/'.$item->cont_cd);?>">
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
                        <?php endforeach; }else{ ?>
                          <tr>
                            <td class="col-xs-12 text-center" colspan="6">Não foram encontrados resultados para a sua busca...</td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- /TABELA-->
            <?php if(!empty($content)): ?>
            <!-- PAGINAÇÃO -->
                <div class="text-center">
                Exibindo de 1 a <?= !empty($content) ? sizeof($content) : 0; ?> de um total de <?= !empty($content) ? $totalRegistros : 0; ?> registros
                </div>
                <?= isset($paginacao) ? $paginacao : ''; ?>
            <!--/ PAGINAÇÃO -->
            <?php endif; ?>
        </div>
    </div>
        
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
</div>
