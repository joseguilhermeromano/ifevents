<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';

class UsuarioControl extends PrincipalControl{

        public function __construct(){
                parent::__construct();

            $this->load->Model( 'dao/UsuarioDAO' );
            $this->load->Model( 'dao/ContatoDAO' );
            $this->load->Model( 'dao/InstituicaoDAO' );
            $this->load->Model('UsuarioModel','usuario');
            $this->load->Model('dao/EdicaoDAO');
            $this->load->Model('InstituicaoModel','instituicao');
        }

        public function consultar() {
            $limite = 10;
            $numPagina =0;
            if(null !== $this->input->get('pagina')){
                $numPagina = $this->input->get('pagina');
            }

            if( $this->input->get('busca') !== null){
                $busca = $this->input->get('busca');
                $array = array('user_nm'=>$busca);
            }else{
                $busca=null;
                $array=null;
            }

            $data['users']=$this->UsuarioDAO->consultarTudo($array, $limite, $numPagina);
            $data['paginacao'] = $this->geraPaginacao($limite, $this->UsuarioDAO->totalRegistros(), 'usuario/consultar/?busca='.$busca);
            $data['totalRegistros'] = $this->UsuarioDAO->totalRegistros();
            $data['title']="IFEvents - Usuários";
            $this->chamaView("usuarios", "organizador", $data, 1);
        }


        public function notificaUsers(){
						$data['content'] = $this->ContatoDAO->consultarCodigo($this->uri->segment(3));
            if (empty($this->input->post())){
                $this->chamaView("notifica-users", "organizador",
                    array("title"=>"IFEvents - Nova Notificação"), 1);
                return true;
            }
            $answer  = (object) array(
                    'resposta' => $this->input->post('tipo'));

            $notificacao = (object) array(
                'tipo_notificacao' => $this->input->post('tipo_notificacao'),
                'emails' => $this->input->post('emails'),
                'assunto' => $this->input->post('assunto'),
                'mensagem' => $this->input->post('mensagem'));
            $this->form_validation->set_rules( 'tipo_notificacao', 'Notificar', 'trim|required|max_length[11]' );
            if($notificacao->tipo_notificacao == 1){
                $this->form_validation->set_rules( 'emails[]', 'Emails', 'valid_emails|trim|required|max_length[100]' );
            }
            $this->form_validation->set_rules( 'assunto', 'Assunto', 'trim|required|max_length[50]' );
            $this->form_validation->set_rules( 'mensagem', 'Mensagem', 'required' );
            $users = null;
            if($notificacao->tipo_notificacao != 1 && $notificacao->tipo_notificacao != -1){
                switch ($notificacao->tipo_notificacao) {
                    case '2':
                        $users = $this->UserDAO->consultarTudo(array('user_tipo' => 1));
                        break;

                    case '3':
                        $users = $this->UserDAO->consultarTudo(array('user_tipo' => 2));
                        break;

                    case '4':
                        $users = $this->UserDAO->consultarTudo(array('user_tipo' => 3));
                        break;

                    default:
                        $users = $this->UserDAO->consultarTudo(null);
                        break;
                }
            }
            if($this->form_validation->run()){
                $test=1;
                $qtd=0;
                if(!empty($notificacao->emails)){
                    $qtd= sizeof($notificacao->emails);
                    foreach ($notificacao->emails as $key => $value) {
                        $test = $this->envia_email($value,$notificacao->assunto, $notificacao->mensagem);
                    }
                }
                if($users != null){
                    $qtd= sizeof($users);
                    foreach ($users as $key => $value) {
                        $test = $this->envia_email($value->email_email, $notificacao->assunto, $notificacao->mensagem);
                    }
                }
                if($test == 0){
                    if($qtd > 1){
                        $mensagem = 'As notificações foram enviados com sucesso!';
                    }else{
                        $mensagem = 'A notificação foi enviada com sucesso!';
						if($answer->resposta == 'resposta'){
							redirect('contato/consultarTudo');
						}
                    }
                    $this->session->set_flashdata('success', $mensagem);
                }else{
                    if($qtd > 1){
                        $mensagem = 'Não foi possível enviar as notificações!';
                    }else{
                        $mensagem = 'Não foi possível enviar a notificação!';
                    }
                    $this->session->set_flashdata('error', $mensagem);
                }
            }
            $data['title']="IFEvents - Nova Notificação";
            $data['notificacao'] = $notificacao;
            $this->chamaView("notifica-users", "organizador",
                   $data, 1);
        }
        
        public function camposRestritos($obj){
            $cadastro = $obj->getCodigo()=== null ? true : false;
            
            if($this->isOrganizador()== false && $cadastro == false){
                return 0;
            }
            
            $this->form_validation->set_rules( 'nome', 'Nome Completo', 'trim|required|max_length[50]' );
            $obj->setNomeCompleto($this->input->post('nome'));

            if($cadastro == true || !empty($this->input->post('confirmaemail'))){
                $this->form_validation->set_rules( 'email', 'E-mail', 'valid_email|trim|required|max_length[100]' );
                $this->form_validation->set_rules( 'confirmaemail', 'Confirma E-mail',
                'valid_email|trim|required|max_length[100]|matches[email]' );
                $obj->setEmail($this->input->post('email'));
            }
            
             
            if($cadastro == true || !empty($this->input->post('rg'))){
                $this->form_validation->set_rules( 'rg', 'RG', 'trim|required|max_length[12]' );
                $obj->setRg($this->input->post('rg'));
            }
            
            if($cadastro == true || !empty($this->input->post('cpf'))){
               $this->form_validation->set_rules( 'cpf', 'CPF', 'valid_cpf|trim|required|max_length[14]' );
               $obj->setCpf($this->input->post('cpf')); 
            }
            
            if($cadastro == true){
                $obj->setValidaEmail(0);
                $obj->setStatus('Não Validado');
            }
            
        }
        
