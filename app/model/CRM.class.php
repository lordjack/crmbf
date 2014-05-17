<?php
/**
 * CRM Active Record
 *
 * @version    1.0
 * @package    samples
 * @subpackage CRM
 * @copyright  Copyright (c) 2006-2011 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class CRM extends TRecord
{
    const TABLENAME = 'crm';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial} 
    
    private $projeto;
    private $responsavel;
    private $tipo;
    private $cliente;
    private $prioridade;
    private $status;
    
    /**
     * Returns the projeto name
     */
    function get_projeto_nome()
    {
        if (empty($this->projeto))
            $this->projeto = new Projeto($this->projeto_id);
             
        return $this->projeto->nome;
    }
    /**
     * Returns the responsavel name
     */
    function get_responsavel_nome()
    {
        if (empty($this->responsavel))
            $this->responsavel = new User($this->responsavel_id);
             
        return $this->responsavel->name;
    }
    /**
     * Returns the tipo name
     */
    function get_tipo_nome()
    {
        if (empty($this->tipo))
            $this->tipo = new Tipo($this->tipo_id);
             
        return $this->tipo->nome;
    }
    /**
     * Returns the cliente name
     */
    function get_cliente_nome()
    {
        if (empty($this->cliente))
            $this->cliente = new Cliente($this->cliente_id);
             
        return $this->cliente->nome;
    }
    /**
     * Returns the prioridade name
     */
    function get_prioridade_nome()
    {
        if (empty($this->prioridade))
            $this->prioridade = new Prioridade($this->prioridade_id);
             
        return $this->prioridade->nome;
    }
    /**
     * Returns the status name
     */
    function get_status_nome()
    {
        if (empty($this->status))
            $this->status = new Status($this->status_id);
             
        return $this->status->nome;
    }
      
}
?>