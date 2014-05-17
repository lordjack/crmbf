<?php
/**
 * Book Active Record
 *
 * @version    1.0
 * @package    ctead
 * @subpackage Inscricao
 * @author     Jackson Meires
 */
class Curso extends TRecord
{
    const TABLENAME = 'Curso';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
 
}
?>