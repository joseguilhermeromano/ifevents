<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Autentica extends CI_Model{
                
        private $permissaoView = 'sem-permissao'; // Recebe o nome da view correspondente à página informativa de usuário sem   permissão de acesso
        private $loginView = 'login'; // Recebe o nome da view correspondente à tela de login
        
        public function __construct(){  
            parent::__construct('Autentica');
                $this->load->database();
            }

        public function Check( $classe, $metodo ){
            
            /*
            * Pesquisa a classe e o método passados como parâmetro
            */
            $array = array('classe' => $classe, 'metodo' => $metodo);
            $qryMetodos = $this->db->where($array)->get('metodos');            
            $resultMetodos = $qryMetodos->result();
            
            /*
            * Caso o método passado ainda não conste na tabela "metodos"
            * ele é inserido
            */
    
            if( count( $resultMetodos ) == 0 ){
                $data = array(
                    'classe' => $classe,
                    'metodo' => $metodo,
                    'identificacao' => $classe .  '/' . $metodo,
                    'privado' => 1
                );
                $this->db->insert( 'metodos', $data );                
                redirect( base_url( $classe . '/' . $metodo ), 'refresh' );
            }
            else{
                /*
                * Se o método ja existir na tabela, então recupera se ele é público ou privado
                * O método sendo público (0), então não verifica o login e libera o acesso
                * Mas se for privado (1) então é verificado o login e a permissão do usuário
                */
                if( $resultMetodos[0]->privado == 0 ){
                    return false;
                }
                else{
                    $nome       = $this->session->userdata('usuario');
                    $logged_in  = $this->session->userdata('logado');
                    $data       = $this->session->userdata('data');
                    $email      = $this->session->userdata('email');
                    $id_usuario = $this->session->userdata('id');
                    $id_metodo  = $resultMetodos[0]->id;
                
                    /*
                    * Se o usuário estiver logado faz a verificação da permissão
                    * caso contrário redireciona para uma tela de login
                    */
                    if( $nome && $logged_in && $id_usuario ){
                        $array = array('id_metodo' => $id_metodo, 'id_usuario' => $id_usuario);
                        $qryPermissoes = $this->db->where($array)->get('permissoes');                        
                        $resultPermissoes = $qryPermissoes->result();
                
                        /*
                        * Se o usuário não tiver a permissão para acessar o método,
                        * ou seja, não estiver relacionado na tabela "permissoes",
                        * ele deve ser redirecionado para uma tela informando que
                        * não tem permissão de acesso;
                        * caso contrário o acesso é liberado
                        */
          
                        if( count( $resultPermissoes ) == 0 ){
                            redirect( base_url( 'InicioControl/noPermission'), 'refresh'  );
                        }
                        else{
                            return true;
                        }
                    }
                    else{
                     redirect( base_url( 'InicioControl/login'));
                    }
                }
            }
        }
    }