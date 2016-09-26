<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class SubmitModel extends CI_Model{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/SubmitDAO');
			$this->load->model('dao/DataBaseDAO');
			$this->load->model('dao/Teste');
			$this->load->library('upload');

			
			$this->DataBaseDAO->create_table_avaliacao();
			$this->DataBaseDAO->create_table_avaliador();
			$this->DataBaseDAO->create_table_login();			
			$this->DataBaseDAO->create_table_artigo();
			$this->DataBaseDAO->create_table_user();

		}


		//Método configura propriedades do arquivo e faz o upload 
		public function upload_arquivo(){
				
			$config['upload_path'] = 'arquivos';
			$config['allowed_types'] = 'pdf|doc|docx|txt|jpg|rar';
			$config['max_size'] = '2048';			

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if(!$this->upload->do_upload()){

				$this->session->set_flashdata( 'subm_artigo', 'O arquivo não pode ser enviado. Verifique se o arquivo foi selecionado ou se a extensão é ".pdf"  ou  ".docx"' );
				redirect('participante/novoartigo');
				
			}
			else{
				
				$data  = array('upload_data' => $this->upload->data());
				return $data['upload_data']['file_name'];	
								
			}
		}

		

		//Método faz a validação dos campos e chama o método cadastrar na model submitDAO
		public function Verifica(){			
			
			$this->form_validation->set_rules( 'ra', 'RA', 'trim|required|max_length[7]' );			
			$this->form_validation->set_rules( 'titulo','Título', 'trim|required|max_length[50]|ucwords' );		
			$this->form_validation->set_rules( 'autor', 'Autor(es)', 'trim|required|max_length[50]|ucwords' );
			$this->form_validation->set_rules( 'instituicao', 'Instituição', 'trim|required|max_length[50]|ucwords' );
			$this->form_validation->set_rules( 'resumo', 'Resumo', 'trim|required|max_length[100]' );
			$this->form_validation->set_rules( 'area', 'Área', 'trim|required|max_length[50]|ucwords' );		
			$this->form_validation->set_rules( 'orientador', 'Orientedor', 'trim|required|max_length[50]|ucwords' );
			$this->form_validation->set_rules( 'apoio', 'Patrocínio', 'trim|max_length[50]|ucwords' );
			
			if( $this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('empty', 'Por Favor Preencha Todos Os Campos Marcados Com *');
				redirect( 'ParticipanteControl/novoartigo' );
				
			}
			else{

				$ra 		 = $this->input->post( 'ra' );
				$nome        = $_FILES['userfile']['name'];
				$titulo 	 = $this->input->post( 'titulo' );
				$autor 		 = $this->input->post( 'autor' );
				$instituicao = $this->input->post( 'instituicao' );
				$resumo 	 = $this->input->post( 'resumo' );
				$area 		 = $this->input->post( 'area' );
				$orientador  = $this->input->post( 'orientador' );
				$apoio 		 = $this->input->post( 'apoio' );
				$artigo 	 = $this->upload_arquivo($data);

				$this->SubmitDAO->Cadastrar( $ra, $nome, $titulo, $autor, $instituicao, $resumo, $area, $orientador, $apoio, $artigo );
				
				}
			}	

			
			
			/*public function BaixaArtigo(){			
				 $quey = $this->SubmitDAO->DownArtigo();

				// return $query;
			}*/	
}										 			

