<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class EdicaoModel extends CI_Model{

        private $codigo;
        private $NumeroEdicao;
        private $tema;
        private $apresentacao;
        private $LinkEdicao;
        private $ImagemEdicao;
        private $resultados;
        private $anais;
        private $comite;
        private $conferencia;
        private $parcerias;
        private $logradouro;
        private $bairro;
        private $numero;
        private $complemento;
        private $cep;
        private $cidade;
        private $uf;
        private $codigoEmail;
        private $email;
        private $codigoTelefone;
        private $telefone;

        //Regras
        private $codigoRegra;
        private $DataInicioEvento;
        private $DataFimEvento;
        private $DataInicioPublicacao;
        private $DataFimPublicacao;
        private $DataInicioInscricao;
        private $DataFimInscricao;
        private $DataInicioSubmissao;
        private $DataFimSubmissao;
        private $DataInicioAvaliacao;
        private $DataFimAvaliacao;
        private $DiretrizesSubmissao;
        private $DiretrizesAvaliacao;


        public function getCodigo(){
            return $this->codigo;
        }
        
        public function getCodigoEmail(){
            return $this->codigoEmail;
        }
        
        public function getCodigoTelefone(){
            return $this->codigoTelefone;
        }
        
        public function getCodigoRegra(){
            return $this->codigoRegra;
        }

        public function getNumeroEdicao(){
            return $this->NumeroEdicao;
        }

        public function getTema(){
            return $this->tema;
        }

        public function getApresentacao(){
            return $this->apresentacao;
        }

        public function getLinkEdicao(){
            return $this->LinkEdicao;
        }

        public function getImagemEdicao(){
            return $this->ImagemEdicao;
        }

        public function getResultados(){
            return $this->resultados;
        }

        public function getAnais(){
            return $this->anais;
        }

        public function getComite(){
            return $this->comite;
        }

        public function getConferencia(){
            return $this->conferencia;
        }

        //Getters de endereço da Edição

        public function getCep(){
            return $this->cep;
        }
        
        public function getLogradouro(){
            return $this->logradouro;
        }

        public function getBairro(){
            return $this->bairro;
        }

        public function getNumero(){
            return $this->numero;
        }

        public function getComplemento(){
            return $this->complemento;
        }

        public function getCidade(){
            return $this->cidade;
        }

        public function getUf(){
            return $this->uf;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        //Getters de regras da Edição 

        public function getDataInicioEvento(){
            return $this->DataInicioEvento;
        }

        public function getDataFimEvento(){
            return $this->DataFimEvento;
        }

        public function getDataInicioInscricao(){
            return $this->DataInicioInscricao;
        }

        public function getDataFimInscricao(){
            return $this->DataFimInscricao;
        }
        
        public function getDataInicioPublicacao(){
            return $this->DataInicioPublicacao;
        }

        public function getDataFimPublicacao(){
            return $this->DataFimPublicacao;
        }

        public function getDataInicioSubmissao(){
            return $this->DataInicioSubmissao;
        }

        public function getDataFimSubmissao(){
            return $this->DataFimSubmissao;
        }

        public function getDataInicioAvaliacao(){
            return $this->DataInicioAvaliacao;
        }

        public function getDataFimAvaliacao(){
            return $this->DataFimAvaliacao;
        }

        public function getDiretrizesSubmissao(){
            return $this->DiretrizesSubmissao;
        }

        public function getDiretrizesAvaliacao(){
            return $this->DiretrizesAvaliacao;
        }

        public function getParcerias(){
            return $this->parcerias;
        }



        //Setters 
        
        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }
        
        public function setCodigoEmail($codigoEmail){
            $this->codigoEmail = $codigoEmail;
        }
        
        public function setCodigoTelefone($codigoTelefone){
            $this->codigoTelefone = $codigoTelefone;
        }
        
        public function setCodigoRegra($codigoRegra){
            $this->codigoRegra = $codigoRegra;
        }

        public function setNumeroEdicao($NumeroEdicao){
            $this->NumeroEdicao = $NumeroEdicao;
        }

        public function setTema($tema){
            $this->tema = $tema;
        }

        public function setApresentacao($apresentacao){
            $this->apresentacao = $apresentacao;
        }

        public function setLinkEdicao($LinkEdicao){
            $this->LinkEdicao = $LinkEdicao;
        }

        public function setImagemEdicao($ImagemEdicao){
            $this->ImagemEdicao = $ImagemEdicao;
        }

        public function setResultados($resultados){
            $this->resultados = $resultados;
        }

        public function setAnais($anais){
            $this->anais = $anais;
        }

        public function setComite($comite){
            $this->comite = $comite;
        }

        public function setConferencia($conferencia){
            $this->conferencia = $conferencia;
        }

        //setters de endereço da Edição
        
        public function setCep($cep){
            $this->cep = $cep;
        }

        public function setLogradouro($logradouro){
            $this->logradouro = $logradouro;
        }

        public function setBairro($bairro){
            $this->bairro = $bairro;
        }

        public function setNumero($numero){
            $this->numero = $numero;
        }

        public function setComplemento($complemento){
            $this->complemento = $complemento;
        }

        public function setCidade($cidade){
            $this->cidade = $cidade;
        }

        public function setUf($uf){
            $this->uf = $uf;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }

        //setters de regras da Edição 

        public function setDataInicioEvento($DataInicioEvento){
            $this->DataInicioEvento = $DataInicioEvento;
        }

        public function setDataFimEvento($DataFimEvento){
            $this->DataFimEvento = $DataFimEvento;
        }

        public function setDataInicioInscricao($DataInicioInscricao){
            $this->DataInicioInscricao = $DataInicioInscricao;
        }

        public function setDataFimInscricao($DataFimInscricao){
            $this->DataFimInscricao = $DataFimInscricao;
        }
        
        public function setDataInicioPublicacao($DataInicioPublicacao){
            $this->DataInicioPublicacao = $DataInicioPublicacao;
        }

        public function setDataFimPublicacao($DataFimPublicacao){
            $this->DataFimPublicacao = $DataFimPublicacao;
        }

        public function setDataInicioSubmissao($DataInicioSubmissao){
            $this->DataInicioSubmissao = $DataInicioSubmissao;
        }

        public function setDataFimSubmissao($DataFimSubmissao){
            $this->DataFimSubmissao = $DataFimSubmissao;
        }

        public function setDataInicioAvaliacao($DataInicioAvaliacao){
            $this->DataInicioAvaliacao = $DataInicioAvaliacao;
        }

        public function setDataFimAvaliacao($DataFimAvaliacao){
            $this->DataFimAvaliacao = $DataFimAvaliacao;
        }

        public function setDiretrizesSubmissao($DiretrizesSubmissao){
            $this->DiretrizesSubmissao = $DiretrizesSubmissao;
        }

        public function setDiretrizesAvaliacao($DiretrizesAvaliacao){
            $this->DiretrizesAvaliacao = $DiretrizesAvaliacao;
        }

        public function setParcerias($parcerias){
            $this->parcerias = $parcerias;
        }


    }

