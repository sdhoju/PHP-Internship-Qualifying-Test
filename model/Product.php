<?php


class Product {

    protected $sku ;
    protected $name;
    protected $brand=null;
    protected $price;
    protected $currency;

    public function __construct($params=array())
    {
        if(!empty($params)){
            $this->sku = $params[0];
            $this->name = $params[1];
            $this->brand = $params[2];
            $this->price = $params[3];
            $this->currency = $params[4]==''?"USD":$params[4];
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
     * Set the value of sku
     *
     * @return  self
     */ 
    public function setSku($sku)
    {
        $this->sku = $sku;

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
     * Get the value of brand
     */ 
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     *
     * @return  self
     */ 
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
    /**
     * Get the value of currency
     */ 
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the value of currency
     *
     * @return  self
     */ 
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }
    public function __toString()
    {
        $productString="SKU: ".$this->getSku()."\n".
                        "name: ".$this->getName()."\n".
                        "brand: ".$this->getBrand()."\n".
                        "price: ".$this->getPrice()."\n".
                        "currency: ".$this->getCurrency()."\n";
        return $productString;
    }



    
}

