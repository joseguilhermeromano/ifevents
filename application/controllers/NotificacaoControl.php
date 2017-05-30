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