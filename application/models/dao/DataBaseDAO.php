<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class DataBaseDAO extends CI_Model{

        public function __construct(){
            parent::__construct();
            $this->load->database(); 			       
            $this->create_table_tipo_atividade();      
            $this->create_table_conferencia();
            $this->create_table_instituicao();         
            $this->create_table_regra();
            $this->create_table_comite(); 		       
            $this->create_table_localidade(); 	   
            $this->create_table_modalidade_tematica(); 
            $this->create_table_mote_revisor();
            $this->create_table_atividade(); 	       
            $this->create_table_edicao();
            $this->create_table_edicao_revisor(); 
            $this->create_table_sedia();               
            $this->create_table_artigo();
            $this->create_table_usuario(); 		                  
            $this->create_table_autoria();
            $this->create_table_contato();             
            $this->create_table_email();
            $this->create_table_telefone(); 	       
            $this->create_table_abriga();              
            $this->create_table_apoia();
            $this->create_table_submissao();           
            $this->create_table_avaliacao();             
            $this->create_table_metodo();
            $this->create_table_permissao();           
            $this->create_table_tipo_usuario();
            $this->create_table_Inscricao();
        }


        //Método cria a tabela Tipo_atividade
        public function create_table_tipo_atividade(){
                $sql ="CREATE TABLE IF NOT EXISTS Tipo_atividade(
                        tiat_cd    int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,tiat_nm   varchar(100) NOT NULL
                        ,tiat_desc varchar(500) NOT NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Conferencia
        public function create_table_conferencia(){
                $sql = "CREATE TABLE IF NOT EXISTS Conferencia(
                        conf_cd     int(11)      NOT NULL  PRIMARY KEY AUTO_INCREMENT
                        ,conf_nm    varchar(100) NOT NULL
                        ,conf_desc  varchar(500) NOT NULL
                        ,conf_abrev varchar(50)  NOT NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Instituicao
        public function create_table_instituicao(){
                $sql = "CREATE TABLE IF NOT EXISTS Instituicao (
                        inst_cd     int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,inst_nm    varchar(100) NOT NULL
                        ,inst_abrev varchar(10)
                        ,inst_desc  varchar(500) NOT NULL
                        ,inst_logo  varchar(200) NOT NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Regra
        public function create_table_regra(){
                $sql = "CREATE TABLE IF NOT EXISTS Regra(
                        regr_cd   			    int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,regr_even_ini_dt       date    NOT NULL
                        ,regr_even_fin_dt       date    NOT NULL
                        ,regr_pub_ini_dt        date    NOT NULL
                        ,regr_pub_fin_dt        date    NOT NULL
                        ,regr_insc_ini_dt       date    NOT NULL
                        ,regr_insc_fin_dt       date    NOT NULL
                        ,regr_subm_abert        date    NULL
                        ,regr_subm_encerr       date    NULL
                        ,regr_prazo_resp_autor  int(3)  NULL
                        ,regr_prazo_resp_aval   int(3)  NULL
                        ,regr_dire_subm			mediumblob NULL
                        ,regr_dire_aval			mediumblob NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Comite
        public function create_table_comite(){
                $sql = "CREATE TABLE IF NOT EXISTS Comite(
                        comi_cd    int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,comi_nm   varchar(100) NOT NULL
                        ,comi_desc varchar(500) NOT NULL
                        ,comi_equipe text       NOT NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Localidade
        public function create_table_localidade(){
                $sql = "CREATE TABLE IF NOT EXISTS Localidade (
                        loca_cd      int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,loca_lograd varchar(200) NOT NULL
                        ,loca_bairro varchar(100) NOT NULL
                        ,loca_cep    varchar(9)   NOT NULL
                        ,loca_cid    varchar(100) NOT NULL
                        ,loca_uf     varchar(2)   NOT NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Modalidade_Tematica
        public function create_table_modalidade_tematica(){
                $sql = "CREATE TABLE IF NOT EXISTS Modalidade_Tematica (
                        mote_cd    int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,mote_nm   varchar(100) NOT NULL
                        ,mote_desc varchar(500) NOT NULL
                        ,mote_tipo varchar(100) NOT NULL
                        ,mote_edic_cd int(11)   NOT NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        public function create_table_mote_revisor(){
                $sql = "CREATE TABLE IF NOT EXISTS `mote_revisor` (
                        `more_mote_cd` int(11) NOT NULL,
                        `more_user_cd` int(11) NOT NULL,
                        PRIMARY KEY (`more_user_cd`,`more_mote_cd`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
                $this->db->query($sql);
        }

        //Método cria a tabela Atividade
        public function create_table_atividade(){
                $sql = "CREATE TABLE IF NOT EXISTS Atividade(
                        ativ_cd           int(11)        NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,ativ_nm          varchar(100)   NOT NULL
                        ,ativ_desc        varchar(500)   NOT NULL
                        ,ativ_responsavel varchar(500)   NOT NULL
                        ,ativ_dt          date           NOT NULL
                        ,ativ_hora_ini    time           NOT NULL
                        ,ativ_hora_fin    time           NOT NULL
                        ,ativ_local       varchar(200)   NOT NULL
                        ,ativ_vagas_qtd   int(3)         NOT NULL
                        ,ativ_tiat_cd     int(11)        NOT NULL
                        ,ativ_edic_cd     int(11)        NOT NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Edicao
        public function create_table_edicao(){
                $sql = "CREATE TABLE IF NOT EXISTS Edicao(
                        edic_cd        int(11)          NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,edic_num      int(11)          NOT NULL
                        ,edic_tema     varchar(100)     NOT NULL
                        ,edic_apresent text             NOT NULL
                        ,edic_link     varchar(200)     NOT NULL
                        ,edic_img      varchar(200)     NOT NULL
                        ,edic_result   varchar(100)     NOT NULL
                        ,edic_anais    varchar(500)     NOT NULL
                        ,edic_regr_cd  int(11)          NOT NULL
                        ,edic_comi_cd  int(11)          NOT NULL
                        ,edic_conf_cd  int(11)          NOT NULL
                        ,edic_email_cd int(11)		NOT NULL
                        ,edic_tele_cd  int(11)		NOT NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        public function create_table_edicao_revisor(){
            $sql = "CREATE TABLE IF NOT EXISTS `edicao_revisor` (
            `edre_edic_cd` int(11) NOT NULL,
            `edre_user_cd` int(11) NOT NULL,
            `edre_convite_status` enum('Aguardando Resposta','Convite Aceito','Convite Recusado','') COLLATE utf8_unicode_ci NOT NULL,
            PRIMARY KEY (`edre_edic_cd`,`edre_user_cd`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
            $this->db->query($sql);
        }

        //Método cria tabela sedia
        public function create_table_sedia(){
                $sql = "CREATE TABLE IF NOT EXISTS Sedia(
                        sedi_cd       int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,sedi_loca_cd int(11) 	   NOT NULL
                        ,sedi_edic_cd int(11)      NOT NULL
                        ,sedi_num     int(5)   	   NOT NULL
                        ,sedi_comp    varchar(100) NULL
                        ,UNIQUE(sedi_edic_cd)
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Artigo
        public function create_table_artigo(){
            $sql = "CREATE TABLE IF NOT EXISTS Artigo(
                arti_cd int(11) NOT NULL AUTO_INCREMENT
               ,arti_title varchar(100) COLLATE utf8_unicode_ci NOT NULL
               ,arti_autores varchar(500) COLLATE utf8_unicode_ci NOT NULL
               ,arti_orienta varchar(100) COLLATE utf8_unicode_ci NOT NULL
               ,arti_resumo varchar(500) COLLATE utf8_unicode_ci NOT NULL
               ,arti_status enum('Pronto para a revisão'
                   ,'Aguardando Revisão'
                   ,'Aprovado'
                   ,'Aprovado com ressalvas'
                   ,'Reprovado'
                   ,'Cancelado') COLLATE utf8_unicode_ci NOT NULL
               ,arti_moda_cd int(11) NOT NULL
               ,arti_eite_cd int(11) NOT NULL
               ,PRIMARY KEY (arti_cd)
            ) ENGINE=INNODB";
            $this->db->query($sql);
        }

        //Método cria tabela Usuario
        public function create_table_usuario(){
                $sql = "CREATE TABLE IF NOT EXISTS User(
                        user_cd           int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,user_nm          varchar(100) NOT NULL
                        ,user_tipo        int(11)   NOT NULL
                        ,user_instituicao int(11) NULL
                        ,user_biograf     varchar(500) NULL
                        ,user_rg          varchar(12)  NOT NULL
                        ,user_cpf         varchar(14)  NULL
                        ,user_email_cd 	  int(11)	   NOT NULL
                        ,user_pass        varchar(100) NOT NULL
                        ,user_tele_cd	  int(11)	  NULL
                        ,user_status      enum('Não Validado','Ativo','Inativo','') NOT NULL
                        ,user_token       varchar(100) NOT NULL
                        ,UNIQUE(user_rg)
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }
        
        //Método cria tabela Autoria
        public function create_table_autoria(){
                $sql = "CREATE TABLE IF NOT EXISTS Autoria (
                        autor_respons tinyint
                        ,auto_user_cd int(11) NOT NULL
                        ,auto_arti_cd int(11)  NOT NULL
                        ,PRIMARY KEY (`auto_user_cd`,`auto_arti_cd`)
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Contato
        public function create_table_contato(){
                $sql = "CREATE TABLE IF NOT EXISTS Contato (
                        cont_cd       int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,cont_nm      varchar(100) NOT NULL
                        ,cont_assunto varchar(100) NOT NULL
                        ,cont_email   varchar(100) NOT NULL
                        ,cont_msg     varchar(500) NOT NULL
                        ,cont_status  tinyint(1)   NOT NULL
            ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Email
        public function create_table_email(){
                $sql = "CREATE TABLE IF NOT EXISTS Email (
                        email_cd     int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,email_email varchar(100) NOT NULL
                        ,UNIQUE(email_email)
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Telefone
        public function create_table_telefone(){
                $sql = "CREATE TABLE IF NOT EXISTS Telefone (
                        tele_cd         int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,tele_fone      varchar(15) NOT NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        public function create_table_abriga(){
                $sql = "CREATE TABLE IF NOT EXISTS Abriga (
                        abri_cd       int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,abri_loca_cd int(11) 	   NOT NULL
                        ,abri_user_cd int(11)      NOT NULL
                        ,abri_num     varchar(5)   NOT NULL
                        ,abri_comp    varchar(100) NULL
                        ,UNIQUE(abri_user_cd)
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Apoia
        public function create_table_apoia(){
                $sql = "CREATE TABLE IF NOT EXISTS Apoia (
                        apoia_inst_cd  int(11)      NOT NULL
                        ,apoia_edic_cd int(11)      NOT NULL
                        ,PRIMARY KEY(apoia_inst_cd,apoia_edic_cd)
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Submissao
        public function create_table_submissao(){
                $sql = "CREATE TABLE IF NOT EXISTS Submissao (
                        subm_cd       int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,subm_versao  int(11)	   NOT NULL
                        ,subm_arq1_nm varchar(200) NOT NULL
                        ,subm_arq1    mediumblob  NOT NULL
                        ,subm_arq2_nm varchar(200) NULL
                        ,subm_arq2    mediumblob  NULL
                        ,subm_dt      date         NOT NULL
                        ,subm_hr	  time         NOT NULL
                        ,subm_arti_cd int(11)      NOT NULL
                ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela Avaliacao
        public function create_table_avaliacao(){
                $sql = "CREATE TABLE IF NOT EXISTS Avaliacao (
                        aval_cd       int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,aval_parecer    varchar(500) NOT NULL
                        ,aval_dt      date         NOT NULL
                        ,aval_horario timestamp    NOT NULL
                        ,aval_status  enum('Revisão Pendente'
                                      ,'Revisão Aprovada'
                                      ,'Revisão aprovada com ressalvas'
                                      ,'Revisão Reprovada') 
                                      COLLATE utf8_unicode_ci NOT NULL
                        ,aval_confirm tinyint(1)   NOT NULL
                        ,aval_user_cd int(11)      NOT NULL
                        ,aval_subm_cd int(11)      NOT NULL
            ) ENGINE=INNODB";
                $this->db->query($sql);
        }

        //Método cria tabela métodos
        public function create_table_metodo(){
                $sql = "CREATE TABLE IF NOT EXISTS `metodo` (
                        `meto_cd`             int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,`meto_classe`        varchar(100) NOT NULL
                        ,`meto_metodo`        varchar(100) NOT NULL
                        ,`meto_identificacao` varchar(200) NOT NULL
                        ,`meto_privado`       tinyint(1) NOT NULL
                ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;";
                $this->db->query($sql);
        }

        //Método cria tabela permissao
        public function create_table_permissao(){
                $sql = "CREATE TABLE IF NOT EXISTS `permissao` (
                        `perm_cd`       int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,`perm_meto_cd` int(11) NOT NULL
                        ,`perm_tius_cd` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
                $this->db->query($sql);
        }

        public function create_table_tipo_usuario(){
                $sql = "CREATE TABLE IF NOT EXISTS `tipo_usuario` (
                        `tius_cd`  int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,`tius_nm` varchar(100) NOT NULL
                        ,`tius_ds` varchar(200) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
                $this->db->query($sql);
        }

        public function create_table_inscricao(){
                $sql = "CREATE TABLE IF NOT EXISTS Inscricao(
                         insc_cd      int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT
                        ,insc_ativ_cd int(11) NOT NULL
                        ,insc_user_cd int(11) NOT NULL
                        ,insc_status enum('Ainda não informada'
                                        ,'Participou'
                                        ,'Não Participou'
                                        , '') COLLATE utf8_unicode_ci NOT NULL
                        ,UNIQUE KEY insc_ativ_cd (insc_ativ_cd,insc_user_cd)
                )ENGINE=INNODB";
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
