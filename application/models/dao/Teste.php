<?php
	class Teste extends CI_Model{
		
		public function Teste(){
			parent::__construct();
		}

		


		public function create_table_User(){				
			$sql = "CREATE TABLE IF NOT EXISTS User(
				       usu_cd int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
			          ,usu_nm varchar(50) NOT NULL
			          ,usu_snm varchar(50) NOT NULL	
			          ,usu_email varchar(50) NOT NULL		          			          		          
			          ,usu_nacional varchar(50) NOT NULL
			          ,usu_nasc_dt date NOT NULL
			          ,usu_cid varchar(50) NOT NULL			          
			          ,usu_state varchar(50) NOT NULL			          	
			          ,usu_linke varchar(50) NOT NULL
			          ,usu_faceb varchar(50) NOT NULL
			          ,usu_fone int(11) NOT NULL
		    	    )";
			$this->db->query($sql);
		}



		public function create_table_Contato(){				
			$sql = "CREATE TABLE IF NOT EXISTS Contato(
				       cont_cd int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
			          ,cont_nm varchar(50)
			          ,cont_email varchar(50)			          
			          ,cont_msg text
			          ,cont_usu_cd int(11) NOT NULL
			          ,CONSTRAINT fk_contato FOREIGN KEY (cont_usu_cd) REFERENCES User (usu_cd) 			          			          			         
		    	    )";
			$this->db->query($sql);
		}




		public function create_table_Formacao(){				
			$sql = "CREATE TABLE IF NOT EXISTS Formacao(
				       form_cd int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
			          ,form_mestra varchar(50)
			          ,form_doutor varchar(50)			          
			          ,form_grad varchar(50)			          
			          ,form_certi varchar(50)
			          ,form_pales varchar(50)
			          ,form_curso varchar(50)
			          ,form_usu_cd int(11) NOT NULL
			          ,CONSTRAINT fK_Formacao FOREIGN KEY (form_usu_cd) REFERENCES User(usu_cd)
		    	    )";
			$this->db->query($sql);
		}



		public function create_table_Works(){				
		$sql = "CREATE TABLE IF NOT EXISTS Works(
		      work_cd int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
		     ,work_titulo varchar(50) NOT NULL
		     ,work_dt date	NOT NULL		          
		     ,work_tipo varchar(50) NOT NULL			          
		     ,work_ds varchar(50) NOT NULL
		     ,work_usu_cd int(11) NOT NULL			          
		     ,CONSTRAINT fK_Works FOREIGN KEY (work_usu_cd) REFERENCES User (usu_cd)	
			)";
		$this->db->query($sql);
		}



		public function create_table_Login(){				
			$sql = "CREATE TABLE IF NOT EXISTS Login(
				       logi_cd int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
			          ,logi_email varchar(50) NOT NULL			          		         
			          ,logi_pass varchar(50) NOT NULL			          			          
		    	    )";
			$this->db->query($sql);
		}

}
		

	