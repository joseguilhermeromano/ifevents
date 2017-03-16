<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
        
	class SubmitModel extends CI_Model{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/SubmitDAO');
            $this->load->library('upload');
            $this->load->helper('file');
            $this->load->helper('download');
		}
                
        public function setaValores(){
            $this->subm_user_cod=1;
            $this->subm_dt=date("y-m-d");
            $this->subm_hora=date("H:i");
            $this->subm_arq1=$this->upload_arquivo();
            $this->subm_status=0;
            $this->subm_arquivo_nm = $_FILES['userfile']['name'];
        }
        
                        
}										 			

