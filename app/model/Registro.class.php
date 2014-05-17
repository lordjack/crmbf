
<?php
/**
 * Registro Active Record
 *
 * @version    1.0
 * @package    samples
 * @subpackage library
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2011 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class Registro extends TRecord
{
    const TABLENAME = 'crm_registro';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial} 
    
    private $crm;
    private $tiporegistro;
    
    /**
     * Returns the crm name
     */
    function get_crm_nome()
    {
        if (empty($this->crm))
            $this->crm = new CRM($this->crm_id);
             
        return $this->crm->titulo;
    }
    
    /**
     * Returns the tiporegistro name
     */
    function get_tiporegistro_nome()
    {
        if (empty($this->tiporegistro))
            $this->tiporegistro = new RegistroTipo($this->tiporegistro_id);
             
        return $this->tiporegistro->nome;
    }
}
?>