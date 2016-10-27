<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class DataBaseDAO extends CI_Model{

		public function __construct(){

			parent::__construct();

		}

		//Método cria a tabela login 
		public function create_table_login(){
			$sql = "CREATE TABLE IF NOT EXISTS Login(
						 logi_id    int(10)     NOT NULL PRIMARY KEY AUTO_INCREMENT
						,logi_email varchar(50) NOT NULL
						,logi_pass  varchar(15) NOT NULL
						
					)";


			$this->db->query($sql);			
		}
		
		//Método cria a tabela user
		public function create_table_user(){
			$sql = "CREATE TABLE IF NOT EXISTS User(
						 user_id      int(10)           NOT NULL PRIMARY KEY AUTO_INCREMENT
						,user_nm      varchar(50)       NOT NULL						
						,user_fone    varchar(15)  	    NOT NULL
						,user_bio	  varchar(50)		NOT NULL			
						,user_ins_emp varchar(100)      NOT NULL
						,user_email     varchar(50)     NOT NULL
						,user_pass      varchar(15)     NOT NULL
						,user_tipo      varchar(1)      NOT NULL
						,user_val_email 	varchar(10) NOT NULL
						,user_status        varchar(2)  NOT NULL
						
					)";
					$this->db->query($sql);			
		}
		
		//Método cria a tabela avaliador
		public function create_table_avaliador(){
			$sql = "CREATE TABLE IF NOT EXISTS Avaliador( 
					 	 avdo_id      int(10)      NOT NULL PRIMARY KEY AUTO_INCREMENT
						,avdo_ar_int  varchar(50)  NOT NULL
						,avdo_titu    varchar(100) NOT NULL
						,avdo_grad    varchar(50)  NOT NULL
						,avdo_user_id int(10)      NOT NULL
						
					)";

			$this->db->query($sql);			
		}

		//Método cria a tabela avaliação
		public function create_table_avaliacao(){
			$sql = "CREATE TABLE IF NOT EXISTS Avaliacao(
					 	 aval_id      int(10)      NOT NULL PRIMARY KEY AUTO_INCREMENT
						,aval_rs      varchar(1)   NOT NULL
						,aval_av      varchar(50)  NOT NULL
						,aval_sb      varchar(15)  NOT NULL
						,aval_avdo_id int(10)      NOT NULL						

				   )";
			$this->db->query($sql);	
		}

		//Método cria a tabela artigo
		public function create_table_artigo(){
			$sql = "CREATE TABLE IF NOT EXISTS Artigo(
					 	 arti_id      int(10)      NOT NULL PRIMARY KEY AUTO_INCREMENT	
					 	,arti_ra 	  varchar(7)   NOT NULL	
					 	,arti_nm 	  varchar(50)  NOT NULL			 	 
						,arti_autor   varchar(50)  NOT NULL
						,arti_titul   varchar(50)  NOT NULL
						,arti_inst    varchar(50)  NOT NULL			
						,arti_ori     varchar(50)  NOT NULL
						,arti_are     varchar(50)  NOT NULL
						,arti_subm    mediumblob   NOT NULL						
						,arti_res     varchar(200) NOT NULL
						,arti_apoio   varchar(30)  
						,arti_user_id int(10)      
						,arti_avdo_id int(10)    
						
					)";

			$this->db->query($sql);		

		}

		//Método cria a tabela contato
		public function create_table_contato(){
			$sql = "CREATE TABLE IF NOT EXISTS Contato(
						 cont_id       int(10)      NOT NULL PRIMARY KEY AUTO_INCREMENT						 	
					 	,cont_nm 	  varchar(50)  NOT NULL			 	 
						,cont_email   varchar(80)  NOT NULL
						,cont_assunto varchar(50)  NOT NULL
						,cont_mens    varchar(200) NOT NULL									    						
					)";
					$this->db->query($sql);		
		}

		//Método cria tabela conferência
		public function create_table_conferencia(){
			$sql = "CREATE TABLE IF NOT EXISTS Conferencia(
						 conf_cod	int(10)     NOT NULL PRIMARY KEY AUTO_INCREMENT
						,conf_nm 	varchar(50) NOT NULL 
						,conf_desc  varchar(80) NOT NULL
			)";
			$this->db->query($sql);
		}

		//Método cria tabela edição
		public function create_table_edicao(){
			$sql = "CREATE TABLE IF NOT EXISTS Edicao(
						 edic_cod int(10)        	 NOT NULL PRIMARY KEY AUTO_INCREMENT
						,edic_nm  varchar(100)   	 NOT NULL
						,edic_abrev varchar(10)  	 NOT NULL 
						,edic_apres varchar(200) 	 NOT NULL
						,edic_info_subm varchar(200) NOT NULL
						,edic_anais_ev	mediumblob	 NOT NULL
						,edic_ev_img 	mediumblob   NOT NULL
						,edic_ev_link 	varchar(100) NOT NULL
					)";
					$this->db->query($sql);
		}

		//Método cria tabela comitê
		public function create_table_comite(){
			$sql = "CREATE TABLE IF NOT EXISTS Comite(
						 comi_cod int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT
						,comi_organizad varchar(200) NOT NULL
						,comi_desc 		varchar(200) NOT NULL
					)";
					$this->db->query($sql);
		}


}