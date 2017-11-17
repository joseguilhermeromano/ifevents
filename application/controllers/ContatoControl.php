<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class ContatoControl extends PrincipalControl{

    public function __construct(){
            parent::__construct();
        $this->load->library('email');
        $this->load->Model( 'dao/ContatoDAO' );
        $this->load->Model('ContatoModel','contato');
    }
    
    //Enivar contato na area interna 
    public function cadastrar() {
        $data = array("title"=>"IFEvents - Novo Contato");
        if (empty($this->contato->input->post())){
            return $this->chamaView("form-contato", "usuario", $data, 1);
        }
        $this->setaValores();
        $data['contato'] = $this->contato;
        if( $this->valida()==true){
            if($this->ContatoDAO->inserir($this->contato)==true){
                $this->session->set_flashdata('success', 'Mensagem enviada com sucesso!');
                $data['contato'] = null;
            }else{
                $this->session->set_flashdata('error', 'A mensagem não pode ser enviada!');
            }

        }
        
        $this->chamaView("form-contato", "usuario", $data, 1);
    }
    
    //Enivar contato na area externa 
    public function contatoAreaExterna() {
        $data = array("title"=>"IFEvents - Contato");
        if (empty($this->contato->input->post())){
            return $this->chamaView("contato", "inicio",
                $data, 0);
        }
        $this->setaValores();
        $data['contato'] = $this->contato;
        if( $this->valida()==true){
            if($this->ContatoDAO->inserir($this->contato)==true){
                $this->session->set_flashdata('success', 'Mensagem enviada com sucesso!');
                $data['contato'] = null;
            }else{
                $this->session->set_flashdata('error', 'A mensagem não pode ser enviada!');
            }

        }
        
        return $this->chamaView("contato", "inicio", $data, 0);
    }

    public function alterar($codigo) {

    }
    
    private function valida(){
        $this->form_validation->set_rules( 'nome', 'Nome', 'trim|required|max_length[50]' );
        $this->form_validation->set_rules( 'email', 'E-mail', 'trim|required|max_length[80]' );
        $this->form_validation->set_rules( 'assunto', 'Assunto', 'trim|required|max_length[50]' );
        $this->form_validation->set_rules( 'mensagem', 'Mensagem', 'trim|required|max_length[500]' );
        return $this->form_validation->run();
    }

    private function setaValores(){
        $this->contato->setNome($this->input->post( 'nome' ));
        $this->contato->setAssunto($this->input->post('assunto'));
        $this->contato->setEmail($this->input->post( 'email' ));
        $this->contato->setMensagem($this->input->post( 'mensagem' ));
    }
    
    public function consultarTudo(){
        $getLimiteReg = $this->input->get('limitereg');
        $limite = $getLimiteReg !== null ? $getLimiteReg : 10;
        $getPagina = $this->input->get('pagina');
        $numPagina = $getPagina !== null ? $getPagina : 0;
        $busca=null;
        $array= null;
        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array('cont_nm' => $busca);
        }
        $consulta = $this->ContatoDAO->consultarTudo($array, $limite, $numPagina);
        $totalRegConsulta = count($this->ContatoDAO->consultarTudo($array));
        $totalRegTabela = $this->ContatoDAO->totalRegistros();
        $totalRegistros = !empty($busca) ? $totalRegConsulta : $totalRegTabela;
        $hrefPaginacao = 'contato/consultarTudo/?busca='.$busca.'&limitereg='.$limite;
        $data['paginacao'] = $this->geraPaginacao($limite, $totalRegistros, $hrefPaginacao);
        $data['content']= $consulta;
        $data['busca']= $busca;
        $data['limiteReg']= $limite;
        $data['totalRegistros'] = $totalRegistros;
        $data['title']="IFEvents - Lista de Contatos";
        $this->chamaView("listacontato", "organizador", $data, 1);
    }


    public function excluir($codigo) {
        if( $this->ContatoDAO->excluir($this->uri->segment(3)) == false){
                        $this->session->set_flashdata('error', 'Arquivo não pode ser excluido!');
        }
        else{
            $this->session->set_flashdata('success', 'Arquivo deletado com sucesso!');
            redirect('contato/consultarTudo/');
        }

    }

    public function responder($codigoContato){
        
        $this->contato = $this->ContatoDAO->consultarCodigo($codigoContato);
        $this->contato->setAssunto(null);
        $this->contato->setMensagem(null);
        $data['resposta'] = $this->contato;
        $data['title'] = "IFEvents - Resposta à contato";
        if (empty($this->contato->input->post())){
            return $this->chamaView("form-resposta-contato", "organizador", $data, 1);
        }

        if( $this->valida()==false){
                $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
        }else{
            $this->setaValores();
            $this->contato->setStatus(1);
            $dataMensagem = array("tituloMensagem" => "Resposta à contato"
            ,"corpoMensagem" => $this->contato->getMensagem());
            $mensagem = $this->load->view("template-email/template-email", $dataMensagem, true);
            $email = $this->contato->getEmail();
            $assunto = $this->contato->getAssunto();
            if($this->envia_email($email, $assunto, $mensagem) == true){
                $this->session->set_flashdata('success', 'Resposta enviada com sucesso!');
                redirect('contato/consultarTudo');
            }else{
                $this->session->set_flashdata('error', 'Não foi possível enviar a resposta!');
                $data['resposta'] = $this->contato;
            }
        }

        return $this->chamaView("form-resposta-contato", "organizador", $data, 1);
    }
    
    
    
}
