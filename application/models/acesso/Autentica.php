<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autentica extends CI_Model{

    private $permissaoView = 'login'; // Recebe o nome da view correspondente 
    //à página informativa de usuário sem   permissão de acesso
    private $loginView = 'login'; // Recebe o nome da view correspondente à tela de login

    public function __construct(){  
        parent::__construct('Autentica');
            $this->load->database();
            $classe = $this->router->fetch_class();
            $metodo = $this->router->fetch_method();
            $this->Check($classe,$metodo);
        }

    private function consultaClasseMetodo($classe, $metodo){
        /*
        * Pesquisa a classe e o método passados como parâmetro
        */
        $array = array('meto_classe' => $classe, 'meto_metodo' => $metodo);
        $qryMetodos = $this->db->where($array)->get('metodo');            
        $resultMetodos = $qryMetodos->result_object()[0];
        return $resultMetodos;
    }

    private function insereClasseMetodo($classe, $metodo){
        $data = array(
            'meto_classe' => $classe,
            'meto_metodo' => $metodo,
            'meto_identificacao' => $classe .  '/' . $metodo,
            'meto_privado' => 1
        );
        $this->db->insert( 'metodo', $data );                
        redirect( base_url( $classe . '/' . $metodo ), 'refresh' );
    }

    private function usuarioLogado(){
        $usuario = $this->session->userdata("usuario");
        if($usuario!== null){
            return true;
        }
        return false;
    }

    private function verificaPermissaoParaMetodoClasse($codigoMetodo){
        $tipo_usuario = $this->session->userdata("usuario")->user_tipo;
        $array = array('perm_meto_cd' => $codigoMetodo, 'perm_tius_cd' => $tipo_usuario);
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
            $this->session->set_flashdata('error', 'Você não tem permissão para acessar esta página!');
            return redirect($this->permissaoView,"refresh");
        }
        
        $linkAnterior = $this->session->userdata('linkAnterior');
        $this->session->set_userdata('linkAnterior', null);
         
        if($linkAnterior){
            return redirect($linkAnterior);
        }
        
        return;
    }

    private function atribuiPermissaoClasseMetodoAUsuario($consulta){ 
         $codigo = $consulta->meto_cd;
         $tipo_usuario = $this->session->userdata("usuario")->user_tipo;
         $array = array('perm_tius_cd' => $tipo_usuario, 'perm_meto_cd' => $codigo);
         $qryMetodos = $this->db->where($array)->get('permissao');            
         $resultMetodos = $qryMetodos->result();

        if( count( $resultMetodos ) == 0 ){
             $data = array(
                 'perm_tius_cd' => $tipo_usuario
                 ,'perm_meto_cd' => $codigo
             );
             $this->db->insert( 'permissao', $data );                
        }
        $linkAnterior = $this->session->userdata('linkAnterior');
        $this->session->set_userdata('linkAnterior', null);
        if($linkAnterior){
            return redirect($linkAnterior);
        }
        
        return;
    }
    
    private function verificaLinkSalvo($consulta){
        $classeAnterior = $this->session->userdata('classe_linkAnterior');
        $metodoAnterior = $this->session->userdata('metodo_linkAnterior');
        
        if(empty($classeAnterior) && empty($metodoAnterior)){
           return $consulta;
        }
        
        return $this->consultaClasseMetodo($classeAnterior, $metodoAnterior);
    }

    public function Check( $classe, $metodo ){
        
        $consulta = $this->consultaClasseMetodo($classe, $metodo);

        if( empty($consulta) ){
            $this->insereClasseMetodo($classe, $metodo);
        }

        /*
        * Se o método ja existir na tabela, então recupera se ele é público ou privado
        * O método sendo público (0), então não verifica o login e libera o acesso
        * Mas se for privado (1) então é verificado o login e a permissão do usuário
        */

        if( $consulta->meto_privado == 0 ){
            return;
        }

        /*
        * Se o usuário estiver logado faz a verificação da permissão
        * caso contrário redireciona para uma tela de login
        */
        if($this->usuarioLogado() == true){
            $consulta = $this->verificaLinkSalvo($consulta);
            return $this->atribuiPermissaoClasseMetodoAUsuario($consulta);
            //return $this->verificaPermissaoParaMetodoClasse($consulta->meto_cd);
        }

        $this->session->set_flashdata('error', 'Você precisa estar logado para acessar esta página!');
        $this->session->set_userdata('classe_linkAnterior', $classe);
        $this->session->set_userdata('metodo_linkAnterior', $metodo);
        $this->session->set_userdata('linkAnterior', $this->uri->uri_string());
        
        return redirect($this->loginView,"refresh");
    }
}