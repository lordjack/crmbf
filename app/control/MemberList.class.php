<?php
/**
 * MemberList Listing
 *
 * @version    1.0
 * @package    samples
 * @subpackage library
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2011 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class MemberList extends TStandardList
{
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        // security check
        if (TSession::getValue('logged') !== TRUE)
        {
            throw new Exception(_t('Not logged'));
        }
        
        // security check
        TTransaction::open('library');
        if ( (User::newFromLogin(TSession::getValue('login'))-> role -> mnemonic !== 'OPERATOR') AND
             (User::newFromLogin(TSession::getValue('login'))-> role -> mnemonic !== 'LIBRARIAN') )
        {
            throw new Exception(_t('Permission denied'));
        }
        TTransaction::close();
        
        // defines the database
        parent::setDatabase('library');
        
        // defines the active record
        parent::setActiveRecord('Member');
        
        // defines the filter field
        parent::setFilterField('name');
        
        // creates the form
        $this->form = new TForm('form_search_Member');
        
        // creates a table
        $table = new TTable;
        
        // add the table inside the form
        $this->form->add($table);
        
        // create the form fields
        $filter = new TEntry('name');
        $filter->setValue(TSession::getValue('Member_name'));
        
        // add a row for the filter field
        $row=$table->addRow();
        $row->addCell(new TLabel(_t('Name') . ': '));
        $row->addCell($filter);
        
        // create two action buttons to the form
        $find_button = new TButton('find');
        $new_button  = new TButton('new');
        // define the button actions
        $find_button->setAction(new TAction(array($this, 'onSearch')), _t('Find'));
        $find_button->setImage('ico_find.png');
        
        $new_button->setAction(new TAction(array('MemberForm', 'onEdit')), _t('New'));
        $new_button->setImage('ico_new.png');
        
        // add a row for the form actions
        $row=$table->addRow();
        $row->addCell($find_button);
        $row->addCell($new_button);
        
        // define wich are the form fields
        $this->form->setFields(array($filter, $find_button, $new_button));
        
        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(320);
        

        // creates the datagrid columns
        $this->datagrid->addQuickColumn(_t('Code'), 'id', 'right', 50, new TAction(array($this, 'onReload')), array('order', 'id'));
        $this->datagrid->addQuickColumn(_t('Name'), 'name', 'left', 200, new TAction(array($this, 'onReload')), array('order', 'name'));
        $this->datagrid->addQuickColumn(_t('Phone'), 'phone_number', 'left', 100, new TAction(array($this, 'onReload')), array('order', 'phone_number'));
        $this->datagrid->addQuickColumn(_t('Email'), 'email', 'left', 100, new TAction(array($this, 'onReload')), array('order', 'email'));

        
        // add the actions to the datagrid
        $this->datagrid->addQuickAction(_t('Edit'), new TDataGridAction(array('MemberForm', 'onEdit')), 'id', 'ico_edit.png');
        $this->datagrid->addQuickAction(_t('Delete'), new TDataGridAction(array($this, 'onDelete')), 'id', 'ico_delete.png');
        
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
