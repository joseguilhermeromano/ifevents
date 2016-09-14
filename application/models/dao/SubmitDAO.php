<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class SubmitDAO extends CI_Model{

		function SubmitDAO(){
			parent::__construct('SubmitDAO');
			$this->load->library('upload');
			
		}


		//Função insere dados na tabela Submissao do banco de dados
		public function Cadastrar($ra, $titulo, $autor, $instituicao, $resumo, $area, $orientador, $apoio, $artigo){
						            
           	$this->arti_ra     		= $ra;
            $this->arti_titul 		= $titulo;
            $this->arti_autor  		= $autor;            
			$this->arti_inst        = $instituicao;			
			$this->arti_res         = $resumo;			
			$this->arti_are         = $area;
			$this->arti_ori         = $orientador;
			$this->arti_apoio       = $apoio;						
			$this->arti_subm        = $artigo;

		           
			 	$confirm = $this->db->insert('Artigo', $this);
				
				if($confirm){
					$this->session->set_flashdata('success', 'Artigo Enviado Com Sucesso');		
					redirect('DataControl/sucesso');		
				}
				else{
					$this->session->set_flashdata('empty', 'Os dados não puderam ser Inseridos.');
					redirect( 'InicioControl/formSubmit' );
				}		
		} 




		public function Consulta(){

		


    		$this->load->helper('download');
    		$download = $this->db->query('SELECT arti_id, arti_autor, arti_ra, arti_titul, arti_inst, arti_ori, arti_are, arti_subm, arti_res, arti_apoio FROM Artigo');
    		/*foreach ($download->result() as $itens) {  
    				header("Content-type: application/pdf");
					//header('Content-Disposition: attachment; filename='.$itens->arti_subm);
					header('Pragma: private');
					header('Cache-control: private, must-revalidate');





    			$folder = $itens->arti_subm;
    			$artigo = $itens->arti_subm;
 	   			$autor = $itens->arti_autor;
    			$titulo = $itens->arti_titul;
    			$instituicao = $itens->arti_inst;
    			$orientador = $itens->arti_ori;
    			$area = $itens->arti_are;
    			$resumo = $itens->arti_res;
    			$apoio = $itens->arti_apoio;
 
    			//$dados = file_get_contents($);
    			//$arq = fopen($itens->arti_subm, "r");
    			//$path  = 'arquivo/documents/'.$arquivo;				
				//$pathDownload = 'Download/'.$path.'/'.$arquivo;
				//$data[ 'urlDownload' ] = base_url( $pathDownload );		

    			//$arq = file_get_contents($itens->arti_subm);
    			//$arquivo = $itens->arti_subm;
    			//$diretorio = $this->uri->segment(2).'/'.$arquivo;//file_get_contents( 'arquivos/documents'.$arquivo );                     	 
            	//force_download($artigo);
        	}*/
        	return $download->result();
        	      
    	}     


    	public function DownArtigo(){
    		$this->load->helper('download');
    		$arq = $this->uri->segment(3);
    		$download = $this->db->query('SELECT arti_subm FROM Artigo WHERE arti_id ='.$arq);
    		header("Content-type: application/pdf");
    		header('Content-Transfer-Encoding: binary');

    		foreach ($download->result() as $itens) {    

    			//header("Content-type: application/pdf");
    			header('Content-Disposition: attachment; filename='.$itens->arti_subm);	
    			header('Pragma: private');
				header('Cache-control: private, must-revalidate');	    		
    			
    			//$diretorio = file_get_contents($itens->arti_subm);         
            	$arquivo = $itens->arti_subm;  

            	force_download($arquivo, $download->result());
        	//return $download->result();      
    		}
    	}

}		



      
