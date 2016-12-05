<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

        include_once 'InterfaceModel.php';
        
	class SubmitModel extends CI_Model implements InterfaceModel{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/SubmitDAO');
                        $this->load->library('upload');
                        $this->load->helper('file');
                        $this->load->helper('download');
		}
                
                private function setaValores(){
                    $this->subm_user_cod=1;
                    $this->subm_dt=date("y-m-d");
                    $this->subm_hora=date("H:i");
                    $this->subm_arq1=$this->upload_arquivo();
                    $this->subm_status=0;
                    $this->subm_arquivo_nm = $_FILES['userfile']['name'];
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
                
                public function download_arquivo(){
                    $codigo = $this->input->get("codigo");                
                    $download = $this->SubmitDAO->consultarCodigo($codigo);
    		
                    if($download->num_rows() > 0){
                        $row  = $download->row();

                        $nome = $row->subm_arquivo_nm;

                        header("Content-type: application/pdf");
                        header('Content-Disposition: attachment; filename="'.$nome.'"');
                        echo $row->subm_arq1;                   
                    }
                    else{
                        $this->session->set_flashdata('error', 'Esse arquivo não exite!!!');
                    }
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
                    
                }
                
                public function buscarPorArtigo(){
                    return $this->SubmitDAO->consultaPorArtigo($this->input->get('codigo'));
                }

                public function buscarTudo() {
                    return null;
                }

                public function excluir() {
                    return true;
                }
}										 			

