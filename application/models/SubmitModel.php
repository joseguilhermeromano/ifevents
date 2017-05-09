<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
        
	class SubmitModel extends CI_Model{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/SubmitDAO');
		}
                
        public function setaValores($file_1, $file_2, $artigo_cd){
            $this->subm_arti_cd = $artigo_cd;
            $this->subm_versao = $this->SubmitDAO->totalRegistros($artigo_cd) + 1;
            $this->subm_dt = date("y-m-d");
            $this->subm_hr = date("H:i");
            $this->subm_arq1_nm =  $file_1['file_nm'];
            $this->subm_arq1 = $file_1['file'];
            $this->subm_arq2_nm = $file_2['file_nm'];
            $this->subm_arq2 = $file_2['file'];
        }
        
                        
}										 			

