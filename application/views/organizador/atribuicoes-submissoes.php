<div class="container-fluid">
<h2><span class="fa fa-list"></span><b> Atribuição de Submissões</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>

<div class="row">
  <div class="col-md-12">
  <form method="GET" action="<?php echo base_url('revisao/consultar-atribuicoes'); ?>">
    <div class="row">
        <div class="col-sm-4">
           <div class="input-group">
                 <input type="text" name="busca" class="form-control estilo-botao-busca" 
                 placeholder="Buscar...">
                 <span class="input-group-btn">
                     <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                 </span>
           </div><!-- /input-group -->
         </div><!-- /.col-lg-6 -->
    </div><!-- /row -->
  </form><br><br>
  </div>
</div>
<form method="POST" id="form_atribuicoes" action="<?php echo base_url('artigo/listar-atribuicoes'); ?>">

<div class="row">
    <div class="col-sm-12 mensagem" style="display:none">
      <div class="alert alert-warning"> 
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <h4><b><span class="glyphicon glyphicon-alert"></span> Atenção</b></h4>
        Não há revisores com as mesmas modalidades e eixos temáticos dos trabalhos selecionados!
      </div>
    </div>
    <div class="painel-atribuicao" style="display:none">
    <div class="col-sm-4">
        <div class="form-group controls">
          <b><?php echo form_label( 'Selecionar revisor por nome', 'revisor' ); ?></b><br>
              <select name="revisor" class="form-control estilo-input consultaRevisoresAtribuicao">
              <option>teste</option>
              </select>
        </div>
    </div>
    <div class="col-sm-8" style="margin-top:25px">
         <button type="submit" class="btn btn-default margin-button" style="float:left">
         <i class="fa fa-user-plus" aria-hidden="true"></i> Atribuir Revisor</button>
    </div>
    </div>
</div><br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    <th class=""></th>
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
                    <td class="text-center">
                        <input type="checkbox" name="submissoes[]" value="<?= $atribuicao->subm_cd; ?>">
                    </td>
                    <td><?= $atribuicao->arti_title; ?></td>
                    <td class="text-center"><?= $atribuicao->modalidade; ?></td>
                    <td class="text-center"><?= $atribuicao->eixo; ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('artigo/download/1/'.$atribuicao->subm_cd); ?>">Sem identificação</a>
                        <br> 
                        <a href="<?= base_url('artigo/download/2/'.$atribuicao->subm_cd); ?>">Com identificação</a>
                    </td>
                    <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                          <a href="<?= base_url('artigo/detalhes-do-trabalho/'.$atribuicao->arti_cd); ?>" class="btn-opcao">
                          <span class="fa fa-eye"></span>&#09;Detalhar</a><br>
                    </div>
                    </td>
                </tr>
            <?php endforeach;}else{ ?>
              <tr>
                <td class="col-xs-12 text-center" colspan="6">Não foram encontrados resultados para a sua busca...</td>
              </tr>
            <?php } ?> 
        </tbody>
    </table>
</div><!-- /TABELA-->
    <div class="text-center">
    Exibindo de 1 a <?php echo !empty($atribuicoes) ? sizeof($atribuicoes) : 0; ?> de um total de <?php echo !empty($atribuicoes) ? $totalRegistros : 0; ?> submissões
    </div>
</div>
</div>
</form>

</div>
