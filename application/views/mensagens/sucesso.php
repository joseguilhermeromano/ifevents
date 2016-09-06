

<?php 
	if ($this->session->flashdata('success')) { ?>
    	<div class="alert alert-info"> 
    	    <?= $this->session->flashdata('success') ?> 
	    </div>
<?php } ?>
