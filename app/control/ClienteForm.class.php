<?php

/**
 * ClienteForm Registration
 *
 * @version    1.0
 * @package    db_crmbf
 * @subpackage CRMBF
 * @author     Jackson Meires
 */
class ClienteForm extends TPage {

    private $form; // form

    /**
     * Class constructor
     * Creates the page and the registration form
     */

    function __construct() {
        parent::__construct();
        // creates the form
        $this->form = new TForm('form_cliente');

        // creates a table
        $table_data = new TTable;
        $table_contact = new TTable;
        $table_skill = new TTable;

        $notebook = new TNotebook(500, 250);
        // add the notebook inside the form
        $this->form->add($notebook);

        $notebook->appendPage('Cadastro Cliente', $table_data);
       // $notebook->appendPage('Cidade', $table_contact);
//        $notebook->appendPage('Skill (aggregation)', $table_skill);
        // create the form fields
        $code = new TEntry('id');
        $nome = new TEntry('nome');
        $email = new TEntry('email');
        $telefone = new TEntry('telefone');
        $celular = new TEntry('celular');
        $skype = new TEntry('skype');
        $endereco = new TEntry('endereco');
//        $cidade_id = new TSeekButton('cidade_id');
        $cidade_id = new TDBCombo('cidade_id', 'db_crmbf', 'Cidade', 'id', 'nome');
//        $birthdate = new TDate('birthdate');
//        $email = new TEntry('email');
//        $gender = new TRadioGroup('gender');
//        $status = new TCombo('status');
//        $contacts_list = new TMultiField('contacts_list');

        // add field validators
        $nome->addValidation('Nome', new TRequiredValidator);
        $cidade_id->addValidation('Cidade', new TRequiredValidator);
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
        $nome->setSize(320);
        $email->setSize(160);
        $telefone->setSize(160);
        $celular->setSize(160);
        $skype->setSize(160);
        $endereco->setSize(320);
        $cidade_id->setSize(150);
        //$cidade_id->setEditable(FALSE);
       

        // add a row for the field code
        $row = $table_data->addRow();
        $row->addCell(new TLabel('Code:'));
        $row->addCell($code);

        // add a row for the field name
        $row = $table_data->addRow();
        $row->addCell(new TLabel('Nome:'));
        $cell = $row->addCell($nome);
        $cell->colspan = 3;

        // add a row for the field Email
        $row = $table_data->addRow();
        $row->addCell(new TLabel('Email:'));
        $cell = $row->addCell($email);
        $cell->colspan = 3;
        
        // add a row for the field Telefone
        $row = $table_data->addRow();
        $row->addCell(new TLabel('Telefone:'));
        $cell = $row->addCell($telefone);
        $cell->colspan = 3;

        // add a row for the field celular
        $row = $table_data->addRow();
        $row->addCell(new TLabel('Celular:'));
        $cell = $row->addCell($celular);
        
        // add a row for the field skype
        $row = $table_data->addRow();
        $row->addCell(new TLabel('skype:'));
        $cell = $row->addCell($skype);

        // add a row for the field endereco
        $row = $table_data->addRow();
        $row->addCell(new TLabel('Endereço:'));
        $row->addCell($endereco);
       
        // add a row for the field endereco
        $row = $table_data->addRow();
        $row->addCell(new TLabel('Cidade:'));
        $row->addCell($cidade_id);
        
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

        // create an action button (go to list)
        $button2 = new TButton('list');
        $button2->setAction(new TAction(array('ClienteList', 'onReload')), 'Ir para Listagem');
        $button2->setImage('ico_datagrid.gif');

        // define wich are the form fields
        $this->form->setFields(array($code, $nome,$email,$telefone,$celular
            ,$skype,$endereco,$cidade_id, $button1, $button2));

        $subtable = new TTable;
        $row = $subtable->addRow();
        $row->addCell($button1);
        $row->addCell($button2);

        $table_layout = new TTable;
        $table_layout->addRow()->addCell($this->form);
        $table_layout->addRow()->addCell($subtable);

        // add the form inside the page
        parent::add($table_layout);
    }

    /**
     * method onSave
     * Executed whenever the user clicks at the save button
     */
    function onSave() {
        try {
            // open a transaction with database 'samples'
            TTransaction::open('db_crmbf');

            $this->form->validate();
            // read the form data and instantiates an Active Record
            $customer = $this->form->getData('Cliente');

            if ($customer->contacts_list) {
                foreach ($customer->contacts_list as $contact) {
                    // add the contact to the customer
                    $customer->addContact($contact);
                }
            }

            if ($customer->skill_list) {
                foreach ($customer->skill_list as $skill_id) {
                    // add the skill to the customer
                    $customer->addSkill(new Skill($skill_id));
                }
            }
            // stores the object in the database
            $customer->store();
            $this->form->setData($customer);

            // shows the success message
            new TMessage('info', 'Registro Salvo');

            TTransaction::close(); // close the transaction
        } catch (Exception $e) { // in case of exception
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
                $cliente = new Cliente($param['key']);

                // load the contacts (composition)
                $cliente->contacts_list = $cliente->getContacts();

                // load the skills (aggregation)
                $skills = $cliente->getSkills();
                $skill_list = array();
                if ($skills) {
                    foreach ($skills as $skill) {
                        $skill_list[] = $skill->id;
                    }
                }
                $cliente->skill_list = $skill_list;

                // fill the form with the active record data
                $this->form->setData($cliente);

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

}

?>