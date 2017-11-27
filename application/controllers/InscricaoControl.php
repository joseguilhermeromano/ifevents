<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
    require_once 'PrincipalControl.php';
    require_once 'InterfaceControl.php';

    class InscricaoControl extends PrincipalControl{

        public function __construct(){
            parent::__construct();
            $this->load->Model( 'dao/InscricaoDAO' );
            $this->load->Model( 'InscricaoModel','inscricao' );
            $this->load->Model( 'dao/AtividadeDAO' );
        }

        public function cadastrar(){

        }

        public function inscrever(){
            $this->recebeValores();
            $this->inscricao->setaValores();
            if($this->InscricaoDAO->inserir($this->inscricao)==true){
                $this->session->set_flashdata('success', 'O Inscrição realizada com sucesso!');
                $this->alterar($this->uri->segment(3));
                $this->consultarTudo();
            }else{
                $this->session->set_flashdata('error', 'Não foi possível efetuar a inscricao!');
                $this->consultarTudo();
                }
        }

        public function alterar($codigo){
            $this->atividade = $this->AtividadeDAO->consultarCodigo($codigo);
            $this->atividade->setaValores();
            $this->AtividadeDAO->alterar($this->atividade);
        }

        public function excluir($codigo){
            if( $this->InscricaoDAO->excluir($this->uri->segment(3))== false ){
                $this->session->set_flashdata('error', 'Participação não pode ser cancelado!');
                $this->consultarTudo();
                }
            else{
                $this->session->set_flashdata('success', 'Participação Cancelada!');
                $this->alterar($this->uri->segment(3));
                $this->consultarTudo();
            }
        }
        
        public function atribuirPresenca($codigoInscricao){
            $this->inscricao = $this->InscricaoDAO->consultarCodigo($codigoInscricao);
            $nomeUsuario = $this->inscricao->getUsuario()->getNomeCompleto();
            if($this->inscricao !== null){
                $this->inscricao->setStatus('Participou');
                $this->db->trans_start();
                    $this->InscricaoDAO->alterar($this->inscricao);
                $this->db->trans_complete();
                
                if($this ->db->trans_status() === true){
                    $this->session->set_flashdata('success', 'A Presença foi '
                    . 'atribuída com sucesso para <b>'
                    .$nomeUsuario.'</b>!');
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível '
                    . 'atribuir a presença para <b>'
                    .$nomeUsuario. '</b>!');
                }
                redirect('inscricao/consultar');
            }
            
            $this->session->set_flashdata('error', 'A inscrição informada é inválida!');
            redirect('inscricao/consultar');
            
        }
        
        public function atribuirFalta($codigoInscricao){
            $this->inscricao = $this->InscricaoDAO->consultarCodigo($codigoInscricao);
            $nomeUsuario = $this->inscricao->getUsuario()->getNomeCompleto();
            if($this->inscricao !== null){
                $this->db->trans_start();
                    $this->inscricao->setStatus('Não Participou');
                    $this->InscricaoDAO->alterar($this->inscricao);
                $this->db->trans_complete();
                
                if($this ->db->trans_status() === true){
                    $this->session->set_flashdata('success', 'A Falta foi'
                    . ' atribuída com sucesso para <b>'
                    .$nomeUsuario.'</b>!');
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível'
                    . ' atribuir a falta para <b>'
                    .$nomeUsuario. '</b>!');
                }
                redirect('inscricao/consultar');
            }
            
            $this->session->set_flashdata('error', 'A Inscrição informada é inválida!');
            redirect('inscricao/consultar');
            
        }

        public function consultar(){
            $getLimiteReg = $this->input->get('limitereg');
            $limite = $getLimiteReg !== null ? $getLimiteReg : 10;
            $getPagina = $this->input->get('pagina');
            $numPagina = $getPagina !== null ? $getPagina : 0;
            $busca=null;
            $codigoEdicao =  $this->session->userdata('evento_selecionado')->edic_cd;
            $array= array('edic_cd'=>$codigoEdicao, 'ativ_nm' => null, 'user_nm' => null);
            if( $this->input->get('busca') !== null){
                $busca = $this->input->get('busca');
                $array['ativ_nm']  = $busca;
                $array['user_nm']  = $busca;
            }
            $consulta = $this->InscricaoDAO->consultarTudo($array, $limite, $numPagina);
            $totalRegConsulta = count($this->InscricaoDAO->consultarTudo($array));
            $hrefPaginacao = 'inscricao/consultar/?busca='.$busca.'&limitereg='.$limite;
            $data['paginacao'] = $this->geraPaginacao($limite, $totalRegConsulta, $hrefPaginacao);
            $data['content']= $consulta;
            $data['busca']= $busca;
            $data['limiteReg']= $limite;
            $data['totalRegistros'] = $totalRegConsulta;
            $data['title']="IFEvents - Inscricoes";
            $this->chamaView("lista-inscritos-atividade", "organizador", $data, 1);   
        }
}
