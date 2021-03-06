<?php
/**
 * Wrapper class to deal with forms
 *
 * @version    1.0
 * @package    widget_web
 * @subpackage form
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2013 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class TForm
{
    protected $fields; // array containing the form fields
    protected $name;   // form name
    protected $js_function;
    static private $forms;
    
    /**
     * Class Constructor
     * @param $name Form Name
     */
    public function __construct($name = 'my_form')
    {
        // register this form
        self::$forms[$name] = $this;
        if ($name)
        {
            $this->setName($name);
        }
    }
    
    /**
     * Returns the form object by its name
     */
    public static function getFormByName($name)
    {
        if (isset(self::$forms[$name]))
        {
            return self::$forms[$name];
        }
    }
    
    /**
     * Define the form name
     * @param $name A string containing the form name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Returns the form name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Send data for a form located in the parent window
     * @param $form_name  Form Name
     * @param $object     An Object containing the form data
     */
    public static function sendData($form_name, $object, $aggregate = FALSE)
    {
        // iterate the object properties
        if ($object)
        {
            foreach ($object as $field => $value)
            {
                if (is_object($value))  // TMultiField
                {
                    foreach ($value as $property=>$data)
                    {
                        // if inside ajax request, then utf8_encode if isn't utf8
                        if (utf8_encode(utf8_decode($data)) !== $data )
                        {
                            $data = utf8_encode(addslashes($data));
                        }
                        else
                        {
                            $data = addslashes($data);
                        }
                        // send the property value to the form
                        $script = new TElement('script');
                        $script->{'language'} = 'JavaScript';
                        $script->setUseSingleQuotes(TRUE);
                        $script->setUseLineBreaks(FALSE);
                        $script->add( " try { document.{$form_name}.{$field}_{$property}.value = '{$data}'; } catch (e) { } " );
                        $script->show();
                    }
                }
                else
                {
                    // if inside ajax request, then utf8_encode if isn't utf8
                    if (utf8_encode(utf8_decode($value)) !== $value )
                    {
                        $value = utf8_encode(addslashes($value));
                    }
                    else
                    {
                        $value = addslashes($value);
                    }
                    // send the property value to the form
                    $script = new TElement('script');
                    $script->{'language'} = 'JavaScript';
                    $script->setUseSingleQuotes(TRUE);
                    $script->setUseLineBreaks(FALSE);
                    if ($aggregate)
                    {
                        $script->add( "try { if (document.{$form_name}.{$field}.value == \"\") { document.{$form_name}.{$field}.value  = '{$value}'; } else { document.{$form_name}.{$field}.value = document.{$form_name}.{$field}.value + ', {$value}' }  } catch (e) { } " );
                    }
                    else
                    {
                        $script->add( "try { document.{$form_name}.{$field}.value = '{$value}'; } catch (e) { } " );
                    }
                    $script->show();
                }
            }
        }
    }
    
    /**
     * Define if the form will be editable
     * @param $bool A Boolean
     */
    public function setEditable($bool)
    {
        if ($this->fields)
        {
            foreach ($this->fields as $object)
            {
                $object->setEditable($bool);
            }
        }
    }
    
    /**
     * Add a Form Field
     * @param $field Object
     */
    public function addField(IWidget $field)
    {
        if ($field instanceof TField)
        {
            $name = $field->getName();
            if (isset($this->fields[$name]))
            {
                throw new Exception(TAdiantiCoreTranslator::translate('You have already added a field called "^1" inside the form', $name));
            }
            
            if ($name)
            {
                $this->fields[$name] = $field;
                $field->setFormName($this->name);
                
                if ($field instanceof TButton)
                {
                    $field->addFunction($this->js_function);
                }
            }
        }
        if ($field instanceof TMultiField)
        {
            $this->js_function .= "mtf{$name}.parseTableToJSON();";
            
            if ($this->fields)
            {
                // if the button was added before multifield
                foreach ($this->fields as $field)
                {
                    if ($field instanceof TButton)
                    {
                        $field->addFunction($this->js_function);
                    }
                }
            }
        }
    }
    
    /**
     * Define wich are the form fields
     * @param $fields An array containing a collection of TField objects
     */
    public function setFields($fields)
    {
        if (is_array($fields))
        {
            $this->fields = array();
            $this->js_function = '';
            // iterate the form fields
            foreach ($fields as $field)
            {
                $this->addField($field);
            }
        }
        else
        {
            throw new Exception(TAdiantiCoreTranslator::translate('Method ^1 must receive a paremeter of type ^2', __METHOD__, 'Array'));
        }
    }
    
    /**
     * Returns a form field by its name
     * @param $name  A string containing the field's name
     * @return       The Field object
     */
    public function getField($name)
    {
        if (isset($this->fields[$name]))
        {
            return $this->fields[$name];
        }
    }
    
    /**
     * clear the form Data
     */
    public function clear()
    {
        // iterate the form fields
        foreach ($this->fields as $name => $field)
        {
            if ($name) // labels don't have name
            {
                $field->setValue(NULL);
            }
        }
    }
    
    /**
     * Define the data of the form
     * @param $object An Active Record object
     */
    public function setData($object)
    {
        // iterate the form fields
        foreach ($this->fields as $name => $field)
        {
            if ($name) // labels don't have name
            {
                if (isset($object->$name))
                {
                    $field->setValue($object->$name);
                }
            }
        }
    }
    
    /**
     * Returns the form data as an object
     * @param $class A string containing the class for the returning object
     */
    public function getData($class = 'StdClass')
    {
        $object = new $class;
        foreach ($this->fields as $key => $fieldObject)
        {
            if (!$fieldObject instanceof TButton)
            {
                $object->$key = $fieldObject->getPostData();
            }
        }
        
        return $object;
    }

    /**
     * Validate form
     */
    public function validate()
    {
        // assign post data before validation
        // validation exception would prevent
        // the user code to execute setData()
        $this->setData($this->getData());
        
        foreach ($this->fields as $fieldObject)
        {
            $fieldObject->validate();
        }
    }
    
    /**
     * Add a container to the form (usually a table of panel)
     * @param $object Any Object that implements the show() method
     */
    public function add($object)
    {
        $this->child = $object;
    }
    
    /**
     * Shows the form at the screen
     */
    public function show()
    {
        TPage::include_css('lib/adianti/include/tform/tform.css');
        
        /* Não é possível, pois pode ter uma IF (Designer) somente com datagrid
        if (count($this->fields) == 0)
        {
            throw new Exception(TAdiantiCoreTranslator::translate('Use the addField() or setFields() to define the form fields'));
        }
        */
        
        // creates the form tag
        $tag = new TElement('form');
        $tag-> enctype="multipart/form-data";
        $tag-> name   = $this->name; // form name
        $tag-> id     = $this->name; // form id
        $tag-> method = 'post';      // transfer method
        
        // add the container to the form
        if (isset($this->child))
        {
            $tag->add($this->child);
        }
        // show the form
        $tag->show();
    }
}
?>