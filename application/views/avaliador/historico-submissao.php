<h2><span class="glyphicon glyphicon-list"></span><b> Histórico da Submissão</b></h2>
<hr>
<br>
<div class="row">
<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading"><b>Detalhes da Submissão</b></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tbody>
                            <?php foreach ($result as $iten): ?>    

                            <?php endforeach ?>                    
                                
                            <tr>
                                <th class="col-xs-4">Título</th>
                                <td><?php echo $iten->arti_titul; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Orientador</th>
                                <td><?php echo $iten->arti_ori; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Instituição</th>
                                <td><?php echo $iten->arti_inst; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Eixo Temático</th>
                                <td><?php echo $iten->arti_are; ?></td>
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
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
<div class="panel panel-success">
    <div class="panel-heading"><b>Submissão e Ajustes</b></div>
  <div class="panel-body">
        <table class="table">
            <thead>
                <th colspan="2" class="text-center">Versão: 1</th>
            </thead>
            <tbody>
                <tr>
                    <th class="col-xs-2">Data</th>
                    <td>07/10/206</td>
                </tr>
                <tr>
                    <th class="col-xs-2">Arquivos</th>
                    <td><a href="#">exemplo-1.pdf</a>, <a href="#">exemplo-2.pdf</a></td>
                </tr>
                <tr>
                    <th class="col-xs-2">Status</th>
                    <td>Avaliado</td>
                </tr>
            </tbody>
        </table>
        
  </div>
</div>
</div>
<div class="col-md-6">
<div class="panel panel-danger">
    <div class="panel-heading"><b>Avaliações</b> 
        <a href="#" style="float:right; color: #000;"><span class="glyphicon glyphicon-plus"></span> Nova Avaliação</a>
    </div>
  <div class="panel-body">
        <table class="table">
            <thead>
                <th colspan="2" class="text-center">Versão Avaliada: 1</th>
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

