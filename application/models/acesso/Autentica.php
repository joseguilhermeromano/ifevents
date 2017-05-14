<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Autentica extends CI_Model{
                
        private $permissaoView = 'login'; // Recebe o nome da view correspondente à página informativa de usuário sem   permissão de acesso
        private $loginView = 'login'; // Recebe o nome da view correspondente à tela de login
        
        public function __construct(){  
            parent::__construct('Autentica');
                $this->load->database();
                $this->Check($this->router->fetch_class(),$this->router->fetch_method());
            }

        public function Check( $classe, $metodo ){
            
            /*
            * Pesquisa a classe e o método passados como parâmetro
            */
            $array = array('meto_classe' => $classe, 'meto_metodo' => $metodo);
            $qryMetodos = $this->db->where($array)->get('metodo');            
            $resultMetodos = $qryMetodos->result();
            
            /*
            * Caso o método passado ainda não conste na tabela "metodos"
            * ele é inserido
            */
    
            if( count( $resultMetodos ) == 0 ){
                $data = array(
                    'meto_classe' => $classe,
                    'meto_metodo' => $metodo,
                    'meto_identificacao' => $classe .  '/' . $metodo,
                    'meto_privado' => 1
                );
                $this->db->insert( 'metodo', $data );                
                redirect( base_url( $classe . '/' . $metodo ), 'refresh' );
            }
            else{
                /*
                * Se o método ja existir na tabela, então recupera se ele é público ou privado
                * O método sendo público (0), então não verifica o login e libera o acesso
                * Mas se for privado (1) então é verificado o login e a permissão do usuário
                */
               
                if( $resultMetodos[0]->meto_privado == 0 ){
                    return false;
                }
                else{

                    $nome       = null;
                    $logged_in  = null;
                    $email      = null;
                    $tipo_usuario = null;
                    $cd_metodo  = null;

                    if($this->session->userdata('usuario')[0]){
                        $nome       = $this->session->userdata('usuario')[0]['user_nm'];
                        $logged_in  = $this->session->userdata('usuario')[0];
                        $email      = $this->session->userdata('usuario')[0]['email_email'];
                        $tipo_usuario = $this->session->userdata('usuario')[0]['user_tipo'];
                        $cd_metodo  = $resultMetodos[0]->meto_cd;

                        $array = array('meto_classe' => $classe, 'meto_metodo' => $metodo);
                        $qryMetodos = $this->db->where($array)->get('metodo');            
                        $codigo = $qryMetodos->result()[0]->meto_cd;

                        $array = array('perm_tius_cd' => $tipo_usuario, 'perm_meto_cd' => $codigo);
                        $qryMetodos = $this->db->where($array)->get('permissao');            
                        $resultMetodos = $qryMetodos->result();

                        if( count( $resultMetodos ) == 0 ){
                            $data = array(
                                'perm_tius_cd' => $tipo_usuario
                                ,'perm_meto_cd' => $codigo
                            );
                            $this->db->insert( 'permissao', $data );                
                            redirect( base_url( $classe . '/' . $metodo ), 'refresh' );
                        }

                    }
                
                    /*
                    * Se o usuário estiver logado faz a verificação da permissão
                    * caso contrário redireciona para uma tela de login
                    */
                    if( $nome && $logged_in && $tipo_usuario ){
                        $array = array('perm_meto_cd' => $cd_metodo, 'perm_tius_cd' => $tipo_usuario);
                        $qryPermissoes = $this->db->where($array)->get('permissao');                        
                        $resultPermissoes = $qryPermissoes->result();
                
                        /*
                        * Se o usuário não tiver a permissão para acessar o método,
                        * ou seja, não estiver relacionado na tabela "permissoes",
                        * ele deve ser redirecionado para uma tela informando que
                        * não tem permissão de acesso;
                        * caso contrário o acesso é liberado
                        */
          
                        if( count( $resultPermissoes ) == 0 ){
                            $this->session->set_userdata('link_anterior', $this->uri->uri_string());
                            $this->session->set_flashdata('error', 'Você não tem permissão para acessar esta página!');
                            return redirect($this->permissaoView,"refresh");
                        }
                        else{
                            return true;
                        }
                    }
                    else{
                     $this->session->set_userdata('link_anterior', $this->uri->uri_string());
                     $this->session->set_flashdata('error', 'Você precisa estar logado para acessar esta página!'); 
                     return redirect($this->loginView,"refresh");
                    }
                }
            }
        }
    }