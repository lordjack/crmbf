<?php

/**
 * RegistroForm Registration
 *
 * @version    1.0
 * @package    db_crmbf
 * @subpackage CRMBF
 * @author     Jackson Meires
 */
class RegistroForm extends TPage {

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

        $notebook = new TNotebook(500, 320);
        // add the notebook inside the form
        $this->form->add($notebook);

        $notebook->appendPage('Cadastro Registro CRM', $table);
        // create the form fields
        $code = new TEntry('id');
        $crm_id = new TCombo('crm_id');
        $tiporegistro_id = new TDBCombo('tiporegistro_id', 'db_crmbf', 'RegistroTipo', 'id', 'nome');
        $registro = new TText('registro');
        $temporegistro = new TEntry('tempo_registro');
//        $temporegistro->setEditable(false);
        $dataregistro = new TDate('data_registro');
        $hora_registro = new TEntry('hora_registro');
        $numero_registro = new TEntry('numero_registro');

        // finaliza a transacao
        TTransaction::close();

        $items1 = array();
        //dados do cliente CRM
        TTransaction::open('db_crmbf');
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cliente_id', '=', $_GET['fk']));

        $repository = new TRepository('CRM');
        $cadastros = $repository->load($criteria);
        //adiciona os objetos no combo
        foreach ($cadastros as $object) {
            $items1[$object->id] = $object->titulo;
        }

        // adiciona as opcoes na combo
        $crm_id->addItems($items1);

        TTransaction::close();

        // add field validators
        $registro->addValidation('Registro deve ser informado', new TRequiredValidator);
    
        // define some properties for the form fields
        $code->setEditable(FALSE);
        $code->setSize(100);
        $crm_id->setSize(320);
//        $crm_id->setEditable(FALSE);
        $registro->setSize(320);
        $temporegistro->setSize(160);
        $temporegistro->setValue(date("d/m/Y H:i:s"));
        $tiporegistro_id->setSize(160);
        $dataregistro->setSize(90);
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

        // create an action button
        $button1 = new TButton('action1');
        $button1->setAction(new TAction(array($this, 'onSave')), 'Save');
        $button1->setImage('ico_save.png');

        // create an action button
        $button2 = new TButton('action3');
        $action2 = new TAction(array('ClienteRegistroDetalhe', 'onEdit'));
        //parametro fk e key da sessao
        $action2->setParameter('fk', TSession::getValue('cliente_fk'));
        $action2->setParameter('key', TSession::getValue('crm_key'));
        $button2->setImage('ico_datagrid.png');
        $button2->setAction($action2, 'Voltar');

        // define wich are the form fields
        $this->form->setFields(array($code, $crm_id, $registro, $temporegistro, $tiporegistro_id,
            $dataregistro, $hora_registro, $numero_registro, $button1, $button2));

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
            $crm = $this->form->getData('Registro');
            $crm->usuarioalteracao = TSession::getValue('login');

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
//        var_dump($param);
//        exit();
        try {
            if (isset($param['key'])) {
                // open a transaction with database 'samples'
                TTransaction::open('db_crmbf');

                // load the Active Record according to its ID
                $crm = new Registro($param['key']);

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