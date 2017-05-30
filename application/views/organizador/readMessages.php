<h2><b> Mensagens</b></h2>
<hr>
<div class="error"><?php echo validation_errors(); ?></div>
<br>

<div class="row">
		<div class="panel panel-default">
  			<div class="panel-heading"><?php echo '<strong>Usuário:  </strong>'.$content->cont_nm.'<br><strong>Assunto:  </strong>'.$content->cont_assunto;?></div>
  			<div class="panel-body">
				<div class="container-fluid">
    				<?php echo $content->cont_msg;?>
			    </div>
  			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			 <a class="btn btn-default hidden-xs" href='<?php echo site_url('/usuario/notificaUsers/'.$content->cont_cd); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Responder</a>
		</div>
</div>
