<?php

/**
 * CategoryFormList Registration
 *
 * @version    1.0
 * @package    samples
 * @subpackage library
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2011 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class PrioridadeFormList extends TStandardFormList {

    protected $form; // form
    protected $datagrid; // datagrid
    protected $pageNavigation;

    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct() {
        parent::__construct();

        // security check
//        if (TSession::getValue('logged') !== TRUE)
//        {
//            throw new Exception('Not logged'));
//        }
//        
//        // security check
//        TTransaction::open('library');
//        if ( (User::newFromLogin(TSession::getValue('login'))-> role -> mnemonic !== 'OPERATOR') AND
//             (User::newFromLogin(TSession::getValue('login'))-> role -> mnemonic !== 'LIBRARIAN') )
//        {
//            throw new Exception('Permission denied'));
//        }
//        TTransaction::close();
        // defines the database
        parent::setDatabase('db_crmbf');

        // defines the active record
        parent::setActiveRecord('Prioridade');

        // creates the form
        $this->form = new TQuickForm('form_Prioridade');
        $titulo = new TLabel('Cadastrar Prioridade');
        $titulo->setFontColor('red');
        $titulo->setFontSize(16);

        // create the form fields
        $id = new TEntry('id');
        $nome = new TEntry('nome');

        $id->setEditable(FALSE);

        // define the sizes
        $this->form->addQuickField('', $titulo, 100);
        $this->form->addQuickField('Code', $id, 100);
        $this->form->addQuickField('Nome', $nome, 200);

        // define the form action
        $this->form->addQuickAction('Salvar', new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction('Novo', new TAction(array($this, 'onEdit')), 'ico_new.png');

        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(320);


        // creates the datagrid columns
        $this->datagrid->addQuickColumn('ID', 'id', 'left', 100, new TAction(array($this, 'onReload')), array('order', 'id'));
        $this->datagrid->addQuickColumn('Nome', 'nome', 'left', 200, new TAction(array($this, 'onReload')), array('order', 'nome'));


        // add the actions to the datagrid
        $this->datagrid->addQuickAction('Edit', new TDataGridAction(array($this, 'onEdit')), 'id', 'ico_edit.png');
        $this->datagrid->addQuickAction('Delete', new TDataGridAction(array($this, 'onDelete')), 'id', 'ico_delete.png');

        // create the datagrid model
        $this->datagrid->createModel();

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        // creates the page structure using a table
        $table = new TTable;
        // add a row to the form
        $row = $table->addRow();
        $row->addCell($this->form);
        // add a row to the datagrid
        $row = $table->addRow();
        $row->addCell($this->datagrid);
        // add a row for page navigation
        $row = $table->addRow();
        $row->addCell($this->pageNavigation);

        // add the table inside the page
        parent::add($table);
    }

}

?>