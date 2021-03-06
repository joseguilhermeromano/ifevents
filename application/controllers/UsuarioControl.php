
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
        $getLimiteReg = $this->input->get('limitereg');
        $limite = $getLimiteReg !== null ? $getLimiteReg : 10;
        $getPagina = $this->input->get('pagina');
        $numPagina = $getPagina !== null ? $getPagina : 0;
        $busca=null;
        $array= array('user_nm' => null, 'email_email'=>null);
        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array['user_nm'] = $busca;
            $array['email_email'] = $busca;
        }
        $consulta = $this->UsuarioDAO->consultarTudo($array, $limite, $numPagina);
        $totalRegConsulta = count($this->UsuarioDAO->consultarTudo($array));
        $totalRegTabela = $this->UsuarioDAO->totalRegistros();
        $totalRegistros = !empty($busca) ? $totalRegConsulta : $totalRegTabela;
        $hrefPaginacao = 'usuario/consultar/?busca='.$busca.'&limitereg='.$limite;
        $data['paginacao'] = $this->geraPaginacao($limite, $totalRegistros, $hrefPaginacao);
        $data['users']= $consulta;
        $data['busca']= $busca;
        $data['limiteReg']= $limite;
        $data['totalRegistros'] = $totalRegistros;
        $data['title']="IFEvents - Usuários";
        $this->chamaView("usuarios", "organizador", $data, 1);
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
            $string="IFEVENTS-TOKEN-USUARIO-LOGIN-";
            $token = md5($string.uniqid());
            $obj->setToken($token);
            $this->disparaEmailDeValidacao($obj);
            $obj->setStatus('Não Validado');
        }
    }
    
    private function disparaEmailDeValidacao($obj){
        $linkValidcao = base_url("usuario/validar?token=".$obj->getToken());
        $mensagem = "Caro(a) <b>".$obj->getNomeCompleto()."</b>, precisamos ativar sua "
        . "conta de usuário da plataforma <b>IFEVENTS!</b><br>"
        .'Por favor, <a href ="'.$linkValidcao.'"> Clique aqui </a>'
        . ' para ativarmos a sua conta!';
        $dataMensagem = array("tituloMensagem" => "Validação de Usuário"
            ,"corpoMensagem" => $mensagem);
        $htmlMensagem = $this->load->view("template-email/template-email", $dataMensagem, true);
        $this->envia_email($obj->getEmail()
                    , 'validação de conta de usuário da plataforma IFEVENTS'
                    , $htmlMensagem);
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
    
    public function validar(){
        $token = $this->input->get('token');
        if(empty($token)){
            $this->session->set_flashdata('error', 'Não foi possível validar este usuário! '
            . 'Token não informado!');
            redirect('/login');
        }
        $consulta = array('user_token' => $token);
        $usuario = $this->UsuarioDAO->consultarTudo($consulta)[0];
        if($usuario->user_status == 'Não Validado' 
        && $this->UsuarioDAO->ativaDesativa($usuario->user_cd, 2)==0){
            $this->session->set_flashdata('success','O Usuário foi validado com sucesso! '
            . 'Por favor, entre com o login e senha cadastrados!');
        }else{
            $this->session->set_flashdata('error','Não foi possível validar o Usuário!');
        }
        redirect('/login');
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
    
    private function validaNotificacao(){
        $this->form_validation->set_rules( 'tipo_notificacao', 'Notificar', 'trim|required|max_length[11]' );
        if($this->input->post('tipo_notificacao') == 1){
            $this->form_validation->set_rules( 'emails[]', 'Emails', 'valid_emails|trim|required|max_length[100]' );
        }
        $this->form_validation->set_rules( 'assunto', 'Assunto', 'trim|required|max_length[50]' );
        $this->form_validation->set_rules( 'mensagem', 'Mensagem', 'required' );
        return $this->form_validation->run();
    }
    
    private function setaValoresNotificacao(){
        $dataMensagem = array("tituloMensagem" => "Notificação"
            ,"corpoMensagem" => $this->input->post("mensagem"));
        $mensagem = $dataMensagem['corpoMensagem'];
        
        if($this->validaNotificacao()){
            $mensagem = $this->load->view("template-email/template-email", $dataMensagem, true);
        }
        
        return (object) array(
            'tipo_notificacao' => $this->input->post('tipo_notificacao')
           ,'emails' => $this->input->post('emails')
           ,'assunto' => $this->input->post('assunto')
           ,'mensagem' => $mensagem
        );
    }
    
    private function disparaNotificacao($objetos, $notificacao){
        foreach ($objetos as $key => $value) {
            $test = $this->envia_email($value->email_email
                    , $notificacao->assunto
                    , $notificacao->mensagem);
        }
        return $test; 
    }
    
    private function sucessoErroNotificacao($test, $qtd, $notificacao){
        if($test == 0){
            $fimMsg = " com sucesso!";
            $mensagem = $qtd > 1 ? 'As notificações foram enviados'.$fimMsg
                    : 'A notificação foi enviada'.$fimMsg;
            $this->session->set_flashdata('success', $mensagem);
            return null;
        }else{
            $inicioMsg = 'Não foi possível enviar ';
            $mensagem = $qtd > 1 ? $inicioMsg.'as notificações!'
                    : $inicioMsg.'a notificação'; 
            $this->session->set_flashdata('error', $mensagem);
        }
        return $notificacao;
    }

    public function notificar(){
        $data = array("title"=>"IFEvents - Nova Notificação");
        if (!empty($this->input->post())){
            $notificacao = $this->setaValoresNotificacao();
            if($this->validaNotificacao()){
                switch ($notificacao->tipo_notificacao) {
                    case '1':
                        $qtd= sizeof($notificacao->emails);
                        foreach ($notificacao->emails as $key => $value) {
                            $test = $this->envia_email($value
                                    ,$notificacao->assunto
                                    ,$notificacao->mensagem);
                        }
                        break;
                    case '2' || '3' || '4':
                        $data = array('user_tipo' => $notificacao->tipo_notificacao - 1);
                        $users = $this->UsuarioDAO->consultarTudo($data);
                        $qtd= sizeof($users);
                        $test = $this->disparaNotificacao($users, $notificacao);
                        break;
                    case '5':
                        $data = array('user_status' => 'Ativo');
                        $users = $this->UsuarioDAO->consultarTudo($data);
                        $qtd= sizeof($users);
                        $test = $this->disparaNotificacao($users, $notificacao);
                        break;
                }
                $notificacao = $this->sucessoErroNotificacao($test, $qtd, $notificacao);
            }
            $data['notificacao'] = $notificacao;   
        }
        $this->chamaView("notifica-users", "organizador", $data, 1);
    }
    
    
}
