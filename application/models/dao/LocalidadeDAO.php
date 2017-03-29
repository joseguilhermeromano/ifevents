<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        

	class LocalidadeDAO extends CI_Model{

		public function __construct(){
			parent::__construct();

		}
                
        public function inserirEnderecoUser($obj, $user_cd) {
            $data= array();

            $this->db->select("endereco_user.enus_cd, endereco_user.enus_num, localidade.loca_cd");
            $this->db->from("user_loca_ende");
            $this->db->join('endereco_user', 'user_loca_ende.ule_ende_cd = endereco_user.enus_cd','inner');
            $this->db->join('localidade', 'user_loca_ende.ule_loca_cd = localidade.loca_cd','inner');
            $this->db->where('localidade.loca_cep',  $obj->loca_cep);
            $query = $this->db->get();
            $consulta = $query->result_object();
            if(!empty($consulta)){
                $data['loca_cd'] = $consulta[0]->loca_cd;
                foreach ($consulta as $key => $value) {
                    $value->enus_num == $obj->enus_num ? $data['enus_cd'] = $value->enus_cd : '';
                }
            }
            if(empty($data['loca_cd'])){
                $this->db->insert('localidade', array('loca_lograd' => $obj->loca_lograd
                    ,'loca_bairro' => $obj->loca_bairro
                    ,'loca_cid' => $obj->loca_cid
                    ,'loca_cep' => $obj->loca_cep
                    ,'loca_uf' => $obj->loca_uf
                    ));
                $data['loca_cd'] = $this->db->insert_id();
            }

            if(empty($data['enus_cd'])){
                $this->db->insert('endereco_user', array('enus_num' => $obj->enus_num
                    ,'enus_comp' => $obj->enus_comp
                    ));
                $data['enus_cd'] = $this->db->insert_id();
            }
            $this->db->insert('user_loca_ende', array('ule_ende_cd' => $data['enus_cd']
                ,'ule_loca_cd' => $data['loca_cd']
                ,'ule_user_cd' => $user_cd
                ));
        }
        
        public function alterar($obj) {
            $this->db->where('loca_cd', $obj->loca_cd);
            return $this->db->update('localidade', $obj);
        }

        public function consultarTudo() {
            return null;
        }
        
        public function consultarCodigo($codigo){
            return null;
        }

        public function excluir($user_cd) {
            $this->db->where('ule_user_cd',$user_cd);
            return $this->db->delete('user_loca_ende');
        }

                

}





