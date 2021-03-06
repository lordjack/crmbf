<?php
/**
 * CRMList
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2013 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class CRMList extends TPage
{
    private $form;      // search form
    private $datagrid;  // listing
    private $pageNavigation;
    private $loaded;
    
    /**
     * Class constructor
     * Creates the page, the search form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        new TSession;
        
        // creates the form
        $this->form = new TForm('form_listar_crm');
        
        // create the form fields
        $name   = new TEntry('nome');
//        $email   = new TEntry('email');
//        $telefone   = new TEntry('telefone');
//        $celular   = new TEntry('celular');
//        $skype   = new TEntry('skype');
//        $endereco = new TEntry('endereco');
//        $bairro = new TEntry('bairro');
//        $cidade_id = new TEntry('cidade_id');
        
        $name->setSize(170);
//        $email->setSize(170);
//        $telefone->setSize(170);
//        $celular->setSize(170);
//        $skype->setSize(170);
//        $endereco->setSize(170);
//        $bairro->setSize(126);
//        $cidade_id->setSize(126);
        
        //$name->setValue(TSession::getValue('customer_name'));
       // $city_name->setValue(TSession::getValue('customer_city_name'));
        
        $table = new TTable;
        
        $row = $table->addRow();
        $cell=$row->addCell('');
        $cell->width= PHP_SAPI == 'cli' ? 40 : 80;
        $row->addCell($name);
        /*
        $cell=$row->addCell('');
        $row->addCell($email);
        
        $cell=$row->addCell('');
        $row->addCell($telefone);
        
        $cell=$row->addCell('');
        $row->addCell($celular);
        
        $cell=$row->addCell('');
        $row->addCell($skype);
        
        $cell=$row->addCell('');
        $row->addCell($endereco);
        
        $cell=$row->addCell('');
        $row->addCell($bairro);
        
        $cell=$row->addCell('');
        $row->addCell($cidade_id);
        
         * 
         */
        $this->form->add($table);
        
        // creates the action button
        $button1=new TButton('find');
        $button1->setAction(new TAction(array($this, 'onSearch')), 'Buscar');
        $button1->setImage('ico_find.png');

        $button2=new TButton('novo');
        $button2->setAction(new TAction(array('CRMForm', 'onEdit')), 'Novo');
        $button2->setProperty('key', '');
        $button2->setImage('ico_new.png');
        
        $button3=new TButton('csv');
        $button3->setAction(new TAction(array($this, 'onExportCSV')), 'CSV');
        $button3->setImage('ico_print.png');
        
        $row->addCell($button1);
        $row->addCell($button2);
        $row->addCell($button3);
        
        $this->form->setFields(array($name, /*$email, $telefone,$celular,$skype,
            $endereco,$bairro,$cidade_id, */ $button1, $button2, $button3));
        
        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(200);

        // creates the datagrid columns
        $this->datagrid->addQuickColumn('Id', 'id', 'right', 40, new TAction(array($this, 'onReload')), array('order', 'id'));
        $this->datagrid->addQuickColumn('Titulo', 'titulo', 'left', 170, new TAction(array($this, 'onReload')), array('order', 'nome'));
        $this->datagrid->addQuickColumn('Projeto', 'projeto_nome', 'left', 140);
        $this->datagrid->addQuickColumn('Data', 'data', 'left', 190);
        $this->datagrid->addQuickColumn('Tempo', 'tempo', 'left', 150);
        $this->datagrid->addQuickColumn('Porcentagem', 'porcentagem', 'left', 150);
        $this->datagrid->addQuickColumn('Descrição', 'descricao', 'left', 150);
        $this->datagrid->addQuickColumn('Solicitante', 'solicitante', 'left', 150);
        $this->datagrid->addQuickColumn('Responsavel', 'responsavel_nome', 'left', 150);
        $this->datagrid->addQuickColumn('Tipo', 'tipo_nome', 'left', 150);
        $this->datagrid->addQuickColumn('Cliente', 'cliente_nome', 'left', 150);
        $this->datagrid->addQuickColumn('Prioridade', 'prioridade_nome', 'left', 150);
        $this->datagrid->addQuickColumn('Status', 'status_nome', 'left', 150);

        // creates two datagrid actions
        $this->datagrid->addQuickAction('Edit', new TDataGridAction(array('CRMForm', 'onEdit')), 'id', 'ico_edit.png');
        $this->datagrid->addQuickAction('Delete', new TDataGridAction(array($this, 'onDelete')), 'id', 'ico_delete.png');
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // creates the page structure using a table
        $table = new TTable;
        $table->addRow()->addCell($this->form);
        $table->addRow()->addCell($this->datagrid);
        $table->addRow()->addCell($this->pageNavigation);
        // add the table inside the page
        parent::add($table);
    }
    
    /**
     * method onSearch()
     * Register the filter in the session when the user performs a search
     */
    function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        
        // check if the user has filled the form
        if ($data->nome)
        {
            // creates a filter using what the user has typed
            $filter = new TFilter('nome', 'like', "{$data->nome}%");
            
            // stores the filter in the session
            TSession::setValue('customer_filter1', $filter);
            TSession::setValue('nome',   $data->nome);
            
        }
        else
        {
            TSession::setValue('customer_filter1', NULL);
            TSession::setValue('customer_name',   '');
        }
        
        
        // check if the user has filled the form
        if ($data->city_name)
        {
            // creates a filter using what the user has typed
            $filter = new TFilter('(SELECT name from city WHERE id=customer.city_id)', 'like', "{$data->city_name}%");
            
            // stores the filter in the session
            TSession::setValue('customer_filter2', $filter);
            TSession::setValue('customer_city_name', $data->city_name);
        }
        else
        {
            TSession::setValue('customer_filter2', NULL);
            TSession::setValue('customer_city_name', '');
        }
        
        // fill the form with data again
        $this->form->setData($data);
        
        $param=array();
        $param['offset']    =0;
        $param['first_page']=1;
        $this->onReload($param);
    }
    
    /**
     * method onReload()
     * Load the datagrid with the database objects
     */
    function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('db_crmbf');
            
            // creates a repository for Customer
            $repository = new TRepository('CRM');
            $limit = 10;
            
            // creates a criteria
            $criteria = new TCriteria;
