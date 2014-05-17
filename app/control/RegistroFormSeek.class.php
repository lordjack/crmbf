<?php

/**
 * RegistroForm Registration
 *
 * @version    1.0
 * @package    db_crmbf
 * @subpackage CRMBF
 * @author     Jackson Meires
 */
class RegistroFormSeek extends TWindow {

    private $form; // form

    /**
     * Class constructor
     * Creates the page and the registration form
     */

    function __construct() {
        parent::__construct();
        // creates the form
        $this->form = new TForm('form_crm');

        // creates a table
//        $table = new TTable;
        $panel = new TPanel(100, 10);

        // add the notebook inside the form
      
        $this->form->add($panel);

        $panel->put(new TLabel('CRM Titulo:'),0,0);
        // $notebook->appendPage('Cidade', $table_contact);
//        $notebook->appendPage('Skill (aggregation)', $table_skill);
        // create the form fields
        $code = new TEntry('id');
//        $crm_id = new TDBCombo('crm_id', 'db_crmbf', 'CRM', 'id', 'titulo');
        $crm_id = new TEntry('crm_nome');
        $tiporegistro_id = new TDBCombo('tiporegistro_id', 'db_crmbf', 'RegistroTipo', 'id', 'nome');
        $registro = new TText('registro');
        $temporegistro = new TEntry('tempo_registro');
//        $temporegistro->setEditable(false);
        $dataregistro = new TDate('data_registro');
        $hora_registro = new TEntry('hora_registro');
        $numero_registro = new TEntry('numero_registro');
        
        // add field validators
        $registro->addValidation('Nome', new TRequiredValidator);
        // $cidade_id->addValidation('Cidade', new TRequiredValidator);
        // $birthdate->addValidation('Birthdate', new TRequiredValidator);
//        $cidade_id->addValidation('Category', new TRequiredValidator);
        //$obj = new CidadeFormList;
        //$cidade_id->setAction(new TAction(array($obj, 'onReload')));
//        $itemGender = array();
//        $itemGender['M'] = 'Male';
//        $itemGender['F'] = 'Female';
//        // add the combo options
//        $gender->addItems($itemGender);
//        $gender->setLayout('horizontal');
//
//        $itemStatus = array();
//        $itemStatus['S'] = 'Single';
//        $itemStatus['C'] = 'Committed';
//        $itemStatus['M'] = 'Married';
//        $status->addItems($itemStatus);
        // define some properties for the form fields
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

        $panel->put("Codigo: ", 10, 25);
        $panel->put("CRM: ", 10, 50);
        $panel->put("Tipo: ", 10, 75);
        $panel->put("Tempo: ", 10, 100);
        $panel->put("Data: ", 10, 125);
        $panel->put("Horario: ", 10, 150);
        $panel->put("Nº Registro: ", 10, 175);
        $panel->put("Registro: ", 10, 200);

        $panel->put($code, 100, 25);
        $panel->put($crm_id, 100, 50);
        $panel->put($tiporegistro_id, 100, 75);
        $panel->put($temporegistro, 100, 100);
        $panel->put($dataregistro, 100, 125);
        $panel->put($hora_registro, 100, 150);
        $panel->put($numero_registro, 100, 175);
        $panel->put($registro, 100, 200);
        
//        $row = $table->addRow();
//        $row->addCell(new TLabel('Code:'));
//        $row->addCell($code);
//
//        // add a row for the field name
//        $row = $table->addRow();
//        $row->addCell(new TLabel('CRM Titulo:'));
//        $cell = $row->addCell($crm_id);
//
//        // add a row for the field Telefone
//        $row = $table->addRow();
//        $row->addCell(new TLabel('Tipo Registro:'));
//        $cell = $row->addCell($tiporegistro_id);
//
//        // add a row for the field Email
//        $row = $table->addRow();
//        $row->addCell(new TLabel('Tempo:'));
//        $cell = $row->addCell($temporegistro);
//
//        // add a row for the field celular
//        $row = $table->addRow();
//        $row->addCell(new TLabel('Data:'));
//        $cell = $row->addCell($dataregistro);
//
//        // add a row for the field skype
//        $row = $table->addRow();
//        $row->addCell(new TLabel('Hora:'));
//        $cell = $row->addCell($hora_registro);
//
//        // add a row for the field endereco
//        $row = $table->addRow();
//        $row->addCell(new TLabel('Numero Registro:'));
//        $row->addCell($numero_registro);
//
//        // add a row for the field name
//        $row = $table->addRow();
//        $row->addCell(new TLabel('Registro:'));
//        $cell = $row->addCell($registro);

        // add a row for the field Category
//        $row = $table_data->addRow();
//        $row->addCell(new TLabel('Cidade:'));
//        $cell = $row->addCell($cidade_id);
        // add a row for the field city
//        $row=$table_data->addRow();
//        $row->addCell(new TLabel('Cidade:'));
//        $cell = $row->addCell($cidade_id);


        /*
          // add a row for the field Phone
          $row = $table_data->addRow();
          $row->addCell(new TLabel('Phone:'));
          $row->addCell($phone);

          // add a row for the field BirthDate
          $row->addCell(new TLabel('BirthDate:'));
          $row->addCell($birthdate);

          // add a row for the field status
          $row = $table_data->addRow();
          $row->addCell(new TLabel('Status:'));
          $cell = $row->addCell($status);

          // add a row for the field Email
          $row->addCell(new TLabel('Email:'));
          $cell = $row->addCell($email);

          // add a row for the field gender
          $row->addCell(new TLabel('Gender:'));
          $row->addCell($gender);

          $row = $table_contact->addRow();
          $cell = $row->addCell(new TLabel('<b>Contact</b>'));
          $cell->valign = 'top';

          // add two fields inside the multifield in the second sheet
          $contacts_list->setHeight(100);
          $contacts_list->setClass('Contact'); // define the returning class
          $contacts_list->addField('type', 'Contact Type: ', new TEntry('type'), 200);
          $contacts_list->addField('value', 'Contact Value: ', new TEntry('value'), 200);
          $row = $table_contact->addRow();
          $row->addCell($contacts_list);

          // create the radio button for the skills list
          $skill_list = new TDBCheckGroup('skill_list', 'samples', 'Skill', 'id', 'name');
          $table_skill->addRow()->addCell($lbl = new TLabel('Skills'));
          $table_skill->addRow()->addCell($skill_list);
          $lbl->setFontStyle('b');

         * 
         */
        // create an action button
        $button1 = new TButton('action1');
        $button1->setAction(new TAction(array($this, 'onSave')), 'Save');
        $button1->setImage('ico_save.png');
        $button1->setProperty('width',150);

        //  create an action button (go to list)
        $button2 = new TButton('list');
        $button2->setAction(new TAction(array('RegistroList', 'onReload')), 'Ir para Listagem');
        $button2->setImage('ico_datagrid.gif');
        $button2->setProperty('width',100);
        $panel->put($button1, 100, 325);
        $panel->put($button2, 200, 325);
        
        
        // define wich are the form fields
        $this->form->setFields(array($code, $crm_id, $registro, $temporegistro, $tiporegistro_id,
            $dataregistro, $hora_registro, $numero_registro, $button1, $button2));

//        $subtable = new TTable;
//        $row = $subtable->addRow();
//        $row->addCell($button1);
//        $row->addCell($button2);

//        $table_layout = new TTable;
//        $table_layout->addRow()->addCell($this->form);
//        $table_layout->addRow()->addCell($subtable);

        // add the form inside the page
        parent::add($panel);
//        parent::add($table_layout);
    }

