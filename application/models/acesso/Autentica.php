<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Autentica extends CI_Model{
                
        private $permissaoView = 'noPermission'; // Recebe o nome da view correspondente à página informativa de usuário sem   permissão de acesso
        private $loginView = 'login'; // Recebe o nome da view correspondente à tela de login
        
        public function __construct(){  
            parent::__construct('Autentica');
                $this->load->database();
                $this->Check($this->router->fetch_class(),$this->router->fetch_method());
            }

        public function Check( $classe, $metodo ){
            if($classe=="InicioControl"||$classe=="LoginControl"){
                return true;
            }
            
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
                    $nome       = "teste";
                    $logged_in  = "teste";
                    $email      = "teste";
                    $tipo_usuario = "1";
                    $cd_metodo  = $resultMetodos[0]->meto_cd;
                
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
                            return redirect($this->permissaoView,"refresh");
                        }
                        else{
                            return true;
                        }
                    }
                    else{
                     return redirect($this->loginView,"refresh");
                    }
                }
            }
        }
    }