	<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class DataBaseDAO extends CI_Model{

		public function __construct(){
			parent::__construct();
			$this->load->database();
				$this->create_table_tipo_funcao();
				$this->create_table_tipo_atividade();
				$this->create_table_conferencia();
				$this->create_table_instituicao();
				$this->create_table_regra();
				$this->create_table_comite();
				$this->create_table_localidade();
				$this->create_table_tipo_parceria();
				$this->create_table_status();
				$this->create_table_modalidade_tematica();
				$this->create_table_atividade();
				$this->create_table_edicao();
				$this->create_table_organiza();
				$this->create_table_sedia();
				$this->create_table_artigo();
				$this->create_table_usuario();
				$this->create_table_participa();
				$this->create_table_pertence();
				$this->create_table_autoria();
				$this->create_table_contato();
				$this->create_table_email();
				$this->create_table_telefone();
				$this->create_table_executa();
				$this->create_table_abriga();
				$this->create_table_apoia();
				$this->create_table_submissao();
				$this->create_table_avaliacao();
				$this->create_table_contem();
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


		//Método cria a tabela Tipo_Funcao 01
		public function create_table_tipo_funcao(){
			$sql ="CREATE TABLE IF NOT EXISTS Tipo_Funcao(
					 tifu_cd   int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,tifu_nm   varchar(100) NOT NULL
					,tifu_desc varchar(500) NOT NULL
			) ENGINE = INNODB";
			$this->db->query($sql);
		}


		//Método cria a tabela Tipo_atividade
		public function create_table_tipo_atividade(){
			$sql ="CREATE TABLE IF NOT EXISTS Tipo_atividade(
					 tiat_cd   int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,tiat_nm   varchar(100) NOT NULL
					,tiat_desc varchar(500) NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela Conferencia
		public function create_table_conferencia(){
			$sql = "CREATE TABLE IF NOT EXISTS Conferencia(
					conf_cd   int(11)      NOT NULL  PRIMARY KEY AUTO_INCREMENT
				   ,conf_nm   varchar(100) NOT NULL
				   ,conf_desc varchar(500) NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela Instituicao
		public function create_table_instituicao(){
			$sql = "CREATE TABLE IF NOT EXISTS Instituicao (
					 inst_cd   int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,inst_nm   varchar(100) NOT NULL
					,inst_desc varchar(500) NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela Regra
		public function create_table_regra(){
			$sql = "CREATE TABLE IF NOT EXISTS Regra(
					 regr_cd 			   int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT
					,regr_insc_ini_dt      date    NOT NULL
					,regr_insc_fin_dt      date    NOT NULL
					,regr_subm_abert       date    NOT NULL
					,regr_subm_encerr      date    NOT NULL
					,regr_even_ini_dt      date    NOT NULL
					,regr_even_fin_dt      date    NOT NULL
					,regr_pub_ini_dt       date    NOT NULL
					,regr_pub_fin_dt       date    NOT NULL
					,regr_max_aval_qtd     int(3)  NOT NULL
					,regr_max_subm_qtd     int(3)  NOT NULL
					,regr_prazo_resp_autor date    NOT NULL
					,regr_prazo_resp_aval  date    NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela Comite
		public function create_table_comite(){
			$sql = "CREATE TABLE IF NOT EXISTS Comite(
					 comi_cd   int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,comi_nm   varchar(100) NOT NULL
					,comi_desc varchar(500) NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}



		//Método cria tabela Localidade
		public function create_table_localidade(){
			$sql = "CREATE TABLE IF NOT EXISTS Localidade (
					 loca_cd     int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,loca_lograd varchar(200) NOT NULL
					,loca_bairro varchar(100) NOT NULL
					,loca_num    varchar(9)   NOT NULL
					,loca_cep    varchar(9)   NOT NULL
					,loca_cid    varchar(100) NOT NULL
					,loca_uf     varchar(2)   NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela Tipo_parceria
		public function create_table_tipo_parceria(){
			$sql = "CREATE TABLE IF NOT EXISTS Tipo_parceria (
					 tipa_cd   int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,tipa_nm   varchar(100) NOT NULL
					,tipa_desc varchar(500) NOT NULL
				    ) ENGINE=INNODB";
			$this->db->query($sql);
		}



		//Método cria tabela Status
		public function create_table_status(){
			$sql = "CREATE TABLE IF NOT EXISTS Status (
					 stat_cd   int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,stat_nm   varchar(100) NOT NULL
					,stat_desc varchar(500) NOT NULL
		    ) ENGINE=INNODB";
			$this->db->query($sql);
		}



		//Método cria tabela Modalidade_Tematica
		public function create_table_modalidade_tematica(){
			$sql = "CREATE TABLE IF NOT EXISTS Modalidade_Tematica (
					 mote_cd   int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,mote_nm   varchar(100) NOT NULL
					,mote_desc varchar(500) NOT NULL
					,mote_tipo varchar(100) NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria a tabela Atividade
		public function create_table_atividade(){
			$sql = "CREATE TABLE IF NOT EXISTS Atividade(
					 ativ_cd        int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,ativ_nm        varchar(100) NOT NULL
					,ativ_desc      varchar(500) NOT NULL
					,ativ_dt        date         NOT NULL
					,ativ_hora_ini  timestamp    NOT NULL
					,ativ_hora_fin  timestamp    NOT NULL
					,ativ_local     varchar(200) NOT NULL
					,ativ_vagas_qtd int(3)       NOT NULL
					,ativ_tiat_cd   int(11)      NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);

		}


		//Método cria tabela Edicao
		public function create_table_edicao(){
			$sql = "CREATE TABLE IF NOT EXISTS Edicao(
					 edic_cd       int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,edic_anais    varchar(500) NOT NULL
					,edic_link     varchar(200) NOT NULL
					,edic_img      varchar(200) NOT NULL
					,edic_nm       varchar(100) NOT NULL
					,edic_num      int(3)       NOT NULL
					,edic_abrev    varchar(9)   NOT NULL
					,edic_apresent varchar(500) NOT NULL
					,edic_subm_dir varchar(100) NOT NULL
					,edic_result   varchar(100) NOT NULL
					,edic_regr_cd  int(11)      NOT NULL
					,edic_comi_cd  int(11)      NOT NULL
					,edic_conf_cd  int(11)      NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);

		}



		//Método cria a tabela Organiza
		public function create_table_organiza(){
			$sql = "CREATE TABLE IF NOT EXISTS Organiza(
			 		 orga_ativ_cd int(11)
					,orga_edic_cd int(11)
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela sedia
		public function create_table_sedia(){
			$sql = "CREATE TABLE IF NOT EXISTS Sedia(
					 sedi_edic_cd int(11) NOT NULL
					,sedi_loca_cd int(11) NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela Artigo
		public function create_table_artigo(){
			$sql = "CREATE TABLE IF NOT EXISTS Artigo(
					 arti_cd         int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,arti_title      varchar(100) NOT NULL
					,arti_orienta    varchar(100) NOT NULL
					,arti_resumo     varchar(500) NOT NULL
					,arti_pal_chaves varchar(100) NOT NULL
					,arti_arq_fin    mediumblob
					,arti_status     varchar(9)   NOT NULL
					,arti_mote_cd    int(11)      NOT NULL
					,arti_stat_cd    int(11)      NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}



		//Método cria tabela Usuario
		public function create_table_usuario(){
			$sql = "CREATE TABLE IF NOT EXISTS User(
					 user_cd          int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,user_nm          varchar(100) NOT NULL
					,user_tipo        varchar(2)   NOT NULL
					,user_instituicao varchar(100) NOT NULL
					,user_biograf     varchar(500) NOT NULL
					,user_pass        varchar(9)   NOT NULL
					,user_email_vali  varchar(100) NOT NULL
					,user_stat_cd     int(11)      NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
			//$consulta = $this->db->query("SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = 'eventos' AND TABLE_NAME = 'User' AND REFERENCED_TABLE_NAME IS NOT NULL");
			//$this->db->query("ALTER TABLE User ADD CONSTRAINT fk_stat_cd FOREIGN KEY(user_stat_cd)  REFERENCES Status (stat_cd)");
		}


		//Método cria tabela participante
		public function create_table_participa(){
			$sql = "CREATE TABLE IF NOT EXISTS Participa(
					 parti_cd    int(11)      NOT NULL
					,parti_func varchar(100) NOT NULL
					,comi_cd    int(11)      NOT NULL
					,user_cd    int(11)      NOT NULL
					,PRIMARY KEY(comi_cd,user_cd,parti_cd)
			) ENGINE=INNODB";
			$this->db->query($sql);
		}



		//Método cria tabela pertence
		public function create_table_pertence(){
			$sql = "CREATE TABLE IF NOT EXISTS Pertence(
					 pert_user_cd int(11) NOT NULL
					,pert_inst_cd int(11) NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}



		//Método cria tabela Autoria
		public function create_table_autoria(){
			$sql = "CREATE TABLE IF NOT EXISTS Autoria (
					 autor_respons tinyint
					,auto_user_cd int(11) NOT NULL
					,auto_arti_cd int(11)  NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}



		//Método cria tabela Contato
		public function create_table_contato(){
			$sql = "CREATE TABLE IF NOT EXISTS Contato (
					 cont_cd      int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,cont_nm      varchar(100) NOT NULL
					,cont_assunto varchar(100) NOT NULL
					,cont_email   varchar(100) NOT NULL
					,cont_msg     varchar(500) NOT NULL
					,cont_user_cd int(11)      NOT NULL
		    ) ENGINE=INNODB";
			$this->db->query($sql);
		}



		//Método cria tabela Email
		public function create_table_email(){
			$sql = "CREATE TABLE IF NOT EXISTS Email (
					 email_cd        int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,email_email     varchar(100) NOT NULL
					,email_principal tinyint
					,email_user_cd   int(11)      NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela Telefone
		public function create_table_telefone(){
			$sql = "CREATE TABLE IF NOT EXISTS Telefone (
					 tele_cd        int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT
					,tele_fone      varchar(15) NOT NULL
					,tele_user_cd   int(11)     NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela Executa
		public function create_table_executa(){
			$sql = "CREATE TABLE IF NOT EXISTS Executa (
					 exec_tipo      varchar(100) NOT NULL
					,exec_presen    varchar(2)   NOT NULL
					,exec_certifica mediumblob   NOT NULL
					,exec_user_cd   int(11)		 NOT NULL
					,exec_ativ_cd   int(11)      NOT NULL
				) ENGINE=INNODB";
				$this->db->query($sql);
		}



		//Método cria tabela Abriga
		public function create_table_abriga(){
			$sql = "CREATE TABLE IF NOT EXISTS Abriga (
					  abri_user_cd int(11)  NOT NULL
					 ,abri_loca_cd int(11) NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela Apoia
		public function create_table_apoia(){
			$sql = "CREATE TABLE IF NOT EXISTS Apoia (
					 apoia_represent varchar(500) NOT NULL
					,apoia_logo      varchar(200) NOT NULL
					,inst_cd         int(11)      NOT NULL
					,edic_cd         int(11)      NOT NULL
					,tipa_cd         int(11)      NOT NULL
					,PRIMARY KEY(inst_cd,edic_cd,tipa_cd)
			) ENGINE=INNODB";
			$this->db->query($sql);
		}


		//Método cria tabela Submissao
		public function create_table_submissao(){
			$sql = "CREATE TABLE IF NOT EXISTS Submissao (
					 subm_cd      int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT
					,subm_dt      date        NOT NULL
					,subm_arq     mediumblob
					,subm_horario timestamp   NOT NULL
					,subm_arti_cd int(11)     NOT NULL
					,subm_user_cd int(11)     NOT NULL
					,subm_stat_cd int(11)     NOT NULL
			) ENGINE=INNODB";
			$this->db->query($sql);
		}



		//Método cria tabela Avaliacao
		public function create_table_avaliacao(){
			$sql = "CREATE TABLE IF NOT EXISTS Avaliacao (
					 aval_cd      int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
					,aval_desc    varchar(500) NOT NULL
					,aval_nota    float(2, 2)  NOT NULL
					,aval_dt      date         NOT NULL
					,aval_horario timestamp    NOT NULL
					,aval_arq     mediumblob
					,aval_stat_cd int(11)      NOT NULL
					,aval_user_cd int(11)      NOT NULL
					,aval_subm_cd int(11)      NOT NULL
		    ) ENGINE=INNODB";
			$this->db->query($sql);
		}



		//Método cria tabela Contem
		public function create_table_contem(){
			$sql = "CREATE TABLE IF NOT EXISTS Contem (
					 conta_mote_cd int(11) NOT NULL
					,conta_edic_cd int(11) NOT NULL
		    ) ENGINE=INNODB";
			$this->db->query($sql);
		}


/*
		//Método cria declarações de alteração nas tabelas
		public function declaration(){
			$sql = "
					ALTER TABLE Organiza  ADD CONSTRAINT fk_edic_cd FOREIGN KEY(orga_edic_cd)  REFERENCES Edicao (edic_cd);
					ALTER TABLE Edicao    ADD CONSTRAINT fk_regr_cd FOREIGN KEY(edic_regr_cd)  REFERENCES Regra (regr_cd);
					ALTER TABLE Edicao    ADD CONSTRAINT fk_comi_cd FOREIGN KEY(edic_comi_cd)  REFERENCES Comite (comi_cd);
					ALTER TABLE Sedia     ADD CONSTRAINT fk_loca_cd FOREIGN KEY(sedi_loca_cd)  REFERENCES Localidade (loca_cd);
					ALTER TABLE Artigo    ADD CONSTRAINT fk_mote_cd FOREIGN KEY(arti_mote_cd)  REFERENCES Modalidade_Tematica (mote_cd);
					ALTER TABLE Artigo    ADD CONSTRAINT fk_stat_cd FOREIGN KEY(arti_stat_cd)  REFERENCES Status (stat_cd);
					ALTER TABLE Pertence  ADD CONSTRAINT fk_user_cd FOREIGN KEY(pert_user_cd)  REFERENCES User (user_cd);
					ALTER TABLE Pertence  ADD CONSTRAINT fk_inst_cd FOREIGN KEY(pert_inst_cd)  REFERENCES Instituicao (inst_cd);
					ALTER TABLE Autoria   ADD CONSTRAINT fk_user_cd FOREIGN KEY(auto_user_cd)  REFERENCES User (user_cd);
					ALTER TABLE Contato   ADD CONSTRAINT fk_user_cd FOREIGN KEY(cont_user_cd)  REFERENCES User (user_cd);
					ALTER TABLE Email     ADD CONSTRAINT fk_user_cd FOREIGN KEY(email_user_cd) REFERENCES User (user_cd);
					ALTER TABLE Telefone  ADD CONSTRAINT fk_user_cd FOREIGN KEY(tele_user_cd)  REFERENCES User (user_cd);
					ALTER TABLE Executa   ADD CONSTRAINT fk_user_cd FOREIGN KEY(exec_user_cd)  REFERENCES User (user_cd);
					ALTER TABLE User   	  ADD CONSTRAINT fk_stat_cd FOREIGN KEY(user_stat_cd)  REFERENCES Status (stat_cd);
					ALTER TABLE Avaliacao ADD CONSTRAINT fk_subm_cd FOREIGN KEY(aval_subm_cd)  REFERENCES Submissao (subm_cd);
					ALTER TABLE Contem    ADD CONSTRAINT fk_mote_cd FOREIGN KEY(conta_mote_cd) REFERENCES Modalidade_Tematica (mote_cd);";

				   $this->db->query($sql);
		}*/
}
