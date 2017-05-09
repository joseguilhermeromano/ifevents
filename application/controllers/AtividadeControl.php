<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class AtividadeControl extends PrincipalControl implements InterfaceControl{

        public function __construct(){
            parent::__construct();
            $this->load->Model( 'dao/AtividadeDAO' );
            $this->load->Model( 'AtividadeModel','atividade' );
            $this->load->Model( 'dao/TipoAtividadeDAO' );

        }

        /**
         * Realiza as validações e chama a dao para persistir os dados no banco
         * @return Não apresenta retorno
         */
        public function cadastrar(){
            $data['atividade'] = $this->TipoAtividadeDAO->consultarTudo();
            $data['title'] = "IFEvents - Atividade - Organizador";

            if (empty($this->atividade->input->post())){
                $this->chamaView("novaatividade", "organizador", $data,  1);
                return true;
            }

            if( $this->atividade->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                $this->atividade->setaValores();
                if($this->AtividadeDAO->inserir($this->atividade)==true){
                    $this->session->set_flashdata('success', 'Atividade cadastrada com sucesso!');
                }else{
                    $this->session->set_flashdata('error', 'Atividade não cadastrada!');
                }

            }

            $this->chamaView("novaatividade", "organizador", $data,  1 );
        }

        /**
         * Alterar um valor existente na base de dados
         * @return Não apresenta retorno
         */
        public function alterar($codigo){
            $data['atividade'] = $this->TipoAtividadeDAO->consultarTudo();
            $data['title']  = "IFEvents - Atualiza Atividade - organizador";
            $data['content'] = $this->AtividadeDAO->consultarCodigo($this->uri->segment(3));

            if(!empty($this->input->post())){
                $this->atividade->setaValores();
                $this->atividade->ativ_cd = $this->uri->segment(3);
                 if( $this->atividade->valida()==false){
                         $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
                 }
                else{
                     if($this->AtividadeDAO->alterar($this->atividade)==true){
                         $this->session->set_flashdata('success', 'O Atividade atualizada com sucesso!');
                         redirect('atividade/consultarTudo/');

                     }else{
                         $this->session->set_flashdata('error', 'Não foi possível atualizar a atividade!');
                     }

                 }

            }

            $this->chamaView("updateAtividade", "organizador", $data, 1);
        }

        /**
         * Chama a dao de exclusão de dados
          * @return Não apresenta retorno
         */

        public function excluir($codigo){
            if( $this->AtividadeDAO->excluir($this->uri->segment(3)) == false){
					$this->session->set_flashdata('error', 'Arquivo não pode ser excluido!');
			}
		   else{
					$this->session->set_flashdata('success', 'Arquivo deletado com sucesso!');
					redirect('atividade/consultarTudo/');
				}
        }

        /**
         * Consulta que pode ser realizada de forma personalizada para cada entidade, trazendo todos ou parte dos registros com ou sem paginação
          * @return Não apresenta retorno
         */
        public function consultarTudo(){
            $data['flag'] = $this->uri->segment(3);
            $data['content'] = $this->AtividadeDAO->consultarTudo();
            $data['title'] = "IFEvents - Atividades - Organizador";
            $this->chamaView("listaatividade", "organizador", $data, 1);
        }

        public function consultar(){

        }

}
