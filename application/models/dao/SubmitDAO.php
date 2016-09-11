<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class SubmitDAO extends CI_Model{

		function SubmitDAO(){
			parent::__construct( 'SubmitDAO' );
			
		}


		//Função insere dados na tabela Submissao do banco de dados
		public function Cadastrar( $titulo, $autor, $instituicao, $resumo, $area, $orientador, $apoio, $artigo ){
						            
           // $this->subm_ra     		= $ra;
            $this->arti_titul 		= $titulo;
            $this->arti_autor  		= $autor;            
			$this->arti_inst        = $instituicao;			
			$this->arti_res         = $resumo;			
			$this->arti_are         = $area;
			$this->arti_ori         = $orientador;
			$this->arti_apoio       = $apoio;						
			$this->arti_subm        = $artigo;
			           
			 	$confirm = $this->db->insert( 'Artigo', $this );
				
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
    		$download = $this->db->query('SELECT * FROM Artigo');
    		foreach ($download->result() as $itens) {    		    		
    			$diretorio = file_get_contents('arquivos/documents/'.$itens->arti_subm);         
            	$arquivo = $itens->arti_subm; 
            	force_download($diretorio, null );
        	}
        	return $download->result();
        	      
    	}     


    	/*public function DownArtigo(){

    		$this->load->helper('download');
    		$download = $this->db->query('SELECT arti_subm FROM Artigo');
    		//foreach ($download->result() as $itens) {    		    		
    		//$diretorio = file_get_contents('arquivos/documents/'.$itens->arti_subm);         
            //$arquivo = $itens->arti_subm;  
        	return $download->result();      
    	} */
}

		



      
