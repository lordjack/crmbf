<?php
/**
 * Customer Active Record
 * @author  <your-name-here>
 */
class Cliente extends TRecord
{
    const TABLENAME = 'cliente';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    private $cidade;
    private $category;
    private $contacts;
    private $skills;
    
    public function get_city()
    {
        if (empty($this->cidade))
        {
            $this->cidade = new City($this->city_id);
        }
        
        return $this->cidade;
    }
    
    public function get_nome_cidade()
    {
        if (empty($this->cidade))
        {
            $this->cidade = new Cidade($this->cidade_id);
        }
        
        return $this->cidade->nome;
    }
    
    public function get_category_name()
    {
        if (empty($this->category))
        {
            $this->category = new Category($this->category_id);
        }
        
        return $this->category->name;
    }
    
    public function set_birthdate($value)
    {
        $parts = explode('-', $value);
        if (checkdate($parts[1], $parts[2], $parts[0]))
        {
            $this->data['birthdate'] = $value;
        }
        else
        {
            throw new Exception("Não pode atribuir '{$value}' em birthdate");
        }
    }
    
    public function setCategory(Category $category)
    {
        $this->category = $category;
        $this->category_id = $category_id;
    }
    
    public function getCategory()
    {
        if (empty($this->category))
        {
            $this->category = new Category($this->category_id);
        }
        
        return $this->category;
    }
    
    public function clearParts()
    {
        $this->contacts  = array();
        $this->skills    = array();
    }
    
    public function addContact(Contact $contact)
    {
        $this->contacts[] = $contact;
    }
    
    public function getContacts()
    {
        return $this->contacts;
    }
    
    public function addSkill(Skill $skill)
    {
        $this->skills[] = $skill;
    }
    
    public function getSkills()
    {
        return $this->skills;
    }
    /*
    public function load($id)
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('customer_id', '=', $id));
        
        $contact_rep = new TRepository('Contact');
        $contacts = $contact_rep->load($criteria);
        if ($contacts)
        {
            foreach ($contacts as $contact)
            {
                $this->addContact($contact);
            }
        }
        
        $customer_skill_rep = new TRepository('CustomerSkill');
        $customer_skills = $customer_skill_rep->load($criteria);
        if ($customer_skills)
        {
            foreach ($customer_skills as $customer_skill)
            {
                $skill = new Skill($customer_skill-> skill_id);
                $this->addSkill($skill);
            }
        }
        
        return parent::load($id); // carrega o próprio objeto
    }
    
    public function store()
    {
        parent::store();
        
        $criteria = new TCriteria;
        $criteria->add(new TFilter('customer_id', '=', $this->id));
        
        $contact_rep = new TRepository('Contact');
        $contact_rep->delete($criteria);
        
        $customer_skill_rep = new TRepository('CustomerSkill');
        $customer_skill_rep->delete($criteria);
        
        if ($this->skills)
        {
            foreach ($this->skills as $skill)
            {
                $customer_skill = new CustomerSkill;
                $customer_skill-> customer_id  = $this-> id;
                $customer_skill-> skill_id     = $skill-> id;
                $customer_skill->store();
            }
        }
        
        if ($this->contacts)
        {
            foreach ($this->contacts as $contact)
            {
                $contact-> customer_id = $this-> id;
                $contact->store();
            }
        }
    }
    
    public function delete($id = NULL)
    {
        $id = isset($id) ? $id : $this->{'id'};
        
        $criteria = new TCriteria;
        $criteria->add(new TFilter('customer_id', '=', $id));
        
        $repository = new TRepository('Contact');
        $repository->delete($criteria);
        
        $repository = new TRepository('CustomerSkill');
        $repository->delete($criteria);
        
        parent::delete($id);
    }
     * 
     */
}
?>