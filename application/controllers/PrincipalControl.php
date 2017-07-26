<?php

if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class PrincipalControl extends CI_Controller {

	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'form' );
		$this->load->helper ( 'url' );
		$this->load->helper ( 'security' );
		$this->load->helper ( 'language' );
		$this->load->library('form_validation');
        $this->load->model('dao/DataBaseDAO');
		$this->load->library("session");
        $this->load->library('upload');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('uploadimage','','img');
		//$this->load->model('acesso/Autentica');
	}

	/**
	* Função para chamar as views de qualquer controlador!
	* @param String $view nome da view que deseja chamar
	* @param String $nome Diretorio nome do diretório da view (inicio, administrador, participante, etc.)
	* @param Array $data Array de dados que deseja passar para a view (tanto para objetos como simples array)
	* o titulo da página deve estar dentro desse array ex: data['title']="Início - Seja bem vindo à plataforma         * IFEvents!";
	* @param Int $areaTemplate Aceita dois valores (0 para o layout externo e 1 para o layout interno)
	**/

    public function chamaView($view, $nomeDiretorio='inicio',$data=null,$areaTemplate=0){
    	// $nomeDiretorio = strtolower($nomeDiretorio);
        if ( ! file_exists(APPPATH.'/views/'.$nomeDiretorio.'/'.$view.'.php'))
        {
            // Caso não exista a página, retorna o erro abaixo
            show_404();
        }

        $areaTemplate == 1 ? $header="common/area-interna/header" : $header="common/area-externa/header";
        $areaTemplate == 1 ? $footer="common/area-interna/footer" : $footer="common/area-externa/footer";

        $this->load->view($header,$data);
        $this->load->view($nomeDiretorio.'/'.$view, $data);
        $this->load->view($footer);

    }
    
    public function isOrganizador(){
        $usuario = $this->session->userdata("usuario");
        if($usuario===null){
            return false;
        }
        if($usuario->user_tipo == 3){
            return true;
        }
        return false;
    }

    public function geraPaginacao($limite = 10, $totalLinhasTabela = null, $uri=null){
        if($uri==null){
            return null;
        }
        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = base_url($uri);
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open']= '<li>';
        $config['first_tag_close']= '<li>';
        $config['last_tag_open']= '<li>';
        $config['last_tag_close']= '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['next_tag_open'] ='<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] ='<li>';
        $config['prev_tag_close'] = '</li>';
        $config['full_tag_open'] = '<nav class="text-center">
        <ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['total_rows'] = $totalLinhasTabela;
        $config['per_page'] = $limite;
        $config['enable_query_strings']=true;
        $config['page_query_string']=true;
        $config['query_string_segment'] = 'pagina';
        $this->pagination->initialize($config);
        $paginacao = $this->pagination->create_links();
        return $paginacao;
    }

    public function envia_email($destinatario, $assunto, $mensagem, $remetente='projetoifsp2017@gmail.com'){
        $this->load->library("MY_phpmailer");
        $mail = new PHPMailer();
        $mail->IsSMTP(); //Definimos que usaremos o protocolo SMTP para envio.
        $mail->SMTPAuth = true; //Habilitamos a autenticação do SMTP. (true ou false)
        $mail->SMTPSecure = "ssl"; //Estabelecemos qual protocolo de segurança será usado.
        $mail->Host = "smtp.gmail.com"; //Podemos usar o servidor do gMail para enviar.
        $mail->Port = 465; //Estabelecemos a porta utilizada pelo servidor do gMail.
        $mail->Username = "projetoifsp2017@gmail.com"; //Usuário do gMail
        $mail->Password = "ifsp2017"; //Senha do gMail
        $mail->SetFrom($remetente,"IFEvents - Plataforma interativa de eventos"); //Quem está enviando o e-mail.
        $mail->AddReplyTo($destinatario); //Para que a resposta será enviada.
        $mail->Subject = utf8_decode($assunto); //Assunto do e-mail.
        $mail->Body = utf8_decode($mensagem);
        $mail->IsHTML(true);
        $destino = $destinatario;
        $mail->AddAddress($destino);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        if(!$mail->Send()) {
          // echo "Mailer Error: " . $mail->ErrorInfo;
          return 1;
        } else {
          return 0;
        }

    }

    public function upload_arquivo($config, $input){
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $file = array();


            $file['file_nm'] = $_FILES[$input]['name'];
            $file['error'] =  false;

            if(!$this->upload->do_upload($input)){
                $file['error'] =  true;
                $file['file_nm'] = null;
                $file['file'] = null;
            }
            else{
                $data  = array('upload_data' => $this->upload->data());
                $arquivo=read_file($data['upload_data']['full_path']);
                //função que deleta o arquivo do diretório temporário
                unlink($data['upload_data']['full_path']);
                $file['file'] = $arquivo;
            }

        return $file;
    }

    public function download_arquivo($nomeArquivo, $arquivo){

        if($arquivo == null){
            $this->session->set_flashdata('error', 'O arquivo <b>'.$nomeArquivo.'</b> não exite!!!');
        }
        $tipo = '';
        switch(pathinfo($nomeArquivo, PATHINFO_EXTENSION)){ // verifica a extensão do arquivo para pegar o tipo
             case "pdf": $tipo="application/pdf"; break;
             case "doc": $tipo="application/msword"; break;
             case "docx": $tipo="application/msword"; break;
             case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
             case "gif": $tipo="image/gif"; break;
             case "png": $tipo="image/png"; break;
             case "jpg": $tipo="image/jpg"; break;
          }
           header("Content-Type: ".$tipo); // informa o tipo do arquivo ao navegador
           //header("Content-Length: ".filesize($nomeArquivo)); // informa o tamanho do arquivo ao navegador
           header("Content-Disposition: attachment; filename=".$nomeArquivo); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
           echo($arquivo); // lê o arquivo
           exit; // aborta pós-ações

    }

}
