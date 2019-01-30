<?php


class Customer {
    protected $customerID;  
    protected $name;  
    protected $emailAddress;  
    protected  $age = null;  
    protected  $gender;

    protected function __construct($customerID,$name,$emailAddress,$age=null,$gender)
    {
        $this->customerID = $customerID;
        $this->name = $name;
        $this->emailAddress = $emailAddress;
        $this->age = $age;
        $this->gender = $gender;
    }
    

    /**
     * Get the value of customerID
     */ 
    public function getCustomerID()
    {
        return $this->customerID;
    }

    /**
     * Set the value of customerID
     *
     * @return  self
     */ 
    public function setCustomerID($customerID)
    {
        $this->customerID = $customerID;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of emailAddress
     */ 
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set the value of emailAddress
     *
     * @return  self
     */ 
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get the value of age
     */ 
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */ 
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }


}