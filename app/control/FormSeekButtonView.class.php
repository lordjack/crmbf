<?php
/**
 * FormSeekButtonView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2013 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class FormSeekButtonView extends TPage
{
    private $form;
    
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
        // create the notebook
        $notebook = new TNotebook(530, 200);
        
        // create the form
        $this->form = new TForm('form_seek_sample');
        
        // creates the notebook page
        $table = new TTable;
        
        // add the notebook inside the form
        $this->form->add($table);
        
        // adds the notebook page
        $notebook->appendPage('Seek Button component', $this->form);
        
        // create the form fields
        $city_id1   = new TSeekButton('city_id1');
        $city_name1 = new TEntry('city_name1');
        
        $city_id2   = new TSeekButton('city_id2');
        $city_name2 = new TEntry('city_name2');
        
        $city_id1->setSize(100);
        $city_id2->setSize(100);
        $city_name1->setEditable(FALSE);
        $city_name2->setEditable(FALSE);
        
        $obj = new TestCitySeek;
        $action = new TAction(array($obj, 'onReload'));
        $city_id1->setAction($action);
        
        $obj = new TStandardSeek;
        $action = new TAction(array($obj, 'onSetup'));
        $action->setParameter('database',      'samples');
        $action->setParameter('parent',        'form_seek_sample');
        $action->setParameter('model',         'City');
        $action->setParameter('display_field', 'name');
        $action->setParameter('receive_key',   'city_id2');
        $action->setParameter('receive_field', 'city_name2');
        $city_id2->setAction($action);
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('Manual SeekButton:'));
        $cell = $row->addCell( $city_id1 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('City name:'));
        $cell = $row->addCell( $city_name1 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('Standard SeekButton:'));
        $cell = $row->addCell( $city_id2 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('City name:'));
        $cell = $row->addCell( $city_name2 );
        
        // creates the action button
        $button1=new TButton('action1');
        // define the button action
        $button1->setAction(new TAction(array($this, 'onSave')), 'Save');
        $button1->setImage('ico_save.png');
        
        // add a row for the button
        $row=$table->addRow();
        $row->addCell($button1);
        
        // define wich are the form fields
        $this->form->setFields(array($city_id1, $city_name1, $city_id2, $city_name2, $button1));
        
        // add the form inside the page
        parent::add($notebook);
    }
    
    /**
     * Simulates an save button
     * Show the form content
     */
    public function onSave($param)
    {
        $data = $this->form->getData(); // optional parameter: active record class
        
        // put the data back to the form
        $this->form->setData($data);
        
        // creates a string with the form element's values
        $message = 'City id 1 : ' . $data->city_id1 . '<br>';
        $message.= 'City name 1 : ' . $data->city_name1 . '<br>';
        $message.= 'City id 2 : ' . $data->city_id2 . '<br>';
        $message.= 'City name 2 : ' . $data->city_name2 . '<br>';
        
        // show the message
        new TMessage('info', $message);
    }
}
?>