<?php

class Product {

    /**
     * The id of Product
     *
     * @var string
     */
    protected $sku ;

    /**
     * The name of the product
     *
     * @var string
     */
    protected $name;

    /**
     * The brand of the product
     *
     * @var string
     */
    protected $brand=null;

    /**
     * The price of the product
     *
     * @var float
     */
    protected $price;

    /**
     * The currency of the price
     *
     * @var string
     */
    protected $currency;

    public function __construct($params=array())
    {
        //'"' Added to show Quote in excel file
        if(!empty($params)){
            $this->sku =  '"'.$params[0].'"'; 
            $this->name ='"'.$params[1].'"';
            $this->brand = $params[2]==''?'':'"'.$params[2].'"';
            $this->price = $params[3];
            $this->currency =  $params[4]==''?'"USD"':'"'.$params[4].'"';
        }
       
    }

    /**
     * Get the value of sku
     */ 
    public function getSku()
    {
        return $this->sku;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }



    /**
     * Get the value of brand
     */ 
    public function getBrand()
    {
        return $this->brand;
    }

  
    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

   
    /**
     * Get the value of currency
     */ 
    public function getCurrency()
    {
        return $this->currency;
    }

    
    public function __toString()
    {
        $productString="".$this->getSku().
                        ", ".$this->getName().
                        ", ".$this->getBrand().
                        ", ".$this->getPrice().
                        ", ".$this->getCurrency();
        return $productString;
    }

    
}

