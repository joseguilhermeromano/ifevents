<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ConferenciaDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
        public function Cadastrar( $titulo, $descricao ){

			$this->conf_nm   = $titulo;
			$this->conf_desc = $descricao;

			$confirm = $this->db->insert('Conferencia', $this);
				
			if($confirm){  
				$this->session->set_flashdata('success', 'Conferencia Cadastrada Com Sucesso');		
				redirect('OrganizadorControl/conferencias');		
			}
			else{
				$this->session->set_flashdata('empty', 'Os dados não puderam ser Inseridos.');
				redirect( 'OrganizadorControl/conferencias' );
			}	

		}
                
                public function inserir($obj) {
                    return $this->db->insert('conferencia', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('conf_id', $obj->conf_id);
                    return $this->db->update('conferencia', $obj);
                }

                public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='conf_nm', $ordenacao='asc') {
                    $this->db->select("*");
                    $this->db->from("Conferencia");
                    $this->db->order_by($sort, $ordenacao);
                    if($parametros !== null){
                        foreach ($parametros as $key => $value) {
                            $this->db->where($key.' LIKE ','%'.$value.'%');
                        }
                    }
                    if($limite)
                        $this->db->limit($limite, $numPagina);
                    $query = $this->db->get();
                    if($query->num_rows()>0){
                        return $query->result_object();
                    }else{
                        return null;
                    }
                }
                
                public function consultarCodigo($codigo){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('conf_id', $obj->conf_id);
                    return $this->db->delete('conferencia');
                }

                

}





