<div class="container-fluid">
<h2><span class="fa fa-list"></span><b> Atribuição de Submissões</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
  <form method="GET" action="<?php echo base_url('revisao/consultar-atribuicoes'); ?>" name="form-busca">
    <div class="row">
        <div class="col-sm-4 col-xs-12">
           <div class="input-group">
                 <input type="text" name="busca" id="busca" value="<?= isset($busca) ? $busca : ''?>" class="form-control estilo-botao-busca" 
                 placeholder="Buscar por título do trabalho...">
                 <span class="input-group-btn">
                     <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                 </span>
           </div><!-- /input-group -->
         </div><!-- /.col-lg-6 -->
        <div class="col-sm-8 col-xs-12">
            <?php $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd; ?>
            <a class="btn btn-default" href='<?= base_url("artigo/cadastrar/".$codigoEdicao); ?>' style="float:right;"><span class="glyphicon glyphicon-plus"></span> Nova Submissão</a>
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
                                <th class="col-xs-3">Trabalho</th>
                                <th class="col-xs-2 text-center">Modalidade</th>
                                <th class="col-xs-3 text-center">Eixo Temático</th>
                                <th class="col-xs-2 text-center">Arquivos</th>
                                <th class="text-center" style="width:auto">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(!empty($atribuicoes)){
                        foreach( $atribuicoes as $atribuicao ): ?>
                            <tr> 
                                <td><?= $atribuicao->arti_title; ?></td>
                                <td class="text-center"><?= $atribuicao->modalidade; ?></td>
                                <td class="text-center"><?= $atribuicao->eixo; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('submissao/download-artigo/'
                                    . 'sem-identificacao/'.$atribuicao->subm_cd); ?>" >Sem identificação</a>
                                    <br> 
                                   <a href="<?= base_url('submissao/download-artigo/'
                                    . 'com-identificacao/'.$atribuicao->subm_cd); ?>">Com identificação</a>
                                </td>
                                <td class="text-center">
                                <div class="text-left" style="display: inline-block">
                                      <a href="<?= base_url('artigo/alterar/'.$atribuicao->arti_cd); ?>" class="btn-opcao" >
                                      <span class="fa fa-pencil-square-o"></span>&#09;Editar dados do Trabalho</a><br>
                                      <a href="#" class="btn-opcao atribuicao"  
                                      idsubmissao="<?= $atribuicao->subm_cd; ?>"
                                      idmodalidade="<?= $atribuicao->arti_moda_cd; ?>" ideixo="<?= $atribuicao->arti_eite_cd; ?>"
                                      data-toggle="modal" data-target="#atribuirRevisor" >
                                      <span class="fa fa-user-plus"></span>&#09;Atribuir Revisor</a><br>
                                      <a href="<?= base_url('revisao/emitir-parecer-final/'.$atribuicao->subm_cd); ?>" class="btn-opcao">
                                      <span class="fa fa-gavel"></span>&#09;Emitir parecer final</a><br>
                                      <a href="<?= base_url('artigo/detalhes-do-trabalho/'.$atribuicao->arti_cd); ?>" class="btn-opcao">
                                      <span class="fa fa-eye"></span>&#09;Detalhar</a><br>
                                </div>
                                </td>
                            </tr>
                        <?php endforeach;}else{ ?>
                          <tr>
                            <td class="col-xs-12 text-center" colspan="5">Não foram encontrados resultados para a sua busca...</td>
                          </tr>
                        <?php } ?> 
                    </tbody>
                </table>
            </div><!-- /TABELA-->
                <?php if(!empty($atribuicoes)):?>
                <div class="text-center">
                Exibindo de 1 a <?php echo !empty($atribuicoes) ? sizeof($atribuicoes) : 0; ?> de um total de <?php echo !empty($atribuicoes) ? $totalRegistros : 0; ?> submissões
                </div>
                <?php endif; ?>

        </div>
    </div>
          <!-- Modal -->

          <div id="atribuirRevisor" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title"><span class="fa fa-user-plus"> Atribuir Revisor</h4>
                      </div>
                      <form id="form-atribuicao" action="" method="POST">
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 mensagem" style="display:none">
                              <div class="alert alert-warning"> 
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <h4><b><span class="glyphicon glyphicon-alert"></span> Atenção</b></h4>
                                Não há revisores com a mesma modalidade e eixo temático deste trabalho!
                              </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group controls">
                                <div class="painel-atribuicao" style="display:none">
                                <input type="hidden" name="submissao" id="input-submissao">
                                  <b><?php echo form_label( 'Selecionar revisor por nome', 'revisor' ); ?></b><br>
                                      <select name="revisores[]" class="form-control estilo-input consultaRevisoresAtribuicao">
                                      </select>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Atribuir Revisor</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
</div>
