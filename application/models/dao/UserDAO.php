<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

    include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class UserDAO extends CI_Model implements DAO{

        public function __construct(){
                parent::__construct('UserDAO');
        }

        public function cadastrar( $nome, $instituicao, $fone, $email, $pass, $tipo, $valida, $status ){

                $this->user_nm        = $nome;
                $this->user_ins_emp   = $instituicao;
                $this->user_fone      = $fone;			
                $this->user_email     = $email;
                $this->user_pass      = $pass;
            $this->user_tipo      = $tipo;
                $this->user_val_email = $valida;
                $this->user_status    = $status;

                $confirm = $this->db->insert('User', $this);

                if($confirm){  
                        $this->session->set_flashdata('success', 'Cadastro Realizado Com Sucesso');		
                        redirect('cadastro');		
                }
                else{
                        $this->session->set_flashdata('fail', 'O Cadastro Não Pode Ser Realizado');
                        redirect( 'cadastro' );
                }
        }

                public function inserir($obj) {
                    return $this->db->insert('user', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('user_id', $obj->user_id);
                    return $this->db->update('user', $obj);
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo($codigo){
                    $this->db->where('user_id',$codigo);
                    $query = $this->db->get('User');
                    return $query->result_array();
                }
                
                public function consultarLogin($obj){
                        $this->db->where('user_email', $obj->user_email);
			$this->db->where('user_pass', $obj->user_pass);
			$this->db->where('user_status', 1);
                        $query = $this->db->get('User');
                        return $query->result_array();
                }

                public function excluir($obj) {
                    $this->db->where('user_id', $obj->user_id);
                    return $this->db->delete('user');
                }

}