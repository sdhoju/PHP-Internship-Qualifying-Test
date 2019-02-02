<?php


class Customer {

    /**
     * The id of customer 
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

}