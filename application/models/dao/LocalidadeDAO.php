<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');


	class LocalidadeDAO extends CI_Model{

		public function __construct(){
			parent::__construct();

		}

        public function inserirEnderecoUser($obj, $user_cd) {
            $data= array();
            $consulta = $this->consultarCep($obj->loca_cep);

            if(!empty($consulta)){
                $data['loca_cd'] = $consulta[0]->loca_cd;
            }

            if(empty($data['loca_cd'])){
                $this->db->insert('Localidade', array('loca_lograd' => $obj->loca_lograd
                    ,'loca_bairro' => $obj->loca_bairro
                    ,'loca_cid' => $obj->loca_cid
                    ,'loca_cep' => $obj->loca_cep
                    ,'loca_uf' => $obj->loca_uf
                    ));
                $data['loca_cd'] = $this->db->insert_id();
            }

            $this->db->insert('Abriga', array('abri_user_cd' => $user_cd
            ,'abri_loca_cd' => $data['loca_cd']
            ,'abri_num' => $obj->loca_num
            ,'abri_comp' => $obj->loca_comp
            ));


        }

        public function inserirEnderecoEdicao($obj,$edic_cd){
            $data= array();
            $consulta = $this->consultarCep($obj->localidade->loca_cep);

            if(!empty($consulta)){
                $data['loca_cd'] = $consulta[0]->loca_cd;
            }

            if(empty($data['loca_cd'])){
                $this->db->insert('Localidade', array('loca_lograd' => $obj->localidade->loca_lograd
                    ,'loca_bairro' => $obj->localidade->loca_bairro
                    ,'loca_cid' => $obj->localidade->loca_cid
                    ,'loca_cep' => $obj->localidade->loca_cep
                    ,'loca_uf' => $obj->localidade->loca_uf
                    ));
                $data['loca_cd'] = $this->db->insert_id();
            }

            $this->db->insert('Sedia', array('sedi_edic_cd' => $edic_cd
            ,'sedi_loca_cd' => $data['loca_cd']
            ,'sedi_num' => $obj->sedia->loca_num
            ,'sedi_comp' => $obj->sedia->loca_comp
            ));
        }

        public function alterarEnderecoEdicao($obj,$edic_cd){
            $data= array();
            $consulta = $this->consultarCep($obj->loca_cep);

            if(!empty($consulta)){
                $data['loca_cd'] = $consulta[0]->loca_cd;
            }

            if(empty($data['loca_cd'])){
                $this->db->insert('Localidade', array('loca_lograd' => $obj->loca_lograd
                    ,'loca_bairro' => $obj->loca_bairro
                    ,'loca_cid' => $obj->loca_cid
                    ,'loca_cep' => $obj->loca_cep
                    ,'loca_uf' => $obj->loca_uf
                    ));
                $data['loca_cd'] = $this->db->insert_id();
            }else{
                $this->db->where('loca_cep', $obj->loca_cep);
                $this->db->update('Localidade', array('loca_lograd' => $obj->loca_lograd
                        ,'loca_bairro' => $obj->loca_bairro
                        ,'loca_cid' => $obj->loca_cid
                        ,'loca_cep' => $obj->loca_cep
                        ,'loca_uf' => $obj->loca_uf
                        ));
            }

            $this->db->where('sedi_edic_cd', $edic_cd);
            $this->db->update('Sedia', array(
                     'sedi_loca_cd' => $data['loca_cd']
                    ,'sedi_edic_cd' => $edic_cd
                    ,'sedi_num' => $obj->loca_num
                    ,'sedi_comp' => $obj->loca_comp
                    ));
        }

        public function alterarEnderecoUser($obj,$user_cd) {
            $data= array();
            $consulta = $this->consultarCep($obj->loca_cep);

            if(!empty($consulta)){
                $data['loca_cd'] = $consulta[0]->loca_cd;
            }

            if(empty($data['loca_cd'])){
                $this->db->insert('Localidade', array('loca_lograd' => $obj->loca_lograd
                    ,'loca_bairro' => $obj->loca_bairro
                    ,'loca_cid' => $obj->loca_cid
                    ,'loca_cep' => $obj->loca_cep
                    ,'loca_uf' => $obj->loca_uf
                    ));
                $data['loca_cd'] = $this->db->insert_id();
            }else{
                $this->db->where('loca_cep', $obj->loca_cep);
                $this->db->update('Localidade', array('loca_lograd' => $obj->loca_lograd
                        ,'loca_bairro' => $obj->loca_bairro
                        ,'loca_cid' => $obj->loca_cid
                        ,'loca_cep' => $obj->loca_cep
                        ,'loca_uf' => $obj->loca_uf
                        ));
            }

            $this->db->where('abri_user_cd', $user_cd);
            $this->db->update('Abriga', array(
                     'abri_loca_cd' => $data['loca_cd']
                    ,'abri_user_cd' => $user_cd
                    ,'abri_num' => $obj->loca_num
                    ,'abri_comp' => $obj->loca_comp
                    ));

        }

        public function consultarCep($cep) {
            $this->db->select("*");
            $this->db->from("Localidade");
            $this->db->where('Localidade.loca_cep',  $cep);
            $query = $this->db->get();
            return $query->result_object();
        }

        public function consultarCodigo($codigo){
            return null;
        }

        public function excluir($user_cd) {
        }



}
