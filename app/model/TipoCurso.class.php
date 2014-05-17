<?php
/**
 * Book Active Record
 *
 * @version    1.0
 * @package    ctead
 * @subpackage Inscricao
 * @author     Jackson Meires
 */
class TipoCurso extends TRecord
{
    const TABLENAME = 'tipocurso';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
 
}
?>