        public function obtemSenha($obj){
            if(!empty($this->input->post('confirmasenha'))){
              $this->form_validation->set_rules( 'senha', 'Senha', 'trim|required|min_length[6]' );
              $this->form_validation->set_rules( 'confirmasenha', 'Confirma Senha',
                'trim|required|min_length[6]|matches[senha]' ); 
              $senha = $this->input->post('senha');
              $confirmaSenha = $this->input->post('confirmasenha');
              if($senha == $confirmaSenha){
                $senha = md5($senha);
                $obj->setSenha($senha);
              }
            }
        }
        

        public function consultarEmailSelect(){
            $data = $this->UsuarioDAO->consultarTudo(array('Email.email_email' => $this->input->post('term')));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        //busca usuário por nome
        public function consultarParaSelect2(){
            $data = $this->UsuarioDAO->consultarTudo(array('User.user_nm' => $this->input->post('term')));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }


        public function ativar($user_cd){
            if(!empty($user_cd)){
                 if($this->UsuarioDAO->ativaDesativa($user_cd, 2)==0){
                    $this->session->set_flashdata('success','O Usuário foi ativado com sucesso!');
                 }else{
                    $this->session->set_flashdata('error','Não foi possível ativar o Usuário!');
                 }
            }
             $this->consultar();
        }

        public function desativar($user_cd){
            if(!empty($user_cd)){
                 if($this->UsuarioDAO->ativaDesativa($user_cd, 3)==0){
                    $this->session->set_flashdata('success','O Usuário foi desativado com sucesso!');
                 }else{
                    $this->session->set_flashdata('error','Não foi possível desativar o Usuário!');
                 }
            }
             $this->consultar();
        }

        public function consultarRevisorSelect2(){
            $data = $this->UsuarioDAO->consultarTudo(array('user_nm' => $this->input->post('term'), 'user_tipo' => 2));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        public function notificar(){
            if (empty($this->input->post())){
                $this->chamaView("notifica-users", "organizador",
                    array("title"=>"IFEvents - Nova Notificação"), 1);
                return true;
            }
            $mensagemEscrita = $this->load->view("template-email/template-email",
                array("corpoMensagem" => $this->input->post("mensagem"), "tituloMensagem" => "Notificação"), true);
            // $mensagemEscrita = $this->input->post("mensagem");
            $notificacao = (object) array(
                'tipo_notificacao' => $this->input->post('tipo_notificacao'),
                'emails' => $this->input->post('emails'),
                'assunto' => $this->input->post('assunto'),
                'mensagem' => $mensagemEscrita);
            $this->form_validation->set_rules( 'tipo_notificacao', 'Notificar', 'trim|required|max_length[11]' );
            if($notificacao->tipo_notificacao == 1){
                $this->form_validation->set_rules( 'emails[]', 'Emails', 'valid_emails|trim|required|max_length[100]' );
            }
            $this->form_validation->set_rules( 'assunto', 'Assunto', 'trim|required|max_length[50]' );
            $this->form_validation->set_rules( 'mensagem', 'Mensagem', 'required' );
            $users = null;
            if($notificacao->tipo_notificacao != 1 && $notificacao->tipo_notificacao != -1){
                switch ($notificacao->tipo_notificacao) {
                    case '2':
                        $users = $this->UsuarioDAO->consultarTudo(array('user_tipo' => 1));
                        break;

                    case '3':
                        $users = $this->UsuarioDAO->consultarTudo(array('user_tipo' => 2));
                        break;

                    case '4':
                        $users = $this->UsuarioDAO->consultarTudo(array('user_tipo' => 3));
                        break;

                    default:
                        $users = $this->UsuarioDAO->consultarTudo(null);
                        break;
                }
            }
            if($this->form_validation->run()){
                $test=1;
                $qtd=0;
                if(!empty($notificacao->emails)){
                    $qtd= sizeof($notificacao->emails);
                    foreach ($notificacao->emails as $key => $value) {
                        $test = $this->envia_email($value,$notificacao->assunto, $notificacao->mensagem);
                    }
                }
                if($users != null){
                    $qtd= sizeof($users);
                    foreach ($users as $key => $value) {
                        $test = $this->envia_email($value->email_email, $notificacao->assunto, $notificacao->mensagem);
                    }
                }
                if($test == 0){
                    if($qtd > 1){
                        $mensagem = 'As notificações foram enviados com sucesso!';
                    }else{
                        $mensagem = 'A notificação foi enviada com sucesso!';
                    }
                    $this->session->set_flashdata('success', $mensagem);
                }else{
                    if($qtd > 1){
                        $mensagem = 'Não foi possível enviar as notificações!';
                    }else{
                        $mensagem = 'Não foi possível enviar a notificação!';
                    }

                    $this->session->set_flashdata('error', $mensagem);
                }
            }
            $data['title']="IFEvents - Nova Notificação";
            $notificacao->mensagem = $this->input->post('mensagem');
            $data['notificacao'] = $notificacao;
            $this->chamaView("notifica-users", "organizador",
                   $data, 1);
        }



}
