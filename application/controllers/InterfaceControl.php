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
    public function alterar();

    /**
     * Chama a dao de exclusão de dados
      * @return Não apresenta retorno
     */

    public function excluir();

    /**
     * Consulta que pode ser realizada de forma personalizada para cada entidade, trazendo todos ou parte dos registros com ou sem paginação
      * @return Não apresenta retorno
     */

    public function consultarTudo();



    public function consultar();


}
