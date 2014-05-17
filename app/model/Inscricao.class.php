<?php
/**
 * Inscricao Active Record
 *
 * @version    1.0
 * @package    ctead
 * @subpackage Inscricao
 * @author     Jackson Meires
 */
class Inscricao extends TRecord
{
    const TABLENAME = 'inscricao';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
  
}
?>