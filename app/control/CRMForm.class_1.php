<?php

/**
 * CRMForm Registration
 *
 * @version    1.0
 * @package    db_crmbf
 * @subpackage CRMBF
 * @author     Jackson Meires
 */
class CRMForm extends TPage {

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
        $table = new TTable;
        $table_contact = new TTable;
        $table_skill = new TTable;

        $notebook = new TNotebook(500, 500);
        // add the notebook inside the form
        $this->form->add($notebook);

        $notebook->appendPage('Cadastro Cliente', $table);
       // $notebook->appendPage('Cidade', $table_contact);
//        $notebook->appendPage('Skill (aggregation)', $table_skill);
        // create the form fields
        $code = new TEntry('id');
        $projeto_id = new TDBCombo('projeto_id', 'db_crmbf', 'Projeto', 'id', 'nome');
        $titulo = new TEntry('titulo');
        $data = new TEntry('data');
        $data->setEditable(false);
        $responsavel_id = new TDBCombo('responsavel_id', 'db_crmbf', 'user', 'id', 'name');
        $tempo = new TSpinner('tempo');
        $porcentagem = new TSlider('porcentagem');
        $descricao = new TText('descricao');
        $tipo_id = new TDBCombo('tipo_id', 'db_crmbf', 'Tipo', 'id', 'nome');
        $cliente_id = new TDBCombo('cliente_id', 'db_crmbf', 'Cliente', 'id', 'nome');
        $prioridade_id = new TDBCombo('prioridade_id', 'db_crmbf', 'Prioridade', 'id', 'nome');
        $status_id = new TDBCombo('status_id', 'db_crmbf', 'Status', 'id', 'nome');
        $usuarioalteracao = new THidden('usuarioalteracao');
        $solicitante = new TEntry('solicitante');

        // add field validators
        $titulo->addValidation('Nome', new TRequiredValidator);
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
        $projeto_id->setSize(320);
        $titulo->setSize(320);
        $data->setSize(160);
        $data->setValue(date("d/m/Y H:i:s"));
        $responsavel_id->setSize(160);
        $tempo->setRange(0,1000,1);
        $tempo->setSize(160);
        $porcentagem->setRange(0,100,1);
        $porcentagem->setSize(150);
        $porcentagem->setTip('Porcentagem %');
        $descricao->setSize(320);
        $tipo_id->setSize(150);
        $cliente_id->setSize(150);
        $prioridade_id->setSize(150);
        $status_id->setSize(150);
        $solicitante->setSize(150);       

        $row = $table->addRow();
        $row->addCell(new TLabel('Code:'));
        $row->addCell($code);

        // add a row for the field name
        $row = $table->addRow();
        $row->addCell(new TLabel('Projeto:'));
        $cell = $row->addCell($projeto_id);

        // add a row for the field name
        $row = $table->addRow();
        $row->addCell(new TLabel('Titulo:'));
        $cell = $row->addCell($titulo);

        // add a row for the field Email
        $row = $table->addRow();
        $row->addCell(new TLabel('Data:'));
        $cell = $row->addCell($data);

        // add a row for the field Telefone
        $row = $table->addRow();
        $row->addCell(new TLabel('Responsavel:'));
        $cell = $row->addCell($responsavel_id);

        // add a row for the field celular
        $row = $table->addRow();
        $row->addCell(new TLabel('Tempo:'));
        $cell = $row->addCell($tempo);

        // add a row for the field skype
        $row = $table->addRow();
        $row->addCell(new TLabel('Porcentagem:'));
        $cell = $row->addCell($porcentagem);

        // add a row for the field endereco
        $row = $table->addRow();
        $row->addCell(new TLabel('Tipo:'));
        $row->addCell($tipo_id);

        // add a row for the field endereco
        $row = $table->addRow();
        $row->addCell(new TLabel('Cliente:'));
        $row->addCell($cliente_id);

        // add a row for the field endereco
        $row = $table->addRow();
        $row->addCell(new TLabel('Prioridade:'));
        $row->addCell($prioridade_id);

        // add a row for the field endereco
        $row = $table->addRow();
        $row->addCell(new TLabel('Solicitante:'));
        $row->addCell($solicitante);

        // add a row for the field endereco
        $row = $table->addRow();
        $row->addCell(new TLabel('Descrição:'));
        $row->addCell($descricao);

        // add a row for the field celular
        $row = $table->addRow();
        $row->addCell(new TLabel('Status:'));
        $cell = $row->addCell($status_id);
        
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

         //create an action button (go to list)
        $button2 = new TButton('list');
        $button2->setAction(new TAction(array('CRMList', 'onReload')), 'Ir para Listagem');
        $button2->setImage('ico_datagrid.gif');

        // define wich are the form fields
        $this->form->setFields(array($code, $projeto_id, $titulo, $data, $responsavel_id,
            $tempo, $porcentagem, $descricao, $tipo_id, $cliente_id, $prioridade_id,
            $status_id, $usuarioalteracao, $solicitante, $button1,$button2));

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
            new TSession();

            $this->form->validate();
            // read the form data and instantiates an Active Record
            $crm = $this->form->getData('CRM');
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
                $crm = new CRM($param['key']);

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

}

?>