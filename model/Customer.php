<?php


class Customer {

    /**
     * The id of customer that placed the order
     *
     * @var string
     */
    protected $customerID;  

    /**
     * The name of customer 
     *
     * @var string
     */
    protected $name;
    
    /**
     * The email address of customer 
     *
     * @var string
     */
    protected $emailAddress;  

    /**
     * The age of customer 
     *
     * @var string
     */
    protected $age = null;  

    /**
     * The gender of the customer 1=male, 2=female
     *
     * @var integer
     */
    protected $gender;

    public function __construct($params=array())
    {
        if(!empty($params)){
            $this->customerID = (string) $params[0];
            $this->name =(string) $params[1];
            $this->emailAddress =(string) $params[2];
            $this->age =(integer) $params[3];
            $this->gender =(integer) $params[4];
        }
    }
    

    /**
     * Get the value of customerID
     */ 
    public function getCustomerID()
    {
        return $this->customerID;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

   

    /**
     * Get the value of emailAddress
     */ 
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

   
    /**
     * Get the value of age
     */ 
    public function getAge()
    {
        return $this->age;
    }

   
    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    

}