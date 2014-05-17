<?php
/**
 * BookForm Registration
 *
 * @version    1.0
 * @package    samples
 * @subpackage library
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2011 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class BookForm extends TPage
{
    private $form; // form
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        // security check
        if (TSession::getValue('logged') !== TRUE)
        {
            throw new Exception(_t('Not logged'));
        }
        
        // security check
        TTransaction::open('library');
        if (User::newFromLogin(TSession::getValue('login'))-> role -> mnemonic !== 'LIBRARIAN')
        {
            throw new Exception(_t('Permission denied'));
        }
        TTransaction::close();
        
        // creates the form
        $this->form = new TForm('form_Book');
        
        // creates a table
        $table1 = new TTable;
        $table2 = new TTable;
        $table3 = new TTable;
        
        $notebook = new TNotebook(550, 400);
        $notebook->appendPage(_t('Basic data'), $table1);
        $notebook->appendPage(_t('Secundary data'), $table2);
        $notebook->appendPage(_t('Items'), $table3);
        
        // add the table inside the form
        $this->form->add($notebook);
        
        // create the form fields
        $id                             = new TEntry('id');
        $title                          = new TEntry('title');
        $isbn                           = new TEntry('isbn');
        $call_number                    = new TEntry('call_number');
        $author_id                      = new TSeekButton('author_id');
        $author_name                    = new TEntry('author_name');
        $edition                        = new TEntry('edition');
        $volume                         = new TEntry('volume');
        $collection_id                  = new TDBCombo('collection_id', 'library', 'Collection', 'id', 'description');
        $classification_id              = new TDBCombo('classification_id', 'library', 'Classification', 'id', 'description');
        $publisher_id                   = new TSeekButton('publisher_id');
        $publisher_name                 = new TEntry('publisher_name');
        $publish_place                  = new TEntry('publish_place');
        $publish_date                   = new TDate('publish_date');
        $abstract                       = new TText('abstract');
        $notes                          = new TText('notes');

        $obj = new TStandardSeek;
        $action = new TAction(array($obj, 'onSetup'));
        $action->setParameter('database',      'library');
        $action->setParameter('parent',        'form_Book');
        $action->setParameter('model',         'Publisher');
        $action->setParameter('display_field', 'name');
        $action->setParameter('receive_key',   'publisher_id');
        $action->setParameter('receive_field', 'publisher_name');
        $publisher_id->setAction($action);
        
        $obj = new TStandardSeek;
        $action = new TAction(array($obj, 'onSetup'));
        $action->setParameter('database',      'library');
        $action->setParameter('parent',        'form_Book');
        $action->setParameter('model',         'Author');
        $action->setParameter('display_field', 'name');
        $action->setParameter('receive_key',   'author_id');
        $action->setParameter('receive_field', 'author_name');
        $author_id->setAction($action);
        
        // define the sizes
        $id->setSize(100);
        $title->setSize(340);
        $isbn->setSize(120);
        $call_number->setSize(120);
        $author_id->setSize(100);
        $edition->setSize(120);
        $volume->setSize(120);
        $collection_id->setSize(100);
        $classification_id->setSize(100);
        $publisher_id->setSize(100);
        $publish_place->setSize(140);
        $publish_date->setSize(100);
        $abstract->setSize(400, 40);
        $notes->setSize(400, 40);
        
        $id->setEditable(FALSE);
        $publisher_name->setEditable(FALSE);
        $author_name->setEditable(FALSE);
        
        // add a row for the field id
        $row=$table1->addRow();
        $row->addCell(new TLabel(_t('Code')));
        $cell=$row->addCell($id);
        $cell->colspan=3;

        // add a row for the field title
        $row=$table1->addRow();
        $row->addCell(new TLabel(_t('Title')));
        $cell=$row->addCell($title);
        $cell->colspan=3;

        // add a row for the field isbn/call_nuber
        $row=$table1->addRow();
        $row->addCell(new TLabel('ISBN' . ': '));
        $row->addCell($isbn);
        $row->addCell(new TLabel(_t('Call')));
        $row->addCell($call_number);

        // add a row for the field author_id
        $row=$table1->addRow();
        $row->addCell(new TLabel(_t('Author') . ': '));
        $row->addCell($author_id);
        $row->addCell(new TLabel(_t('Name').': '));
        $row->addCell($author_name);

        // add a row for the field edition/volume
        $row=$table1->addRow();
        $row->addCell(new TLabel(_t('Edition') . ': '));
        $row->addCell($edition);
        $row->addCell(new TLabel(_t('Volume') . ': '));
        $row->addCell($volume);

        // add a row for the field collection_id/classification_id
        $row=$table1->addRow();
        $row->addCell(new TLabel(_t('Collection') . ': '));
        $row->addCell($collection_id);
        $row->addCell(new TLabel(_t('Classification') . ': '));
        $row->addCell($classification_id);

        // add a row for the field publisher_id
        $row=$table1->addRow();
        $row->addCell(new TLabel(_t('Publisher') . ': '));
        $row->addCell($publisher_id);
        $row->addCell(new TLabel(_t('Name').': '));
        $row->addCell($publisher_name);

        // add a row for the field publish_place
        $row=$table1->addRow();
        $row->addCell(new TLabel(_t('Place') . ': '));
        $row->addCell($publish_place);
        $row->addCell(new TLabel(_t('Date') . ': '));
        $row->addCell($publish_date);

        // add a row for the field abstract
        $row=$table1->addRow();
        $row->addCell(new TLabel(_t('Abstract') . ': '));
        $cell=$row->addCell($abstract);
        $cell->colspan=3;
        // add a row for the field notes
        $row=$table1->addRow();
        $row->addCell(new TLabel(_t('Notes') . ': '));
        $cell=$row->addCell($notes);
        $cell->colspan=3;
        
        
        // secundary authors
        $authors = new TMultiField('author_list');
        $sub_author_id   = new TSeekButton('id');
        $sub_author_name = new TEntry('name');
        $sub_author_name->setEditable(FALSE);
        $sub_author_id->setSize(50);
        $sub_author_name->setSize(300);
        $obj = new TStandardSeek;
        $action = new TAction(array($obj, 'onSetup'));
        $action->setParameter('database',      'library');
        $action->setParameter('parent',        'form_Book');
        $action->setParameter('model',         'Author');
        $action->setParameter('display_field', 'name');
        $action->setParameter('receive_key',   'author_list_id');
        $action->setParameter('receive_field', 'author_list_name');
        $sub_author_id->setAction($action);
        
        $authors->setHeight(80);
        $authors->setClass('Author');
        $authors->addField('id',   _t('Author'), $sub_author_id,   50);
        $authors->addField('name', _t('Name'),   $sub_author_name, 300);
        
        $row=$table2->addRow();
        $row->addCell($l=new TLabel(_t('Authors')));
        $l->setFontStyle('b');
        
        $row=$table2->addRow();
        $row->addCell($authors);
        
        
        // secundary subjects
        $subjects = new TMultiField('subject_list');
        $sub_subject_id   = new TSeekButton('id');
        $sub_subject_name = new TEntry('name');
        $sub_subject_name->setEditable(FALSE);
        $sub_subject_id->setSize(50);
        $sub_subject_name->setSize(300);
        $obj = new TStandardSeek;
        $action = new TAction(array($obj, 'onSetup'));
        $action->setParameter('database',      'library');
        $action->setParameter('parent',        'form_Book');
        $action->setParameter('model',         'Subject');
        $action->setParameter('display_field', 'name');
        $action->setParameter('receive_key',   'subject_list_id');
        $action->setParameter('receive_field', 'subject_list_name');
        $sub_subject_id->setAction($action);
        
        $subjects->setHeight(80);
        $subjects->setClass('Subject');
        $subjects->addField('id',   _t('Subject'), $sub_subject_id,   50);
        $subjects->addField('name', _t('Name'),    $sub_subject_name, 300);
        
        $row=$table2->addRow();
        $row->addCell($l=new TLabel(_t('Subjects')));
        $l->setFontStyle('b');
        
        $row=$table2->addRow();
        $row->addCell($subjects);
        
        
        
        // items
        $items             = new TMultiField('item_list');
        $item_barcode      = new TEntry('barcode');
        $item_status_id    = new TComboCombined('status_id', 'status_description');
        $item_cost         = new TEntry('cost');
        $item_acquire_date = new TDate('acquire_date');
        $item_notes        = new TEntry('notes');
        
        $item_status_id->setSize(150);
        $item_cost->setSize(100);
        $item_acquire_date->setSize(100);
        TTransaction::open('library');
        $rep = new TRepository('Status');
        $objects = $rep->load(new TCriteria);
        $options = array();
        if ($objects)
        {
            foreach ($objects as $object)
            {
                $options[$object->id] = $object->description;
            }
        }
        $item_status_id->addItems($options);
        TTransaction::close();
        
        $items->setHeight(140);
        $items->setClass('Item');
        $items->addField('barcode',      _t('Barcode'), $item_barcode,   80);
        $items->addField('status_id',    _t('Status'), $item_status_id, 100);
        $items->addField('cost',         _t('Cost'), $item_cost, 80);
        $items->addField('acquire_date', _t('Acquire date'), $item_acquire_date, 80);
        $items->addField('notes',        _t('Notes'), $item_notes, 150);
        
        $row=$table3->addRow();
        $row->addCell($l=new TLabel(_t('Items')));
        $l->setFontStyle('b');
        
        $row=$table3->addRow();
        $row->addCell($items);
        
        // create an action button (save)
        $save_button=new TButton('save');
        // define the button action
        $save_button->setAction(new TAction(array($this, 'onSave')), _t('Save'));
        $save_button->setImage('ico_save.png');

        // add a row for the form action
        $row=$table1->addRow();
        $row->addCell($save_button);

        // define wich are the form fields
        $this->form->setFields(array($id,$title,$isbn,$call_number,$author_id,$author_name, $edition,
                                     $volume,$collection_id,$classification_id,$publisher_id,
                                     $publisher_name,$publish_place,$publish_date,$abstract,
                                     $notes,$authors, $subjects, $items, $save_button));

        
        // add the form to the page
        parent::add($this->form);
    }

    /**
     * method onSave()
     * Executed whenever the user clicks at the save button
     */
    function onSave()
    {
        try
        {
            // open a transaction with database 'library'
            TTransaction::open('library');
            
            // get the form data into an active record Book
            $object = $this->form->getData('Book');
            // clear aggregates
            $object->clearParts();
            
            // add Author aggregates
            if ($object->author_list)
            {
                foreach ($object->author_list as $author)
                {
                    $object->addAuthor($author);
                }
            }
            
            // add Subject aggregates
            if ($object->subject_list)
            {
                foreach ($object->subject_list as $subject)
                {
                    $object->addSubject($subject);
                }
            }
            
            // add Item composition
            if ($object->item_list)
            {
                foreach ($object->item_list as $item)
                {
                    $object->addItem($item);
                }
            }
            
            // form validation
            $this->form->validate();
            
            // stores the object
            $object->store();
            
            // fill the form with the active record data
            $this->form->setData($object);
            
            // close the transaction
            TTransaction::close();
            
            // shows the success message
            new TMessage('info', TAdiantiCoreTranslator::translate('Record saved'));
            // reload the listing
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
     * method onEdit()
     * Executed whenever the user clicks at the edit button da datagrid
     */
    function onEdit($param)
    {
        try
        {
            if (isset($param['key']))
            {
                // get the parameter $key
                $key=$param['key'];
                
                // open a transaction with database 'library'
                TTransaction::open('library');
                
                // instantiates object Book
                $object = new Book($key);
                
                // load the aggregates into the multifield field
                $object->author_list  = $object->getAuthors();
                $object->subject_list = $object->getSubjects();
                $object->item_list    = $object->getItems();
                
                // fill the form with the active record data
                $this->form->setData($object);
                
                // close the transaction
                TTransaction::close();
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
}
?>