    /**
     * method onSave
     * Executed whenever the user clicks at the save button
     */
    function onSave() {
        try {
            // open a transaction with database 'samples'
            TTransaction::open('db_crmbf');
            new TSession();

            $this->form->validate();
            // read the form data and instantiates an Active Record
            $crm = $this->form->getData('Registro');
            $crm->usuarioalteracao = TSession::getValue('login');
            var_dump($crm);
            Print_r($_SESSION);
            //  exit();
//            if ($customer->contacts_list) {
//                foreach ($customer->contacts_list as $contact) {
//                    // add the contact to the customer
//                    $customer->addContact($contact);
//                }
//            }
//
//            if ($customer->skill_list) {
//                foreach ($customer->skill_list as $skill_id) {
//                    // add the skill to the customer
//                    $customer->addSkill(new Skill($skill_id));
//                }
//            }
            // stores the object in the database
            $crm->store();
            $this->form->setData($crm);

            // shows the success message
            new TMessage('info', 'Registro Salvo');

            TTransaction::close(); // close the transaction
        } catch (Exception $e) { // in case of exception
            $this->form->setData($crm);
            // shows the exception error message
            new TMessage('error', '<b>Error</b>' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    /**
     * method onEdit
     * Edit a record data
     */
    function onEdit($param) {
        try {
            if (isset($param['key'])) {
                // open a transaction with database 'samples'
                TTransaction::open('db_crmbf');

                // load the Active Record according to its ID
                $crm = new Registro($param['key']);
//        var_dump($crm);
//        exit();
                // load the contacts (composition)
                //    $cliente->contacts_list = $cliente->getContacts();
//                // load the skills (aggregation)
//                $skills = $cliente->getSkills();
//                $skill_list = array();
//                if ($skills) {
//                    foreach ($skills as $skill) {
//                        $skill_list[] = $skill->id;
//                    }
//                }
//                $cliente->skill_list = $skill_list;
                // fill the form with the active record data
                $this->form->setData($crm);

                // close the transaction
                TTransaction::close();
            } else {
                $this->form->clear();
            }
        } catch (Exception $e) { // in case of exception
            // shows the exception error message
            new TMessage('error', '<b>Error</b>' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    /**
     * Load the datagrid with the database objects
     */
    function onReload($param = NULL) {
        try {
            // start database transaction
            TTransaction::open('db_crmbf');

            // create a repository for City table
            $repository = new TRepository('Registro');
            $limit = 10;
            // creates a criteria
            $criteria = new TCriteria;
            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);

//            if (TSession::getValue('test_city_filter'))
//            {
//                // filter by city name
//                $criteria->add(TSession::getValue('test_city_filter'));
//            }
            // load the objects according to the criteria
            $cities = $repository->load($criteria);
            $this->datagrid->clear();
            if ($cities) {
                foreach ($cities as $city) {
                    // add the objects inside the datagrid
                    $this->datagrid->addItem($city);
                }
            }

            // clear the criteria
            $criteria->resetProperties();
            $count = $repository->count($criteria);

            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            // commit and closes the database transaction
            TTransaction::close();
            $this->loaded = true;
        } catch (Exception $e) { // exceptions
            // show the error message
            new TMessage('error', '<b>Erro</b> ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    /**
     * Executed when the user chooses the record
     */
    function onSelect($param) {
        try {
            $key = $param['key'];
            TTransaction::open('samples');

            // load the active record
            $city = new City($key);

            // closes the transaction
            TTransaction::close();

            $object = new StdClass;
            $object->city_id1 = $city->id;
            $object->city_name1 = $city->name;

            TForm::sendData('form_seek_sample', $object);
            parent::closeWindow(); // closes the window
        } catch (Exception $e) { // em caso de exceção
            // clear fields
            $object = new StdClass;
            $object->city_id1 = '';
            $object->city_name1 = '';
            TForm::sendData('form_seek_sample', $object);

            // undo pending operations
            TTransaction::rollback();
        }
    }

}

?>