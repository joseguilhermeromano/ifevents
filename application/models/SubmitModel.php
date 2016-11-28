<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

        include_once 'InterfaceModel.php';
        
	class SubmitModel extends CI_Model implements InterfaceModel{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/SubmitDAO');
                        $this->load->library('upload');
                        $this->load->helper('file');
		}

		
                /*public function BaixaArtigo(){			
                         $quey = $this->SubmitDAO->DownArtigo();

                        // return $query;
                }*/
                
                private function setaValores(){
                    $this->subm_user_cod=1;
                    $this->subm_arti_cod=1;
                    $this->subm_dt=date("y-m-d");
                    $this->subm_hora=date("H:i");
                    $this->subm_arq1=$this->upload_arquivo();
                    $this->subm_status=0;
                }
                
                private function upload_arquivo(){
                    $config['upload_path']   = 'upload';
                    $config['allowed_types'] = 'pdf|docx';
                    $config['max_size']      = '4096';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if(!$this->upload->do_upload()){
                            $this->session->set_flashdata( 'error', 'O arquivo não pode ser enviado. Verifique se o arquivo foi selecionado ou se a extensão é ".pdf"  ou  ".docx"' );
                            redirect('participante/novoartigo');
                    }
                    else{
                            $data  = array('upload_data' => $this->upload->data());
                            $file=read_file($data['upload_data']['full_path']);
                            unlink($data['upload_data']['full_path']);

                    }
                    return $file;
                }
                        
                public function cadastrar() {
                    if($this->upload_arquivo()!=null){
                        $this->setaValores();
                        if($this->SubmitDAO->inserir($this)==true){
                            $this->session->set_flashdata( 'success', 'A Submissão foi realizada com sucesso!' );
                        }else{
                            $this->session->set_flashdata( 'error', 'Não foi possível realizar a submissão!' );
                        }
                    }else{
                        $this->session->set_flashdata( 'error', 'O arquivo não foi selecionado!' );
                    }
                }

                public function alterar() {
                    return true;
                }

                public function buscar() {
                    $codigo=$this->input->get('codigo');
                    return $this->SubmitDAO->consultarCodigo($codigo);
                }

                public function buscarTudo() {
                    return null;
                }

                public function excluir() {
                    return true;
                }
}										 			

