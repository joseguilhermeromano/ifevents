<div class="container-fluid">
<h2> <span class="glyphicon glyphicon-list"> </span> <b> Conferências </b> </h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
    <form method="GET" action="<?php echo base_url('conferencia/consultar'); ?>" name="form-busca">
	<div class="row">
            <div class="col-sm-4">
               <div class="input-group">
                     <input type="text" name="busca" id="busca" value="<?= isset($busca) ? $busca : ''?>" class="form-control estilo-botao-busca" 
                     placeholder="Buscar por Título ou Abreviação...">
                     <span class="input-group-btn">
                         <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                     </span>
               </div><!-- /input-group -->
             </div><!-- /.col-lg-6 -->

            <div class="col-md-8 col-sm-8">
                <a class="btn btn-default hidden-xs" href='<?php echo site_url('/conferencia/cadastrar'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Nova Conferência</a>
            </div>
	</div>
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
                        <th class="col-md-3">Título</th>
                        <th><center>Abreviação</center></th>
                        <th class="col-md-4"><center>Descrição</center></th>
                        <th class="col-md-3"><center>Opções</center></th>
                    </tr>
                </thead>
              <tbody>
              <?php
              if(!empty($content)){
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
              <?php endforeach; }else{ ?>
                      <tr>
                        <td class="col-xs-12 text-center" colspan="4">Não foram encontrados resultados para a sua busca...</td>
                      </tr>
                    <?php } ?> 
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
</div>

</div>
	
