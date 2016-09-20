<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class SubmitDAO extends CI_Model{

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
		           
			 	$confirm = $this->db->insert('Artigo', $this);
				
				if($confirm){
                    echo $total;    
					$this->session->set_flashdata('success', 'Artigo Enviado Com Sucesso');		
					redirect('DataControl/sucesso');		
				}
				else{
					$this->session->set_flashdata('empty', 'Os dados não puderam ser Inseridos.');
					redirect( 'InicioControl/formSubmit' );
				}		
		} 

        //Método realiza consulta na tabela Artigo e retorna resultado
		public function Consulta(){
    		
    		$content = $this->db->query('SELECT arti_id, arti_autor, arti_ra, arti_nm, arti_titul, arti_inst, arti_ori, arti_are, arti_subm, arti_res, arti_apoio FROM Artigo');
    		
        	return $content->result();
        	      
    	}

        //Método realiza consulta e faz download
    	public function DownArtigo(){
    		$this->load->helper('download');
            $arq = $this->uri->segment(3);                
    		$download = $this->db->query('SELECT arti_subm FROM Artigo WHERE arti_id ='.$arq);
    		
                if($download->num_rows() > 0){
                    $row  = $download->row();
                    $file = FCPATH . 'upload/'. $row->arti_subm;
                    if(file_exists($file)){
                        force_download($file, NULL);
                    }
                }
                else
                    $this->session->set_flashdata('NotDown', 'Esse arquivo não exite!!!');
                    redirect('DataControl/erros');
            
    		}
    	}

//}		



      
