<?php
/**
 * Book Active Record
 *
 * @version    1.0
 * @package    ctead
 * @subpackage Inscricao
 * @author     Jackson Meires
 */
class Turno extends TRecord
{
    const TABLENAME = 'turno';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
 
}
?>