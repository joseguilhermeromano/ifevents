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

    public function geraPaginacao($limite = 2, $totalLinhasTabela = null, $uri=null){
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
        $config['num_links'] = '2';
        $config['total_rows'] = $totalLinhasTabela;
        $config['per_page'] = $limite;
        $config['enable_query_strings']=true;
        $config['page_query_string']=true;
        $config['query_string_segment'] = 'pagina';
        $this->pagination->initialize($config);
        $paginacao = $this->pagination->create_links();
        return $paginacao;
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

}