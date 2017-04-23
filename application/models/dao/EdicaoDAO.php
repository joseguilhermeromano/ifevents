<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class EdicaoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                public function inserir($obj) {
                    $this->db->insert('Edicao', 
                        array(
                        'edic_num' => $obj->edic_num
                        ,'edic_tema' => $obj->edic_tema
                        ,'edic_apresent' => $obj->edic_apresent
                        ,'edic_link' => $obj->edic_link
                        ,'edic_img' => $obj->edic_img
                        ,'edic_regr_cd' => $obj->edic_regr_cd
                        ,'edic_comi_cd' => $obj->edic_comi_cd
                        ,'edic_conf_cd' => $obj->edic_conf_cd
                        ,'edic_email_cd' => $obj->edic_email_cd
                        ,'edic_tele_cd' => $obj->edic_tele_cd
                            ));
                    $id = $this->db->insert_id();
                    if(null !==$obj->parcerias){
                        foreach ($obj->parcerias as $key => $value) {
                            $this->db->insert('Apoia', array('apoia_inst_cd' => $key,'apoia_edic_cd'=> $id));
                        }
                    }
                    return $id;
                }
                
                public function alterar($obj) {
                    $this->db->where('ende_id', $obj->ende_id);
                    return $this->db->update('edicao', $obj);
                }

                public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='conf_nm', $ordenacao='asc') {
                    $this->db->select("*");
                    $this->db->from("Edicao");
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

                public function consultarUltimaEdicao($conf_cd){
                    $this->db->select_max("edic_num");
                    $this->db->from("Edicao");
                    $this->db->where("edic_conf_cd",$conf_cd);
                    $query = $this->db->get();
                    // echo print_r($query->result_object());
                    if(isset($query->result_object()[0]->edic_num)){
                        return $query->result_object()[0]->edic_num;
                    }else{
                        return 0;
                    }
                }
                
                public function consultarCodigo($codigo){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('ende_id', $obj->ende_id);
                    return $this->db->delete('edicao');
                }

                

}





