<?php

if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class UsuarioModel extends CI_Model{

        private $codigo;
        private $nomecompleto;
        private $rg;
        private $cpf;
        private $email;
        private $senha;
        private $instituicao;
        private $telefone;
        private $token;
        private $status;
        private $logradouro;
        private $bairro;
        private $numero;
        private $complemento;
        private $cep;
        private $cidade;
        private $uf;
        private $codigoEmail;
        private $codigoTelefone;

        public function getCodigo(){
                return $this->codigo;
        }

        public function getCodigoEmail(){
                return $this->codigoEmail;
        }

        public function getCodigoTelefone(){
                return $this->codigoTelefone;
        }

        public function getNomeCompleto(){
                return $this->nomecompleto;
        }

        public function getRg(){
                return $this->rg;
        }

        public function getCpf(){
                return $this->cpf;
        }

        public function getEmail(){
                return $this->email;
        }

        public function getSenha(){
                return $this->senha;
        }

        public function getInstituicao(){
                return $this->instituicao;
        }

        public function getTelefone(){
                return $this->telefone;
        }

        public function getToken(){
                return $this->token;
        }

        public function getStatus(){
                return $this->status;
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

        public function getCep(){
                return $this->cep;
        }

        public function getCidade(){
                return $this->cidade;
        }

        public function getUf(){
                return $this->uf;
        }



        public function setCodigo($codigo){
                $this->codigo = $codigo;
        }


        public function setCodigoEmail($codigo){
                $this->codigoEmail = $codigo;
        }

        public function setCodigoTelefone($codigo){
                $this->codigoTelefone = $codigo;
        }

        public function setNomeCompleto($nomecompleto){
                $this->nomecompleto = $nomecompleto;
        }

        public function setRg($rg){
                $this->rg = $rg;
        }

        public function setCpf($cpf){
                $this->cpf = $cpf;
        }

        public function setEmail($email){
                $this->email = $email;
        }

        public function setSenha($senha){
                $this->senha = $senha;
        }

        public function setInstituicao($instituicao){
                $this->instituicao = $instituicao;
        }

        public function setTelefone($telefone){
                $this->telefone = $telefone;
        }

        public function setToken($token){
                $this->token = $token;
        }

        public function setStatus($status){
                $this->status = $status;
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

        public function setCep($cep){
                $this->cep = $cep;
        }

        public function setCidade($cidade){
                $this->cidade = $cidade;
        }

        public function setUf($uf){
                $this->uf = $uf;
        }

}