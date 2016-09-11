
<?php if ($this->session->flashdata( 'subm_artigo' )) { ?>
           <div class="alert alert-info"> 
    	         <?= $this->session->flashdata( 'subm_artigo' ) ?> 
	       </div>
<?php } ?>