<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class DataBaseDAO extends CI_Model{

		public function __construct(){

			parent::__construct();
			$this->load->database();
                        $this->create_table_artigo();
                        $this->create_table_avaliacao();
                        $this->create_table_ci_session();
                        $this->create_table_comite();
                        $this->create_table_conferencia();
                        $this->create_table_contato();
                        $this->create_table_edicao();
                        $this->create_table_endereco();
                        $this->create_table_metodos();
                        $this->create_table_modalidade_tematica();
                        $this->create_table_parceria();
                        $this->create_table_permissoes();
                        $this->create_table_regra();
                        $this->create_table_submissao();
                        $this->create_table_user();

		}

		//Método cria a tabela login 
		/*public function create_table_login(){
			$sql = "CREATE TABLE IF NOT EXISTS Login(
						 logi_id    int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT
						,logi_email varchar(50) NOT NULL
						,logi_pass  varchar(15) NOT NULL
						
					)";


			$this->db->query($sql);			
		}*/
		
		//Método cria a tabela user
		public function create_table_user(){
			$sql = "CREATE TABLE IF NOT EXISTS User(
						 user_id        int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
						,user_nm        varchar(50)  NOT NULL						
						,user_fone      varchar(15)  NOT NULL								
						,user_ins_emp   varchar(100) NOT NULL
						,user_email     varchar(50)  NOT NULL
						,user_pass      varchar(15)  NOT NULL
						,user_tipo      varchar(1)   NOT NULL
						,user_val_email varchar(10)  NOT NULL
						,user_status    varchar(2)   NOT NULL
                                                ,user_logradouro varchar(50) 
						,user_bairro    varchar(15) 
                                                ,user_numero    varchar(5)
                                                ,user_complemento varchar(15)
                                                ,user_cep       varchar(15)
                                                ,user_cidade    varchar(50)
                                                ,user_uf        varchar(2)
					)";
					$this->db->query($sql);			
		}
		
		//Método cria a tabela avaliador
		/*public function create_table_avaliador(){
			$sql = "CREATE TABLE IF NOT EXISTS Avaliador( 
					 	 avdo_id      int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
						,avdo_ar_int  varchar(50)  NOT NULL
						,avdo_titu    varchar(100) NOT NULL
						,avdo_grad    varchar(50)  NOT NULL
						,avdo_user_id int(10)      NOT NULL
						
					)";

			$this->db->query($sql);			
		}*/

		//Método cria a tabela avaliação
		public function create_table_avaliacao(){
			$sql = "CREATE TABLE IF NOT EXISTS Avaliacao(
					 	 aval_user_id int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
						,aval_decs    varchar(100) NOT NULL
						,aval_dt      date         NOT NULL
						,aval_hora    varchar(15)  NOT NULL
						,aval_arq1    mediumblob   NOT NULL	
						,aval_arq2	  mediumblob   NOT NULL
						,aval_status  int(1)       NOT NULL					

				   )";
			$this->db->query($sql);	
		}

		//Método cria tabela submissão
		public function create_table_submissao(){
			$sql = "CREATE TABLE IF NOT EXISTS Submissao(
						 subm_id       int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
						,subm_user_cod int(11)    NOT NULL
						,subm_arti_cod int(11)    NOT NULL
                                                ,subm_arquivo_nm   VARCHAR(50)NOT NULL
						,subm_dt  	   DATE       NOT NULL
						,subm_hora	   TIME       NOT NULL
						,subm_arq1	   mediumblob NOT NULL
						,subm_status        int(1)     NOT NULL   
					)";
					$this->db->query($sql);
		}

		//Método cria a tabela artigo
		public function create_table_artigo(){
                    $sql = "CREATE TABLE IF NOT EXISTS Artigo(
                                arti_id     int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT	
                               ,arti_nm     varchar(50)  NOT NULL			 	 
                               ,arti_autor  varchar(50)  NOT NULL
                               ,arti_titu   varchar(50)  NOT NULL
                               ,arti_inst   varchar(50)  NOT NULL			
                               ,arti_orie   varchar(50)  NOT NULL
                               ,arti_eite   int(11)      NOT NULL
                               ,arti_moda   int(11)      NOT NULL
                               ,arti_subm_final   mediumblob   NOT NULL						
                               ,arti_resu   varchar(200) NOT NULL
                               ,arti_apoio  varchar(30)  NOT NULL
                               ,arti_user_id int(11)      NOT NULL
                               ,arti_status int(1)      NOT NULL
                            )";

                    $this->db->query($sql);		

		}

		//Método cria a tabela contato
		public function create_table_contato(){
			$sql = "CREATE TABLE IF NOT EXISTS Contato(
						 cont_id       int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT						 	
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
						 conf_id	int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT
						,conf_nm 	varchar(50) NOT NULL 
						,conf_desc  varchar(80) NOT NULL
			)";
			$this->db->query($sql);
		}

		//Método cria tabela edição
		public function create_table_edicao(){
			$sql = "CREATE TABLE IF NOT EXISTS Edicao(
						 edic_id        int(11)   	 NOT NULL PRIMARY KEY AUTO_INCREMENT
						,edic_nm        varchar(100) NOT NULL
						,edic_abrev     varchar(10)  NOT NULL 
						,edic_apres     varchar(200) NOT NULL
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
						 comi_id         int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
						 ,comi_organizad varchar(200) NOT NULL
						,comi_desc 		 varchar(200) NOT NULL
					)";
					$this->db->query($sql);
		}

		//Método cria tabela parceria
		public function create_table_parceria(){
			$sql = "CREATE TABLE IF NOT EXISTS Parceria(
						 parc_id   int(11)       NOT NULL PRIMARY KEY AUTO_INCREMENT
						,parc_nm   varchar(50)   NOT NULL
						,parc_desc varchar(100)  NOT NULL
						,parc_logo mediumblob 	 NOT NULL
					)";
					$this->db->query($sql);
		}

		//Método cria tabela regra
		public function create_table_regra(){
			$sql = "CREATE TABLE IF NOT EXISTS Regra(
						 regr_id            int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT
						,regr_dt_ini_insc   date        NOT NULL
						,regr_dt_fin_insc   date        NOT NULL
						,regr_dt_subm_abert date        NOT NULL
						,regr_dt_subm_encer date        NOT NULL
						,regr_dt_even_ini   date        NOT NULL
						,regr_dt_even_fin   date        NOT NULL
						,regr_dt_pub_ini 	date        NOT NULL
						,regr_dt_pub_fin 	date        NOT NULL
						,regr_qtd_max_aval 	int(2)      NOT NULL
						,regr_qtd_max_subm  int(2)      NOT NULL
						,regr_resp_aval		int(3)      NOT NULL
						,regr_resp_autor 	int(3)      NOT NULL	
				  	)";
					$this->db->query($sql);
		}

		//Método cria tabela endereco
		public function create_table_endereco(){
			$sql = "CREATE TABLE IF NOT EXISTS Endereco(
						 ende_id     int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
						,ende_lograd varchar(100) NOT NULL
						,ende_bairro varchar(50)  NOT NULL
						,ende_num    varchar(10)  NOT NULL
						,ende_compl	 varchar(50)  NOT NULL
						,ende_cp     varchar(10)  NOT NULL
						,ende_cid    varchar(50)  NOT NULL
						,ende_uf     varchar(4)   NOT NULL   
 					)";
					$this->db->query($sql);
		}

		//Método cria tabela modalidade tematica
		public function create_table_modalidade_tematica(){
			$sql = "CREATE TABLE IF NOT EXISTS Modalidade_Tematica(
						 mote_id   int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
						,mote_nm   varchar(100) NOT NULL
						,mote_desc varchar(200) NOT NULL
						,mote_tipo int(1)		NOT NULL
					)";
					$this->db->query($sql);
		}

		

		//Método cria a tabela sessions
		public function create_table_ci_session(){
			$sql = "CREATE TABLE IF NOT EXISTS ci_sessions(
						 id varchar(40) DEFAULT '0' NOT NULL
						,ip_address varchar(16) DEFAULT '0' NOT NULL
						,timestamp int(10) unsigned DEFAULT 0 NOT NULL						
						,data text NOT NULL
						,PRIMARY KEY(id)
						
					)";
					$this->db->query($sql);
		}

		
		//Método cria a tabela metodos
		public function create_table_metodos(){
			$sql = "CREATE TABLE IF NOT EXISTS metodos(
						id int(11) unsigned NOT NULL AUTO_INCREMENT,
  						classe varchar(50) DEFAULT NULL,
  						metodo varchar(50) DEFAULT NULL,
  						identificacao varchar(100) DEFAULT NULL,
  						privado tinyint(1) DEFAULT NULL,
  						 PRIMARY KEY (id)
						
					)";
					$this->db->query($sql);
		}


		//Método cria a tabela permissões
		public function create_table_permissoes(){
			$sql = "CREATE TABLE IF NOT EXISTS permissoes(
						id int(11) unsigned NOT NULL AUTO_INCREMENT,
  						id_metodo int(11) DEFAULT NULL,
  						id_usuario int(11) DEFAULT NULL,
  						PRIMARY KEY (id)
						
					)";
					$this->db->query($sql);
		}



}