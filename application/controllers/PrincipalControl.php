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
                $this->load->library('uploadimage','','file');
                $this->load->model('dao/EdicaoDAO');
                $this->guardaUltimasUrlsAcessadas();
		$this->load->model('acesso/Autentica');
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
    
    public function consultarUltimosTresEventos(){
        $eventosRecentes = $this->EdicaoDAO->consultarTudo(null,3, null, 'edic_cd','desc');
        if($eventosRecentes === null){
            $this->session->set_flahsdata('info', 'Não há eventos cadastrados no sistema!');
        }
        $this->session->set_userdata('eventos_recentes', $eventosRecentes);
        if($this->session->userdata('eventos_recentes')=== null){ 
            $this->session->set_userdata('evento_selecionado',$eventosRecentes[0]);
        }
    }
    
    private function guardaUltimasUrlsAcessadas(){
        $urlAtual = $this->uri->uri_string();
        $uris = $this->session->userdata('uris');
        
        if($uris === null){
            $uris = array('ultima' => $urlAtual,'penultima' => null);
            $this->session->set_userdata('uris', $uris);
            return;
        }
        
        if($uris['penultima'] === null){
           $uris['penultima'] = $uris['ultima'];
           $this->session->set_userdata('uris', $uris);
           return;
        }
        
        if($urlAtual != $uris['ultima']){
           $uris['penultima'] = $uris['ultima'];
           $uris['ultima'] = $urlAtual;
           $this->session->set_userdata('uris', $uris);
           return;
        } 
        
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
        <ul class="pagination" id="ajaxPagination">';
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

    public function envia_email($destinatario, $assunto, $mensagem, 
        $remetente='projetoifsp2017@gmail.com'){
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

        if($mail->Send()) {
          return true;
        }
          // echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    

    public function download_arquivo($nomeArquivo, $arquivo){
        if($arquivo == null){
            $this->session->set_flashdata('error', 'O arquivo <b>'.$nomeArquivo.'</b> não exite!!!');
        }
        $tipo = $this->retornarHeaderParaArquivo($nomeArquivo);
        header('Content-Description: File Transfer');
        header("Content-Type: ".$tipo); // informa o tipo do arquivo ao navegador
        // informa ao navegador que é tipo anexo e faz abrir a janela de download, 
        // tambem informa o nome do arquivo
        header('Content-Disposition: attachment; filename="'.$nomeArquivo.'"'); 
        header('Content-Transfer-Encoding: binary'); 
        header('Expires: 0'); 
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
        header('Pragma: public'); 
        header("Content-Length: ".strlen($arquivo)); // informa o tamanho do arquivo ao navegador
        ob_clean();
        ob_flush();
        print $arquivo;
        exit;
    }
    
    private function retornarHeaderParaArquivo($nomeArquivo){
        $tipo = '';
        switch(pathinfo($nomeArquivo, PATHINFO_EXTENSION)){ // verifica a extensão do arquivo para pegar o tipo
             case "pdf": $tipo="application/pdf"; break;
             case "doc": $tipo="application/msword"; break;
             case "docx": $tipo="application/vnd.openxmlformats-officedocument.wordprocessingml.document"; break;
             case "pptx": $tipo="application/vnd.openxmlformats-officedocument.presentationml.presentation"; break;
             case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
             case "gif": $tipo="image/gif"; break;
             case "png": $tipo="image/png"; break;
             case "jpg": $tipo="image/jpg"; break;
             case "jpeg": $tipo="image/jpeg"; break;
          }
        return $tipo;
    }
    
    
    public function visualiza_arquivo($nomeArquivo, $arquivo){
        if($arquivo == null){
            $this->session->set_flashdata('error', 'O arquivo <b>'.$nomeArquivo.'</b> não exite!!!');
        }
        $tipo = $this->retornarHeaderParaArquivo($nomeArquivo);
        header('Content-Type: '.$tipo);
        header('Content-Length: ' . strlen($arquivo));
        header('Content-Disposition: inline; filename="'.$nomeArquivo.'"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');
        ini_set('zlib.output_compression','0');

        echo $arquivo;
    }
    
    public function upload_arquivo($inputName, $linkUpload, $novoNomeArquivo = null){
        $this->LimparPastaTemp();
        $this->file->upload($_FILES[$inputName],'pt_BR');
        if (!$this->file->uploaded) {
            $this->session->set_flashdata('error', $this->file->error);
            return false;
        }
        $this->file->file_new_name_body = $novoNomeArquivo;
        $this->file->file_overwrite = true ;
        $this->file->Process($linkUpload);
        if ($this->file->processed) {
            $link = str_replace("\\", "", $this->file->file_dst_pathname);
            return $link;
        }
        $this->session->set_flashdata('error', $this->file->error);
        return null;
    }
    
    public function LimparPastaTemp(){
        $pasta = "temp/";
        if(is_dir($pasta)){
            $diretorio = dir($pasta);

            while($arquivo = $diretorio->read()){
                if(($arquivo != '.') && ($arquivo != '..')){
                    unlink($pasta.$arquivo);
                }    
            }
            $diretorio->close();
        }
    }

}
