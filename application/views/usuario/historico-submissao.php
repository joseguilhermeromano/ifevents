<h2><span class="glyphicon glyphicon-list"></span><b> Histórico de Submissões</b></h2>
<hr>
<br>
<div class="row">
<div class="col-md-12">
    <div class="panel panel-info">
        <!-- Versão para Ceular -->
        <div class="panel-heading visible-xs" id="header_1" 
             onclick="javascript: MostrarEsconderPainel('#Painel_1','#header_1');">
            <b><span class="glyphicon glyphicon-triangle-right"></span> Detalhes da Submissão</b>
        </div>
        <!-- Versão Comum -->
        <div class="panel-heading hidden-xs" id="header_1" >
            <b>Detalhes da Submissão</b>
        </div>
        <div class="panel-body" id="Painel_1">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <?php foreach ($result as $iten): ?>
                        <thead>
                            <th colspan="2" class="text-center">Informações do Artigo</th>
                        </thead>
                        <tbody>
                             
                            <tr>
                                <th class="col-xs-4">Título</th>
                                <td><?php echo $iten->arti_titu; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Autores</th>
                                <td><?php echo $iten->arti_autor; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Orientador</th>
                                <td><?php echo $iten->arti_orie; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Instituição</th>
                                <td><?php echo $iten->arti_inst; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Eixo Temático</th>
                                <td><?php echo $iten->arti_eite; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Modalidade</th>
                                <td><?php echo $iten->arti_moda; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Evento</th>
                                <td>teste</td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Apoio Financeiro</th>
                                <td><?php echo $iten->arti_apoio; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <thead>
                            <th colspan="1" class="text-center">Resumo</th>
                        </thead>
                        <tbody>
                                <tr>
                                    <td><?php echo $iten->arti_resu; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
<div class="panel panel-success">
    <!-- Versão para Celular-->
    <div class="panel-heading visible-xs" id="header_2" 
         onclick="javascript: MostrarEsconderPainel('#Painel_2','#header_2');">
        <b><span class="glyphicon glyphicon-triangle-right"></span> Submissão e Ajustes</b>
    </div>
    <!-- Versão Comum -->
    <div class="panel-heading hidden-xs" id="header_2">
        <b>Submissão e Ajustes</b>
    </div>
    <div class="panel-body" id="Painel_2">
        <br>
        <table class="table">
            <?php foreach ($submissoes as $submissao): ?>
            <thead>
                <th colspan="2" class="text-center">Informações da Submissão</th>
            </thead>
            <tbody>
                <tr>
                    <th class="col-xs-2">Data</th>
                    <td><?php echo date("d/m/Y",  strtotime($submissao->subm_dt)); ?></td>
                </tr>
                <tr>
                    <th class="col-xs-2">Hora</th>
                    <td><?php echo date("h:m",  strtotime($submissao->subm_hora)); ?></td>
                </tr>
                <tr>
                    <th class="col-xs-2">Arquivo</th>
                    <td><?php echo anchor('participante/downloadartigo?codigo='.$submissao->subm_id,$submissao->subm_arquivo_nm);?></td>
                </tr>
                <tr>
                    <th class="col-xs-2">Status</th>
                    <td><?php 
                    switch ($submissao->subm_status){
                        case 0: 
                            echo "Aguardando Avaliação";
                            break;
                        case 1:
                            echo "Ajustes Pendentes";
                            break;
                        case 2:
                            echo "Artigo Aprovado";
                            break;
                        default:
                            echo "Artigo não aprovado!";
                    }
                    
                    ?></td>
                </tr>
            </tbody>
            <?php endforeach ?>
        </table>
        
  </div>
</div>
</div>
<div class="col-md-6">
<div class="panel panel-danger">
    <!-- Versão para Celular-->
    <div class="panel-heading visible-xs" id="header_3" 
         onclick="javascript: MostrarEsconderPainel('#Painel_3','#header_3 b');">
        <b><span class="glyphicon glyphicon-triangle-right"></span> Avaliações</b> 
    </div>
    <!-- Versão Comum -->
    <div class="panel-heading hidden-xs" id="header_3">
        <b>Avaliações</b> 
    </div>
  <div class="panel-body" id="Painel_3">
      <a href="#" style="float:right; color: #000;"><span class="glyphicon glyphicon-plus"></span> Nova Avaliação</a>
        <table class="table">
            <thead>
                <th colspan="2" class="text-center">Informações da Avaliação</th>
            </thead>
            <tbody>
                <tr>
                    <th class="col-xs-2">Data</th>
                    <td>07/10/206</td>
                </tr>
                <tr>
                    <th class="col-xs-2">Resultado</th>
                    <td>Aceito com solicitação de alterações</td>
                </tr>
                <tr>
                    <th class="col-xs-2">Detalhar?</th>
                    <td><a href="<?php echo site_url("avaliador/feedback");?>">Clique Aqui</a></td>
                </tr>
            </tbody>
        </table>
  </div>
</div>
</div>    
</div>