//            if (isset($param['order']) AND $param['order'] == 'city_name')
//            {
//                $param['order'] = '(select name from city where city_id = id)';
//            }
            //$criteria->setProperties($param); // order, offset
            $criteria->setProperty('order', 'titulo'); // order, offset
         //   $criteria->setProperty('limit', $limit);
            /*
            if (TSession::getValue('customer_filter1'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('customer_filter1'));
            }
            
            if (TSession::getValue('customer_filter2'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('customer_filter2'));
            }
            
             * 
             */
            // load the objects according to criteria
            $customers = $repository->load($criteria);
            $this->datagrid->clear();
            if ($customers)
            {
                foreach ($customers as $customer)
                {
                    // add the object inside the datagrid
                    $this->datagrid->addItem($customer);
                }
            }
            
            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);
            
            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            
            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    function onExportCSV()
    {
        $this->onSearch();

        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('samples');
            
            // creates a repository for Customer
            $repository = new TRepository('Customer');
            
            // creates a criteria
            $criteria = new TCriteria;
            
            if (TSession::getValue('customer_filter1'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('customer_filter1'));
            }
            
            if (TSession::getValue('customer_filter2'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('customer_filter2'));
            }
            
            $csv = '';
            // load the objects according to criteria
            $customers = $repository->load($criteria);
            if ($customers)
            {
                foreach ($customers as $customer)
                {
                    $csv .= $customer->id.';'.
                            $customer->name.';'.
                            $customer->city_name."\n";
                }
                file_put_contents('app/output/customers.csv', $csv);
                TPage::openFile('app/output/customers.csv');
            }
            // close the transaction
            TTransaction::close();
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }

    }
    
    /**
     * method onDelete()
     * executed whenever the user clicks at the delete button
     * Ask if the user really wants to delete the record
     */
    function onDelete($param)
    {
        // define the next action
        $action1 = new TAction(array($this, 'Delete'));
        $action1->setParameters($param); // pass 'key' parameter ahead
        
        // shows a dialog to the user
        new TQuestion('Você realmete quer deletar este registro?', $action1);
    }
    
    /**
     * method Delete()
     * Delete a record
     */
    function Delete($param)
    {
        try
        {
            // get the parameter $key
            $key=$param['key'];
            
            // open a transaction with database 'samples'
            TTransaction::open('db_crmbf');
            
            // instantiates object Customer
            $customer = new CRM($key);
            // deletes the object from the database
            $customer->delete();
            
            // close the transaction
            TTransaction::close();
            
            // reload the listing
            $this->onReload($param);
            // shows the success message
            new TMessage('info', "Registro Deletado");
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    /**
     * method show()
     * Shows the page
     */
    function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded)
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
}
?>