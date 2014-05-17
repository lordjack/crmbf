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
class CRMClienteList extends TPage {

    private $form;      // search form
    private $datagrid;  // listing
    private $pageNavigation;
    private $loaded;

    /**
     * Class constructor
     * Creates the page, the search form and the listing
     */
    public function __construct() {
        parent::__construct();
        new TSession;

        // creates the form
        $this->form = new TForm('form_listar_crm_clientes');
        $key=$_GET['key'];
        
        // create the form fields
        $name = new TEntry('nome');

        $name->setSize(170);

        $table = new TTable;

        $row = $table->addRow();
        $cell = $row->addCell('');
        $cell->width = PHP_SAPI == 'cli' ? 40 : 80;
        $row->addCell($name);
   
        $this->form->add($table);

        // creates the action button
        $button1 = new TButton('find');
        $button1->setAction(new TAction(array($this, 'onSearch')), 'Buscar');
        $button1->setImage('ico_find.png');
        
        // create an action button
        $button2 = new TButton('novo');
        $action2 = new TAction(array('CRMForm', 'onEdit'));
        $action2->setParameter('key', $key);
        $button2->setImage('ico_new.png');
        $button2->setAction($action2, 'Novo');
        
        $button3 = new TButton('csv');
        $button3->setAction(new TAction(array($this, 'onExportCSV')), 'CSV');
        $button3->setImage('ico_print.png');

         // create an action button
        $button4 = new TButton('action3');
        $action4 = new TAction(array('ClienteList', 'onReload'));
//        $action3->setParameter('key', $_GET['key']);
        $action4->setParameter('key', $key);
        $button4->setImage('ico_previous.png');
        $button4->setAction($action4, 'Voltar');
        
        $row->addCell($button1);
        $row->addCell($button2);
        $row->addCell($button3);
        $row->addCell($button4);

        $this->form->setFields(array($name, $button1, $button2, $button3,$button4));

        // creates a DataGrid
        $this->datagrid = new TDataGrid;
//        $this->datagrid->setHeight(200);
        // create the datagrid columns
        $dgid = new TDataGridColumn('id', 'Id', 'right', 70);
        $dgtitulo = new TDataGridColumn('titulo', 'Titulo', 'left', 180);
        $dgprojeto = new TDataGridColumn('projeto_nome', 'Projeto', 'left', 180);
        $dgdata = new TDataGridColumn('data_crm', 'Data', 'left', 160);
        $dgtempo = new TDataGridColumn('tempo', 'Tempo', 'left', 160);
        $dgdescricao = new TDataGridColumn('descricao', 'Descrição', 'left', 160);
        $dgsolicitante = new TDataGridColumn('solicitante', 'Solicitante', 'left', 160);
        $dgresponsavel = new TDataGridColumn('tipo_nome', 'Tipo', 'left', 160);
        $dgcliente = new TDataGridColumn('cliente_nome', 'Cliente', 'left', 160);
        $dgnome = new TDataGridColumn('prioridade_nome', 'Prioridade', 'left', 160);
        $dgstatus = new TDataGridColumn('status_nome', 'Status', 'left', 160);

        // add the columns to the datagrid
        $this->datagrid->addColumn($dgid);
        $this->datagrid->addColumn($dgtitulo);
        $this->datagrid->addColumn($dgprojeto);
        $this->datagrid->addColumn($dgdata);
        $this->datagrid->addColumn($dgtempo);
        $this->datagrid->addColumn($dgdescricao);
        $this->datagrid->addColumn($dgsolicitante);
        $this->datagrid->addColumn($dgresponsavel);
        $this->datagrid->addColumn($dgcliente);
        $this->datagrid->addColumn($dgnome);
        $this->datagrid->addColumn($dgstatus);

        // creates two datagrid actions
        $action1 = new TDataGridAction(array('CRMForm', 'onEdit'));
        $action1->setLabel('Editar');
        $action1->setImage('ico_edit.png');
        $action1->setField('id');

        $action2 = new TDataGridAction(array($this, 'onDelete'));
        $action2->setLabel('Delete');
        $action2->setImage('ico_delete.png');
        $action2->setField('id');

//        $obj = ClienteRegistroDetalhe();
        $action3 = new TDataGridAction(array('ClienteRegistroDetalhe', 'onEdit'));
        $action3->setLabel('Registros');
        $action3->setImage('ico_custom_form.png');
        $action3->setField('id');
        $action3->setParameter('fk', $_GET['key']);

        // add the actions to the datagrid
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);
        $this->datagrid->addAction($action3);

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
    function onSearch() {
        // get the search form data
        $data = $this->form->getData();

        // check if the user has filled the form
        if ($data->nome) {
            // creates a filter using what the user has typed
            $filter = new TFilter('nome', 'like', "{$data->nome}%");

            // stores the filter in the session
            TSession::setValue('customer_filter1', $filter);
            TSession::setValue('nome', $data->nome);
        } else {
            TSession::setValue('customer_filter1', NULL);
            TSession::setValue('customer_name', '');
        }


        // check if the user has filled the form
        if ($data->city_name) {
            // creates a filter using what the user has typed
            $filter = new TFilter('(SELECT name from city WHERE id=customer.city_id)', 'like', "{$data->city_name}%");

            // stores the filter in the session
            TSession::setValue('customer_filter2', $filter);
            TSession::setValue('customer_city_name', $data->city_name);
        } else {
            TSession::setValue('customer_filter2', NULL);
            TSession::setValue('customer_city_name', '');
        }

        // fill the form with data again
        $this->form->setData($data);

        $param = array();
        $param['offset'] = 0;
        $param['first_page'] = 1;
        $this->onReload($param);
    }

    /**
     * method onReload()
     * Load the datagrid with the database objects
     */
    function onReload($param = NULL) {
        try {
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
            // add the filter stored in the session to the criteria
            $criteria->add(new TFilter('cliente_id', '=', $_GET['key']));
            $criteria->setProperty('order', 'id desc'); // order, offset
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
            if ($customers) {
                foreach ($customers as $customer) {
                    // add the object inside the datagrid
                    $this->datagrid->addItem($customer);
                }
            }

            // reset the criteria for record count
            $criteria->resetProperties();
            $count = $repository->count($criteria);

            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        } catch (Exception $e) { // in case of exception
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    function onExportCSV() {
        $this->onSearch();

        try {
            // open a transaction with database 'samples'
            TTransaction::open('samples');

            // creates a repository for Customer
            $repository = new TRepository('Customer');

            // creates a criteria
            $criteria = new TCriteria;

            if (TSession::getValue('customer_filter1')) {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('customer_filter1'));
            }

            if (TSession::getValue('customer_filter2')) {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('customer_filter2'));
            }

            $csv = '';
            // load the objects according to criteria
            $customers = $repository->load($criteria);
            if ($customers) {
                foreach ($customers as $customer) {
                    $csv .= $customer->id . ';' .
                            $customer->name . ';' .
                            $customer->city_name . "\n";
                }
                file_put_contents('app/output/customers.csv', $csv);
                TPage::openFile('app/output/customers.csv');
            }
            // close the transaction
            TTransaction::close();
        } catch (Exception $e) { // in case of exception
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
    function onDelete($param) {
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
    function Delete($param) {
        try {
            // get the parameter $key
            $key = $param['key'];

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
        } catch (Exception $e) { // in case of exception
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
    function show() {
        // check if the datagrid is already loaded
        if (!$this->loaded) {
            $this->onReload(func_get_arg(0));
        }
        parent::show();
    }

}

?>