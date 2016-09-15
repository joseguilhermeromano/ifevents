<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class SubmitDAO extends CI_Model{

		function SubmitDAO(){
			parent::__construct('SubmitDAO');
			$this->load->library('upload');
			
		}


		//Função insere dados na tabela Submissao do banco de dados
		public function Cadastrar($ra, $nome, $titulo, $autor, $instituicao, $resumo, $area, $orientador, $apoio, $artigo){

          /* // setting the unlimited memory for reading huge pdf
            ini_set('max_execution_time', -1);
            // reading a pdf file
            $file = file_get_contents($artigo);
            $string_array = str_split($file);
            // making a byte array from each character
            $byteArr = array();
            foreach ($string_array as $key=>$val) {
            // reading ascii values fo each character and storing in array
            $byteArr[$key] = ord($val);
            }*/

           /* //uma string de exemplo
            $file = $artigo;
            //criando um array vazio
            $arq = array();

            //pegando o tamanho da string
            $total = strlen($file);
            //fazendo o laco pra percorrer toda string
            for($i = 0; $i < $total; $i++){
            //atribuindo cada caractere à uma posiçao diferente
            //do array
            $arq[] = $file[$i];
            }*/
						            
           	$this->arti_ra     		= $ra;
            $this->arti_nm          = $nome;
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
    		$download = $this->db->query('SELECT arti_id, arti_autor, arti_ra, arti_nm, arti_titul, arti_inst, arti_ori, arti_are, arti_subm, arti_res, arti_apoio FROM Artigo');
    		
        	return $download->result();
        	      
    	}



    	public function DownArtigo(){
    		$this->load->helper('download');
    		$arq = $this->uri->segment(3);
    		$download = $this->db->query('SELECT arti_subm, arti_nm FROM Artigo WHERE arti_id ='.$arq);
    		header("Content-type: application/pdf");
    		header('Content-Transfer-Encoding: binary');

    		/*foreach ($download->result() as $itens) {    

                $result = $download->result();
                
                
                // oppening other pdf file for writing the byte array
                $fp = fopen($itens->arti_subm, 'wb+');
                while(!empty($itens->arti_subm)) {
                // reading the first element of the array and packing it through pack function again
                $byte = array_shift($itens->arti_subm);
                fwrite($fp, pack('c', $byte));
                }
                // closing the file handler
                fclose($fp);                


    			//header("Content-type: application/pdf");
                header("Content-type: application/pdf");
                //header('Content-Transfer-Encoding: binary');
    			header('Content-Disposition: attachment; filename='.$itens->arti_nm);	
    			header('Pragma: private');
				header('Cache-control: private, must-revalidate');	

    			
    			//$diretorio = file_get_contents($itens->arti_subm);         
            	$artigo = $itens->arti_nm;  
                $arquivo = $fp;
            	force_download($artigo, $arquivo);
        	//return $download->result();      
    		}
    	}*/

}		



      
