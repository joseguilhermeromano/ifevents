<h3>Artigos</h3>

				<?php foreach( $result as $itens ):?>			
					<strong>Autor:</strong>       <?php echo $itens->arti_autor."<br>";?>
 				 				 								        
 					<strong>Título:</strong>      <?php echo $itens->arti_titul."<br>";?>
 						                            
 				  <strong>Instituição:</strong>	<?php echo $itens->arti_inst."<br>";?>
 				 				                        
 				  <strong>Orientador:</strong>  <?php echo $itens->arti_ori."<br>";?>					

 				  <strong>Área:</strong>        <?php echo $itens->arti_are."<br>";?>
  			 
          <strong>Artigo:</strong>      <?php  echo anchor('DataControl/VerificaArtigo', $itens->arti_subm);?><br>
            				
          <strong>Resumo:</strong>      <?php echo $itens->arti_res."<br>";?> 				
  			  			                                
  				<strong>Apoio:</strong>       <?php echo $itens->arti_apoio."<br>";?> 

         <?php endforeach; ?> 

        
         