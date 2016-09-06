<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class SubmitModel extends CI_Model{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/SubmitDAO');
			$this->load->model('dao/DataBaseDAO');

			$this->DataBaseDAO->create_table_avaliacao();
			$this->DataBaseDAO->create_table_avaliador();
			$this->DataBaseDAO->create_table_participante();			
			$this->DataBaseDAO->create_table_Submissao();
			$this->DataBaseDAO->create_table_users();

		}


		//Método configura propriedades do arquivo e faz o upload 
		public function upload_arquivo(){

			$config['upload_path'] 	 = 'arquivos/documents';
			$config['allowed_types'] = 'pdf|doc|docx|txt';
			$config['max_size']      = '0';
			$config['encrypt_name']  = 'true';
			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload( 'subm_artigo' )){
				$this->session->set_flashdata( 'subm_artigo', 'O arquivo não pode ser enviado. Verifique se o arquivo foi selecionado ou se a extensão é ".pdf"  ou  ".docx"' );
				redirect('DataControl/erros');
				//exit();
			}
			else{
				//echo 'passou aqui';
				$data  = array('upload_data' => $this->upload->data());
				return $data['upload_data']['file_name'];	
								
			}
		}

		

		//Função faz a validação dos campos e chama a função cadastrar na model submitDAO
		public function Verifica(){			
			
			$this->form_validation->set_rules( 'subm_ra', 'RA', 'trim|required|max_length[7]' );
			$this->form_validation->set_rules( 'subm_titulo','Título', 'trim|required|max_length[50]|ucwords' );		
			$this->form_validation->set_rules( 'subm_autor', 'Autor(es)', 'trim|required|max_length[50]|ucwords' );
			$this->form_validation->set_rules( 'subm_instituicao', 'Instituição', 'trim|required|max_length[50]|ucwords' );
			$this->form_validation->set_rules( 'subm_resumo', 'Resumo', 'trim|required|max_length[100]' );
			$this->form_validation->set_rules( 'subm_area', 'Área', 'trim|required|max_length[50]|ucwords' );			
			$this->form_validation->set_rules( 'subm_orientador', 'Orientedor', 'trim|required|max_length[50]|ucwords' );
			$this->form_validation->set_rules( 'subm_apoio', 'Patrocínio', 'trim|max_length[50]|ucwords' );

			
			if( $this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('empty', 'Por Favor Preencha Todos Os Campos Marcados Com *');
				redirect( 'InicioControl/formSubmit' );
				//redirect('DataControl');
			}
			else{

				$ra 		 = $this->input->post( 'subm_ra' );
				$titulo 	 = $this->input->post( 'subm_titulo' );
				$autor 		 = $this->input->post( 'subm_autor' );
				$instituicao = $this->input->post( 'subm_instituicao' );
				$resumo 	 = $this->input->post( 'subm_resumo' );
				$area 		 = $this->input->post( 'subm_area' );
				$orientador  = $this->input->post( 'subm_orientador' );
				$apoio 		 = $this->input->post( 'subm_apoio' );
				$artigo 	 = $this->upload_arquivo();

				$this->SubmitDAO->Cadastrar( $ra, $titulo, $autor, $instituicao, $resumo, $area, $orientador, $apoio, $artigo );
				
				}
			}			
			
		}										 			

