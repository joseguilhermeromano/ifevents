<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

interface DAO{
    /**
     * Registra o objeto na base de dados
     * @param obj objeto a ser registrado no banco de dados
     * @return true caso  a ação seja bem sucedida ou false em caso de algum erro
     */
    public function inserir($obj);
    
    /**
     * Retorna uma lista de determinado objeto
     * @param string regra como um nome ou simplemente empty. 
     * @return lista de objetos ou null
     */
    public function consultar($arrayParametros);

    
    /**
     * Alterar um valor existente na base de dados
     * @param obj objeto com os novos valores
     * @return true caso a ação seja bem sucedica ou false em caso de erros
     */
    public function alterar($obj);
    
    /**
     * Deleta determinado objeto na base de dados
     * @param codigo registro do objeto
     * @return true caso a ação seja bem sucedica ou false em caso de erros
     */
    public function excluir($obj);
}



