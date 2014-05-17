<?php
/**
 * City Seek
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2013 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class TestCitySeek extends TWindow
{
    private $form;      // form
    private $datagrid;  // datagrid
    private $pageNavigation;
    private $parentForm;
    private $loaded;
    
    /**
     * constructor method
     */
    public function __construct()
    {
        parent::__construct();
        new TSession;
        
        // creates the form
        $this->form = new TForm('form_city_Seek');
        // creates the table
        $table = new TTable;
        
        // add the table inside the form
        $this->form->add($table);
        
        // create the form fields
        $name= new TEntry('name');
        $code = new TEntry('id');
        $crm_id = new TDBCombo('crm_id', 'db_crmbf', 'CRM', 'id', 'titulo');
        $tiporegistro_id = new TDBCombo('tiporegistro_id', 'db_crmbf', 'RegistroTipo', 'id', 'nome');
        $registro = new TText('registro');
        $temporegistro = new TEntry('tempo_registro');
//        $temporegistro->setEditable(false);
        $dataregistro = new TDate('data_registro');
        $hora_registro = new TEntry('hora_registro');
        $numero_registro = new TEntry('numero_registro');
        
        // keep the session value
      //  $name->setValue(TSession::getValue('test_city_name'));
        
        // add the field inside the table
//        $row=$table->addRow();
//        $row->addCell(new TLabel('Name:'));
//        $row->addCell($name);
        
        $code->setEditable(FALSE);
        $code->setSize(100);
        $crm_id->setSize(320);
        $registro->setSize(320);
        $temporegistro->setSize(160);
        //$temporegistro->setValue(date("d/m/Y H:i:s"));
        $tiporegistro_id->setSize(160);
        //$dataregistro->setRange(0,1000,1);
        $dataregistro->setSize(90);
       // $hora_registro->setRange(0,100,1);
        $hora_registro->setSize(150);
        $hora_registro->setTip('Horario EX: 8:14');
        $numero_registro->setSize(320);
       
        $row = $table->addRow();
        $row->addCell(new TLabel('Code:'));
        $row->addCell($code);

        // add a row for the field name
        $row = $table->addRow();
        $row->addCell(new TLabel('CRM Titulo:'));
        $cell = $row->addCell($crm_id);

        // add a row for the field Telefone
        $row = $table->addRow();
        $row->addCell(new TLabel('Tipo Registro:'));
        $cell = $row->addCell($tiporegistro_id);

        // add a row for the field Email
        $row = $table->addRow();
        $row->addCell(new TLabel('Tempo:'));
        $cell = $row->addCell($temporegistro);

        // add a row for the field celular
        $row = $table->addRow();
        $row->addCell(new TLabel('Data:'));
        $cell = $row->addCell($dataregistro);

        // add a row for the field skype
        $row = $table->addRow();
        $row->addCell(new TLabel('Hora:'));
        $cell = $row->addCell($hora_registro);

        // add a row for the field endereco
        $row = $table->addRow();
        $row->addCell(new TLabel('Numero Registro:'));
        $row->addCell($numero_registro);
       
        // add a row for the field name
        $row = $table->addRow();
        $row->addCell(new TLabel('Registro:'));
        $cell = $row->addCell($registro);
        
        // create a find button
        $find_button = new TButton('search');
        // define the button action
        $find_button->setAction(new TAction(array($this, 'onSearch')), 'Search');
        $find_button->setImage('ico_find.png');
        
        // add a row for the find button
        $row=$table->addRow();
        $row->addCell($find_button);
        
        // define wich are the form fields
        $this->form->setFields(array($name, $find_button));
        
        // create the datagrid
        $this->datagrid = new TDataGrid;
        
        // create the datagrid columns
        $id    = new TDataGridColumn('id',    'Id',   'right',   70);
        $name  = new TDataGridColumn('name',  'Name', 'left',   220);
        $state = new TDataGridColumn('state', 'Estado', 'left',  80);
        
        $order1= new TAction(array($this, 'onReload'));
        $order2= new TAction(array($this, 'onReload'));
        
        $order1->setParameter('order', 'id');
        $order2->setParameter('order', 'name');
        
        // define the column actions
        $id->setAction($order1);
        $name->setAction($order2);
        
        // add the columns inside the datagrid
        $this->datagrid->addColumn($id);
        $this->datagrid->addColumn($name);
        $this->datagrid->addColumn($state);
        
        // create one datagrid action
        $action1 = new TDataGridAction(array($this, 'onSelect'));
        $action1->setLabel('Selecionar');
        $action1->setImage('ico_apply.png');
        $action1->setField('id');
        
        // add the action to the datagrid
        $this->datagrid->addAction($action1);
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // create the page navigator
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // create a table for layout
        $table = new TTable;
        // create a row for the form
        $row = $table->addRow();
        $row->addCell($this->form);
        
        // create a row for the datagrid
        $row = $table->addRow();
        $row->addCell($this->datagrid);
        
        // create a row for the page navigator
        $row = $table->addRow();
        $row->addCell($this->pageNavigation);
        
        // add the table inside the page
        parent::add($table);
    }
    
    /**
     * Register a filter in the session
     */
    function onSearch()
    {
        // get the form data
        $data = $this->form->getData();
        
        // check if the user has filled the fields
        if (isset($data->name))
        {
            // cria um filtro pelo conteúdo digitado
            $filter = new TFilter('name', 'like', "%{$data->name}%");
            
            // armazena o filtro na seção
            TSession::setValue('test_city_filter', $filter);
            TSession::setValue('test_city_name', $data->name);
            
            // put the data back to the form
            $this->form->setData($data);
        }
        
        // redefine the parameters for reload method
        $param=array();
        $param['offset']    =0;
        $param['first_page']=1;
        $this->onReload($param);
    }
    
    /**
     * Load the datagrid with the database objects
     */
    function onReload($param = NULL)
    {
        try
        {
            // start database transaction
            TTransaction::open('samples');
            
            // create a repository for City table
            $repository = new TRepository('City');
            $limit = 10;
            // creates a criteria
            $criteria = new TCriteria;
            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);
            
            if (TSession::getValue('test_city_filter'))
            {
                // filter by city name
                $criteria->add(TSession::getValue('test_city_filter'));
            }
            
            // load the objects according to the criteria
            $cities = $repository->load($criteria);
            $this->datagrid->clear();
            if ($cities)
            {
                foreach ($cities as $city)
                {
                    // add the objects inside the datagrid
                    $this->datagrid->addItem($city);
                }
            }
            
            // clear the criteria
            $criteria->resetProperties();
            $count= $repository->count($criteria);
            
            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            
            // commit and closes the database transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // exceptions
        {
            // show the error message
            new TMessage('error', '<b>Erro</b> ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    /**
     * Executed when the user chooses the record
     */
    function onSelect($param)
    {
        try
        {
            $key = $param['key'];
            TTransaction::open('samples');
            
            // load the active record
            $city = new City($key);
            
            // closes the transaction
            TTransaction::close();
            
            $object = new StdClass;
            $object->city_id1   = $city->id;
            $object->city_name1 = $city->name;
            
            TForm::sendData('form_seek_sample', $object);
            parent::closeWindow(); // closes the window
        }
        catch (Exception $e) // em caso de exceção
        {
            // clear fields
            $object = new StdClass;
            $object->city_id1   = '';
            $object->city_name1 = '';
            TForm::sendData('form_seek_sample', $object);
            
            // undo pending operations
            TTransaction::rollback();
        }
    }
    
    /**
     * Shows the page
     */
    function show()
    {
        // if the datagrid was not loaded yet
        if (!$this->loaded)
        {
            $this->onReload();
        }
        parent::show();
    }
}
?>