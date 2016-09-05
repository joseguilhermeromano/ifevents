<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class DataBaseDAO extends CI_Model{

		public function __construct(){

			parent::__construct();

		}

		//Método cria a tablea avaliação
		public function create_table_avaliacao(){
			$sql = "CREATE TABLE IF NOT EXISTS avaliacao(
					 	 aval_id        int(10) 	NOT NULL 
						,aval_submis    varchar(11) NOT NULL
						,aval_avaliador varchar(50) NOT NULL
						,aval_result    varchar(1)  NOT NULL

				   )";
			$this->db->query($sql);	
		}


		//Método cria a tabela avaliador
		public function create_table_avaliador(){
			$sql = "CREATE TABLE IF NOT EXISTS avaliador( 
					 	 avdr_id 		 int(10)  	  NOT NULL 
						,avdr_cpf 		 varchar(15)  NOT NULL 
						,avdr_rg 		 varchar(20)  NOT NULL
						,avdr_nm 		 varchar(50)  NOT NULL    
						,avdr_titu 		 varchar(100) NOT NULL 
						,avdr_inst_empr  varchar (50) NOT NULL 
						,avdr_area_inter varchar(50)  NOT NULL 
						,avdr_gradu 	 varchar(50)  NOT NULL 
						,avdr_fone 		 varchar(15)  NOT NULL
						,avdr_cel 		 varchar(15)  NOT NULL  
						,avdr_email 	 varchar(50)  NOT NULL
						,avdr_senha 	 varchar(35)  NOT NULL
						,avdr_dt_insc 	 datetime 	  NOT NULL 
						,avdr_tipo 		 varchar(1)   NOT NULL 
						,avdr_RA 		 varchar(7)   NOT NULL
						,avdr_cod_conf   varchar(14)  NOT NULL  
						,avdr_conf 		 tinyint(4)   NOT NULL 
						,avdr_link 		 varchar(200) NOT NULL
					
					)";

			$this->db->query($sql);			
		}

		//Método cria a tabela participante
		public function create_table_participante(){
			$sql = "CREATE TABLE IF NOT EXISTS participante(
					 	 part_id  		int(10)      NOT NULL 
						,part_cpf 		varchar(15)  NOT NULL
						,part_rg        varchar(20)  NOT NULL
						,part_nm        varchar(50)  NOT NULL
						,part_estado    varchar(2)   NOT NULL 
						,part_cid       varchar(30)  NOT NULL  
						,part_inst_empr varchar(100) NOT NULL  
						,part_fone 		varchar(15)  NOT NULL 
						,part_cel  		varchar(15)  NOT NULL 
						,part_email 	varchar(50)  NOT NULL 
						,part_senha 	varchar(35)  NOT NULL  
						,part_dt_insc 	datetime     NOT NULL 
						,part_tipo 		varchar(1)   NOT NULL 
						,part_RA 		varchar(7)   NOT NULL 
						,part_conf_cd 	varchar(14)  NOT NULL   
						,part_confdo 	tinyint(4)   NOT NULL  
						,part_avdr 		int(11)      NOT NULL  
						,part_adm 		int(11)      NOT NULL  
						,part_eventos 	TEXT(10000)  NOT NULL
					
					)";

			$this->db->query($sql);		

		}


		//Método cria a tabela submissão
		public function create_table_submissao(){
			$sql = "CREATE TABLE IF NOT EXISTS submissao(
					 	 subm_id          int(10)      NOT NULL  
					   	,subm_ra 	      varchar(11)  NOT NULL
						,subm_titulo   	  varchar(50)  NOT NULL
						,subm_autor 	  varchar(50)  NOT NULL 
						,subm_instituicao varchar(50)  NOT NULL 
						,subm_resumo      varchar(50)  NOT NULL  
						,subm_area        varchar(10)  NOT NULL 
						,subm_orientador  varchar(30)  NOT NULL 
						,subm_apoio       varchar(30)  NOT NULL 
						,subm_artigo      varchar(30)  NOT NULL 
						
					)";

			$this->db->query($sql);		

		}

		//Método cria a tabela users
		public function create_table_users(){
			$sql = "CREATE TABLE IF NOT EXISTS users(
						 user_id  		int(10)      NOT NULL 
						,user_cpf 		varchar(15)  NOT NULL
						,user_rg        varchar(20)  NOT NULL
						,user_nm        varchar(50)  NOT NULL
						,user_estado    varchar(2)   NOT NULL 
						,user_cid       varchar(30)  NOT NULL  
						,user_bairro	varchar(30)  NOT NULL 
						,user_inst_empr varchar(100) NOT NULL  
						,user_fone 		varchar(15)  NOT NULL 
						,user_cel  		varchar(15)  NOT NULL 
						,user_email 	varchar(50)  NOT NULL 
						,user_senha 	varchar(35)  NOT NULL  
						,user_dt_insc 	datetime     NOT NULL 
						,user_tipo 		varchar(1)   NOT NULL 
						,user_RA 		varchar(7)   NOT NULL 						 
						,user_conf_cd 	varchar(14)  NOT NULL   
						,user_confdo 	tinyint(4)   NOT NULL  
						,user_avdr 		int(11)      NOT NULL  
						,user_adm 		int(11)      NOT NULL  
						,user_eventos 	TEXT(10000)  NOT NULL
						 
					)";
			$this->db->query($sql);		

		}

}