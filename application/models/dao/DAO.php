<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

interface DAO{
    /**
     * Registra o objeto na base de dados
     * @param obj objeto a ser registrado no banco de dados
     * @return true caso  a ação seja bem sucedida ou false em caso de algum erro
     */
    public function inserir($obj);
    
    /**
     * Registra o objeto na base de dados
     * @param Não recebe parametros
     * @return Retorna uma array com os dados recuperados
     */
    public function consultarTudo();
    
    /**
     * Registra o objeto na base de dados
     * @param Não recebe parametros
     * @return Retorna uma array com os dados recuperados
     */           
    public function consultarCodigo($codigo);

    
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



