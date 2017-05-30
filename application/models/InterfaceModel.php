<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

interface InterfaceModel{
    /**
     * Realiza as validações e chama a dao para persistir os dados no banco
     * @return true caso a ação seja bem sucedica ou false em caso de erros
     */
    public function cadastrar();
    
    /**
     * Alterar um valor existente na base de dados
     * @return true caso a ação seja bem sucedica ou false em caso de erros
     */
    public function alterar();
    
    /**
     * Chama a dao de exclusão de dados
     * @return true caso a ação seja bem sucedica ou false em caso de erros
     */
    public function excluir();
    
    /**
     * Realiza as validações e chama a dao para consultar os dados no banco
     * @return array dos dados encontrados.
     */
    public function buscarTudo();
    
    /**
     * Realiza as validações e chama a dao para consultar os dados no banco
     * @return array dos dados encontrados.
     */
    public function buscar();

    
    
}



