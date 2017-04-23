<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class RegraDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();
            $this->load->helper('html');
		}
                
                public function inserir($obj) {
                    $this->db->insert('Regra',
                     array(
                        'regr_even_ini_dt' => converteDataMysql($obj->regr_even_ini_dt)
                        ,'regr_even_fin_dt' => converteDataMysql($obj->regr_even_fin_dt)
                        ,'regr_pub_ini_dt' => converteDataMysql($obj->regr_pub_ini_dt)
                        ,'regr_pub_fin_dt' => converteDataMysql($obj->regr_pub_fin_dt)
                        ,'regr_insc_ini_dt' => converteDataMysql($obj->regr_insc_ini_dt)
                        ,'regr_insc_fin_dt' => converteDataMysql($obj->regr_insc_fin_dt)
                        ,'regr_subm_abert' => converteDataMysql($obj->regr_subm_abert)
                        ,'regr_subm_encerr' => converteDataMysql($obj->regr_subm_encerr)
                        ,'regr_qtd_min_subm_aval' => $obj->regr_qtd_min_subm_aval
                        ,'regr_prazo_resp_autor' => $obj->regr_prazo_resp_autor
                        ,'regr_prazo_resp_aval' => $obj->regr_prazo_resp_aval
                        ,'regr_dire_subm' => $obj->regr_dire_subm
                        ,'regr_dire_aval' => $obj->regr_dire_aval
                        ));
                    return $this->db->insert_id();
                }
                
                public function alterar($obj) {
                    $this->db->where('regra_id', $obj->regra_id);
                    return $this->db->update('regra', $obj);
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo($codigo){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('regra_id', $obj->regra_id);
                    return $this->db->delete('regra');
                }

                

}

