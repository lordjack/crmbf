 <?php
/**
 * FormCustomView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2013 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class FormCustomView extends TPage
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
        $notebook = new TNotebook(620, 410);
        
        // create the form
        $this->form = new TForm;
        
        // creates the notebook page
        $table = new TTable;
        
        // add the notebook inside the form
        $this->form->add($table);
        
        // adds the notebook page
        $notebook->appendPage('Input elements', $this->form);
        
        // create the form fields
        $field1  = new TEntry('field1');
        $field2  = new TEntry('field2');
        $field3  = new TEntry('field3');
        $field4  = new TEntry('field4');
        $field5  = new TEntry('field5');
        $field6  = new TPassword('field6');
        $field7  = new TDate('field7');
        $field8  = new TSpinner('field8');
        $field9  = new TSlider('field9');
        $field10 = new TText('field10');
        
        $field1->setTip('Tip for field 1');
        $field2->setTip('Tip for field 2');
        $field3->setTip('Tip for field 3');
        $field4->setTip('Tip for field 4');
        $field5->setTip('Tip for field 5');
        $field6->setTip('Tip for field 6');
        $field7->setTip('Tip for field 7');
        $field8->setTip('Tip for field 8');
        $field9->setTip('Tip for field 9');
        $field10->setTip('Tip for field 10');
        
        $field2->setValue('123');
        $field2->setEditable(FALSE);
        $field3->setMask('99.999-999');
        $field4->setMaxLength(10);
        $field5->setCompletion(array('Allen','Albert','Alberto','Alladin'));
        $field7->setSize(100);
        $field8->setRange(0,100,10);
        $field9->setRange(0,100,10);
        $field8->setValue(30);
        $field9->setValue(50);
        $field10->setSize(300,80);
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('TEntry object:'));
        $cell = $row->addCell( $field1 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('TEntry not editable:'));
        $cell = $row->addCell( $field2 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('TEntry with mask:'));
        $cell = $row->addCell( $field3 );
        $cell = $row->addCell( new TLabel('99.999-999') );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('TEntry with maxlength (10):'));
        $cell = $row->addCell( $field4 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('TEntry with completion (a..):'));
        $cell = $row->addCell( $field5 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('TPassword object:'));
        $cell = $row->addCell( $field6 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('TDate Object:'));
        $cell = $row->addCell( $field7 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('Spinner Object:'));
        $cell = $row->addCell( $field8 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('Slider Object:'));
        $cell = $row->addCell( $field9 );
        
        // add a row for one field
        $row=$table->addRow();
        $row->addCell(new TLabel('TText Object:'));
        $cell = $row->addCell( $field10 );
        
        // creates the action button
        $button1=new TButton('action1');
        // define the button action
        $button1->setAction(new TAction(array($this, 'onSave')), 'Save');
        $button1->setImage('ico_save.png');
        
        // define wich are the form fields
        $this->form->setFields(array($field1, $field2, $field3, $field4, $field5, $field6, $field7, $field8, $field9, $field10, $button1));
        
        // add a row for the button
        $row=$table->addRow();
        $row->addCell($button1);
        
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
        $message = 'Field 1 : ' . $data->field1 . '<br>';
        $message.= 'Field 2 : ' . $data->field2 . '<br>';
        $message.= 'Field 3 : ' . $data->field3 . '<br>';
        $message.= 'Field 4 : ' . $data->field4 . '<br>';
        $message.= 'Field 5 : ' . $data->field5 . '<br>';
        $message.= 'Field 6 : ' . $data->field6 . '<br>';
        $message.= 'Field 7 : ' . $data->field7 . '<br>';
        $message.= 'Field 8 : ' . $data->field8 . '<br>';
        $message.= 'Field 9 : ' . $data->field9 . '<br>';
        $message.= 'Field 10 : ' . $data->field10 . '<br>';
        
        // show the message
        new TMessage('info', $message);
    }
}
?> 