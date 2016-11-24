<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class SubmitDAO extends CI_Model implements DAO{

		function SubmitDAO(){
			parent::__construct('SubmitDAO');
			$this->load->library('upload');
			
		}


		//Método insere dados na tabela Artigo do banco de dados
		public function Cadastrar($ra, $nome, $titulo, $autor, $instituicao, $resumo, $area, $orientador, $apoio, $artigo){            
						            
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
            //$this->arti_subm_docx
		           
			 	$confirm = $this->db->insert('Artigo', $this);
				
				if($confirm){  
					$this->session->set_flashdata('success', 'Artigo Enviado Com Sucesso');		
					redirect('DataControl/sucesso');		
				}
				else{
					$this->session->set_flashdata('empty', 'Os dados não puderam ser Inseridos.');
					redirect( 'participanteControl/novoarquivo' );
				}		
		} 

        //Método realiza consulta na tabela Artigo e retorna resultado
		public function Consulta(){
    		$arq = $this->uri->segment(3);
            if($arq != ''){
                $content1 = $this->db->query('SELECT arti_id, arti_autor, arti_ra, arti_nm, arti_titul, arti_inst, arti_ori, arti_are, arti_subm, arti_res, arti_apoio FROM Artigo  WHERE arti_id ='.$arq);
                return $content1->result();
            }
            else{
    		    $content2 = $this->db->query('SELECT arti_id, arti_autor, arti_ra, arti_nm, arti_titul, arti_inst, arti_ori, arti_are, arti_subm, arti_res, arti_apoio FROM Artigo');
    		    return $content2->result();
            }
        	
        	      
    	}

        //Método realiza consulta e faz download
    	public function DownArtigo(){
    		$this->load->helper('download');
                $arq = $this->uri->segment(3);                
    		$download = $this->db->query('SELECT arti_subm, arti_nm FROM Artigo WHERE arti_id ='.$arq);
    		
                if($download->num_rows() > 0){
                    $row  = $download->row();

                    $nome = $row->arti_nm;
                   
                    header("Content-type: application/pdf");
                    header('Content-Disposition: attachment; filename="'.$nome.'"');
                    echo $row->arti_subm;                   
                }
                else{
                    $this->session->set_flashdata('NotDown', 'Esse arquivo não exite!!!');
                    redirect('DataControl/erros');
                }
    		}

    public function alterar($obj) {
        
    }

    public function consultar($arrayParametros) {
        
    }

    public function excluir($obj) {
        
    }

    public function inserir($obj) {
        
    }

}    	




      
