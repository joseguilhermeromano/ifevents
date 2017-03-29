<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

interface InterfaceControl{
    /**
     * Realiza as validações e chama a dao para persistir os dados no banco
     * @return Não apresenta retorno
     */
    public function cadastrar();
    
    /**
     * Alterar um valor existente na base de dados
     * @return Não apresenta retorno
     */
    public function alterar($codigo);
    
    /**
     * Chama a dao de exclusão de dados
      * @return Não apresenta retorno
     */
    public function excluir();
    
    /**
     * Retorna todos os dados de uma determinada entidade do banco de dados
      * @return Não apresenta retorno
     */
    public function consultarTudo();
    
    
}