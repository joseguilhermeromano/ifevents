<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';

class NotificacaoControl extends PrincipalControl{

	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/UserDAO' );
		$this->load->Model( 'LocalidadeModel' );
		$this->load->Model( 'EmailModel' );
		$this->load->Model( 'TelefoneModel' );
		$this->load->Model( 'InstituicaoModel' );
		$this->load->Model( 'dao/EdicaoDAO' );
		$this->load->Model( 'UserModel','usuario' );
	}

	public function notificaUsers(){
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
	            }
	            $notificacao = null;
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

 	public function convidarRevisor(){
        $edic_cd = 10;
        $conferencia = 1;

        $edicao = $this->EdicaoDAO->consultarCodigo($edic_cd);
        
        $revisor = $this->input->post('revisor');

        $verificaEnvio = 1;

        $rev = $this->UserDAO->consultarCodigo($revisor);

        echo $this->input->post('revisor');

        $verificaRevisor = $this->EdicaoDAO->convidarRevisor($rev['user']->user_cd, $conferencia);

        $verificaRevisor == 1 ? exit : ''; 


        $tituloMensagem = '<span><img src="http://www.plantcitylock.com/plantcit/images/email.png" width="33"></span>
                Convite';
        $corpoMensagem = '<center>Caro(a) Sr(a). <b>'.$rev['user']->user_nm.'</b>, desejamos saber se você pode nos ajudar na revisão dos trabalhos para o evento científico <b>'.$edicao->edic_num.'ª '.$edicao->conferencia->conf_abrev.'</b>, que ocorrerá entre o período dos dias <b>'.desconverteDataMysql($edicao->regra->regr_even_ini_dt).'</b> até <b>'.desconverteDataMysql($edicao->regra->regr_even_fin_dt).'</b>. 
                <br><br>Sua colaboração é muito importante para nós!<br><br></center>
                <center>
                    <a href="'.base_url('aceitar-convite/'.$rev['user']->user_cd.'/'.$conferencia).'" target="_blank" class="block-center">
                    <b>Aceitar</b></button>
                    </a>
                    &nbsp;&nbsp;
                    <a href="'.base_url('recusar-convite/'.$rev['user']->user_cd.'/'.$conferencia).'" target="_blank"block-center">
                    <b>Recusar</b>
                    </a>
                </center>
                <br>
                <center><b>Obs.:</b> Sua identidade será mantida em absoluto sigilo.</center>
                ';

        $data['tituloMensagem'] = $tituloMensagem;
        $data['corpoMensagem'] = $corpoMensagem;

        $verificaEnvio = $this->envia_email($rev['email']->email_email, 'Convite para Revisão', 
            $this->load->view('template-email/template-email',$data, true));               


        if($verificaEnvio <= 0){
            $this->session->set_flashdata('success', 'O Convite foi enviado com sucesso!');
        }else{
            $this->session->set_flashdata('error', 'Não foi possível enviar o convite!');
        }

        redirect('revisor/consultar');
    }

}