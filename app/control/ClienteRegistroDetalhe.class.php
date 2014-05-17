<?php

/**
 * ClienteRegistroDetalhe Registration
 *
 * @version    1.0
 * @package    db_crmbf
 * @subpackage CRMBF
 * @author     Jackson Meires
 */
class ClienteRegistroDetalhe extends TPage {

    private $form; // form

    /**
     * Class constructor
     * Creates the page and the registration form
     */

    function __construct() {
        parent::__construct();
        // creates the form
        $this->form = new TForm('form_clienteRegistro_Detalhe');
        new TSession();
        
        // creates a table
        $table = new TTable;
        $panel = new TPanel(480, 250);
        //  $panel->style = "background-image: url(app/images/background.png);";

        $notebook = new TNotebook(500, 250);
        // add the notebook inside the form
        $this->form->add($notebook);

        // add the notebook inside the form
        $this->form->add($table);

        // envia key e fk para sessao
        TSession::setValue('crm_key', $_GET['key']);
        TSession::setValue('cliente_fk', $_GET['fk']);
      
        //dados do cliente CRM
        TTransaction::open('db_crmbf');
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cliente_id', '=', $_GET['fk']));
       
        $repository = new TRepository('CRM');
        $CRM = $repository->load($criteria);

        foreach ($CRM as $crms) {
            $codigoCRM = $crms->id;
            $tituloCRM = $crms->titulo;
            $projetoCRM = $crms->projeto_nome;
            $dataCRM = $crms->data_crm;
            $tempoCRM = $crms->tempo;
            $porcentagemCRM = $crms->porcentagem;
            $descricaoCRM = $crms->descricao;
            $solicitanteCRM = $crms->solicitante;
            $usuarioalteracaoCRM = $crms->usuarioalteracao;
            $responsavel_nomeCRM = $crms->responsavel_nome;
            $tipo_nomeCRM = $crms->tipo_nome;
            $cliente_nomeCRM = $crms->cliente_nome;
            $prioridade_nomeCRM = $crms->prioridade_nome;
            $status_nomeCRM = $crms->status_nome;
        }
        TTransaction::close();


        $titulo = new TLabel('CRM - Registros');
        $titulo->setFontSize(14);
        $titulo->setFontFace('Arial');
        $titulo->setFontColor('red');

        // add a row for the field code
        $panel->put($titulo, 10, 5);
        $panel->put("CRM: " . $codigoCRM, 10, 25);
        $panel->put("Titulo: " . $tituloCRM, 10, 45);
        $panel->put("Projeto: " . $projetoCRM, 10, 65);
        $panel->put("Data de Criação: " . $dataCRM, 10, 85);
        $panel->put("Aberto por: " . $usuarioalteracaoCRM, 10, 105);
        $panel->put("Cliente: " . $cliente_nomeCRM, 10, 125);
        $panel->put("Responsavel: " . $responsavel_nomeCRM, 10, 145);
        $panel->put("Tipo: " . $tipo_nomeCRM, 10, 165);
        $panel->put("Percentual Conclusão: " . $porcentagemCRM, 10, 185);
        $panel->put("Tempo Gasto: " . $tempoCRM, 10, 205);
        $panel->put("Situação: " . $status_nomeCRM, 10, 225);
        
        //inserir button no panel
        $panel->put($button1, 10, 325);
        $panel->put($button2, 100, 325);

        // create an action button
        $button1 = new TButton('action1');
        $action1 = new TAction(array('CRMClienteList', 'onReload'));
        $action1->setParameter('key', $_GET['fk']);
        $button1->setImage('ico_datagrid.png');
        $button1->setAction($action1, 'Voltar');

        // create an action button
        $button2 = new TButton('action2');
        $action2 = new TAction(array('RegistroForm', 'onEdit'));
        $action2->setParameter('fk', $_GET['fk']);
        $button2->setImage('ico_save.png');
        $button2->setAction($action2, 'Inserir Registro');

        // define wich are the form fields
        $this->form->setFields(array($button1, $button2));

        $subtable = new TTable;
        $row = $subtable->addRow();
        $row->addCell($button2);
        $row->addCell($button1);

        $table_layout = new TTable;
        $table_layout->addRow()->addCell($subtable);
        $table_layout->addRow()->addCell($this->form);

        //dados do cliente CRM
        TTransaction::open('db_crmbf');
        $criteria2 = new TCriteria;
        // $criteria->add(new TFilter('crm_id', '=', $_GET['key']));
        $criteria2->setProperty('order', 'id desc');
        $repository2 = new TRepository('Registro');
        $reg = $repository2->load($criteria2);

        foreach ($reg as $regs) {
            $row = $table->addRow();
            $row->addCell(new TLabel('ID:'));
            $cell = $row->addCell($regs->id);

            $row = $table->addRow();
            $row->addCell(new TLabel('CRM:'));
            $cell = $row->addCell($regs->crm_id);

            $row = $table->addRow();
            $row->addCell(new TLabel('CRM:'));
            $cell = $row->addCell($regs->tiporegistro_id);

            $row = $table->addRow();
            $row->addCell(new TLabel('Tempo:'));
            $cell = $row->addCell($regs->tempo_registro);

            $row = $table->addRow();
            $row->addCell(new TLabel('Data:'));
            $cell = $row->addCell($regs->data_registro);

            $row = $table->addRow();
            $row->addCell(new TLabel('Horario:'));
            $cell = $row->addCell($regs->hora_registro);

            $row = $table->addRow();
            $row->addCell(new TLabel('Numero Registro:'));
            $cell = $row->addCell($regs->numero_registro);

            $row = $table->addRow();
            $row->addCell(new TLabel('Registro:'));
            $cell = $row->addCell($regs->registro);

            $row = $table->addRow();
            $row->addCell(new TLabel(' '));
            $cell = $row->addCell(' ');

        }
        TTransaction::close();
        parent::add($panel);
        parent::add($table_layout);
    }

    /**
     * method onEdit
     * Edit a record data
     */
    function onEdit($param) {
//        print_r($_GET);
//        exit();
        try {
            if (isset($param['key'])) {
                // open a transaction with database 'samples'
                TTransaction::open('db_crmbf');

                // load the Active Record according to its ID
                $cliente = new Cliente($param['key']);

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