<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

require_once 'PrincipalControl.php';

class LoginControl extends PrincipalControl{
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();
                    
                    /*Carregamento de Models*/
                    $this->load->model('UsuarioModel');
                    $this->load->model('dao/UsuarioDAO');
                    $this->load->model('dao/EdicaoDAO');
                     
            }
            
            public function entrar(){
                $usuario = $this->UsuarioDAO->consultarLogin($this->input->post('email'), $this->input->post('senha'));
                $this->session->set_userdata('usuario',$usuario);
                if($usuario!=null){
                    if($this->session->userdata('link_anterior')){
                        redirect($this->session->userdata('link_anterior'));
                    }
                    if($usuario->user_tipo == 3){
                        $eventosRecentes = $this->EdicaoDAO->consultarTudo(null,5);
                        $this->session->set_userdata('eventos_recentes', $eventosRecentes);
                        $this->session->set_userdata('evento_selecionado',$eventosRecentes[0]);
                        redirect('usuario/inicioOrganizador');
                    }
                    else if($usuario->user_tipo == 2){
                        redirect('usuario/inicioAvaliador');
                    }	
                    else{
                        redirect('usuario/inicioParticipante');
                    }
                }else{
                    $this->session->set_flashdata("error","E-mail ou senha incorretos!");
                    redirect('login');
                }
            }
            
            public function sair(){
                $this->session->sess_destroy();
                redirect('index');
            }
            
            public function esqueceuSenha(){
                
            }
            
            
            
    }

