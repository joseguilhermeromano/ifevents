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
		// $this->load->model('acesso/Autentica');		
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
                // Caso não exista a págiina, retorna o erro abaixo
                show_404();
        }
        $areaTemplate == 1 ? $header="common/area-interna/header" : $header="common/area-externa/header";
        $areaTemplate == 1 ? $footer="common/area-interna/footer" : $footer="common/area-externa/footer";
        $this->session->set_userdata('view',$view);
        $this->session->set_userdata('nomeDiretorio',$nomeDiretorio);
        $this->session->set_userdata('title',$data['title']);
        $this->session->set_userdata('areaTemplate',$areaTemplate);
        $this->load->view($header,$data);
        $this->load->view($nomeDiretorio.'/'.$view, $data);
        $this->load->view($footer);
        
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


        $this->load->library("My_PHPMailer");

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
          echo "Mailer Error: " . $mail->ErrorInfo;
          return 1;
        } else {
          return 0;
        }

    }

    public function upload_arquivo($model){
        $config['upload_path']   = 'upload';
        $config['allowed_types'] = 'pdf|docx';
        $config['max_size']      = '4096';

        $model->load->library('upload', $config);
        $model->upload->initialize($config);

        if(!$model->upload->do_upload()){
                $model->session->set_flashdata( 'error', 'O arquivo não pode ser enviado. Verifique se o arquivo foi selecionado ou se a extensão é ".pdf"  ou  ".docx"' );
                redirect('artigo/cadastrar');
        }
        else{
                $data  = array('upload_data' => $model->upload->data());
                $file=read_file($data['upload_data']['full_path']);
                //função que deleta o arquivo do diretório temporário
                unlink($data['upload_data']['full_path']);

        }
        return $file;
    }
            
    public function download_arquivo($model){
        $codigo = $model->input->get("codigo");                
        $download = $model->SubmitDAO->consultarCodigo($codigo);

        if($download->num_rows() > 0){
            $row  = $download->row();

            $nome = $row->subm_arquivo_nm;

            header("Content-type: application/pdf");
            header('Content-Disposition: attachment; filename="'.$nome.'"');
            echo $row->subm_arq1;                   
        }
        else{
            $model->session->set_flashdata('error', 'Esse arquivo não exite!!!');
        }
    }
    //$novoNome,$tipos,$maxWidth, $maxHeight, $minWidth, $minHeight
    public function upload_image($novoNome,$maxWidth=null, $maxHeight=null, $minWidth=null, $minHeight=null){
      $this->img->upload($_FILES['image_field'],'pt_BR');
        if ($this->img->uploaded) {
            if($this->img->file_is_image == true){
                // $this->img->image_max_width = $maxWidth;
                // $this->img->image_max_height = $maxHeight;
                // $this->img->image_min_width = $minWidth;
                // $this->img->image_min_height = $minHeight;
                // $this->img->allowed = array('image/jpg','image/jpeg','image/png');
                // $this->img->file_new_name_body = $novoNome;
                $processo = $this->img->Process();
                echo $this->img->Process();
                // header('Content-type: ' . $this->img->file_src_mime);
                // header("Content-Disposition: attachment; filename=".rawurlencode($this->img->file_src_name).";");
                  // echo $processo;
                  die();
                // if ($this->img->processed) {

                //       $this->session->set_flashdata('success','A Imagem foi processada com sucesso!');
                // } else {
                //       $this->session->set_flashdata('error', $this->img->error);
                // }
            }else{
                $this->session->set_flashdata('error', 'O Arquivo selecionado não é uma imagem!');
            }








              // Salva uma cópia da imagem com as configurações originais
              // $this->img->Process('application/views/upload/img/');
              // if ($this->img->processed) {
              //   echo '<br>A Imagem original foi copiada com sucesso!!';
              // } else {
              //   echo ('<br>Erro : '.$this->img->error);
              // }
               // Salva uma cópia da imagem com um novo nome
              // $this->img->file_new_name_body = 'NovoNome';
              // $this->img->Process('application/views/upload/img/');
              // if ($this->img->processed) {
              //     echo '<br>A Imagem renomeada para "NovoNome" foi copiada com sucesso!!! ';
              // } else {
              //     echo ('<br>Erro : '.$this->img->error);
              // }
              // Salva uma cópia da imagem com um novo nome
              // E Redimensiona a imagem para 100 px de comprimento e mantém a largura auto-ajustável
              // $this->img->file_new_name_body = 'ImagemReajustada';
              // $this->img->image_resize = true;
              //Atribui uma extensão diferente para a nova cópia da Imagem
              // $this->img->image_convert = 'gif';
              // $this->img->image_x = 100;
              // $this->img->image_ratio_y = true;
              // $this->img->Process('application/views/upload/img/');
              // if ($this->img->processed) {
              //     echo '<br>A Imagem foi renomeada para "ImagemReajustada" , foi ajustada para x=100
              //           e convertida para o formato GIF com sucesso!!!';
              //     $this->img->Clean();
              // } else {
              //     echo '<br>Erro : ' . $this->img->error;
              // } 
        } else {
            $this->session->set_flashdata('error', $this->img->error);
        }
        
    }

    public function show_image(){

    }

}