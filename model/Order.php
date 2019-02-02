<?php

class Order{
    public $id;
    public $head;
    public $lines=array();

    public function __construct($id,$head, $lines=array())
    {
        $this->id = $id;
        $this->head= $head;
        $this->lines = ($lines==null)?array():$lines;
    }
    
    /**
     * Set the value of lines
     *
     * 
     */ 
    public function addLine($line)
    {
        $this->lines[] = $line;
    }

    public function getID()
    {
        return $this->id;
    }
    
}

class head{
    public $sub_total;
    public $tax;
    public $total;
    public $customer;

    public function __construct($params)
    {
        $this->sub_total =  number_format((float)$params[0], 2); 
        $this->tax =  number_format((float)$params[1], 2); 
        $this->total= number_format((float)$params[2], 2); 
        $this->customer = $params[3];
    }
    
}

class line{
    public $position;
    public $name;
    public $price;
    public $quantity;
    public $row_total;

    public function __construct($params)
    {
        $this->position = (integer)$params[0];
        $this->name = $params[1];
        $this->price= number_format((float)$params[2], 2); 
        $this->quantity =(integer) $params[3];
        $this->row_total =  number_format((float)$params[2]*(float)$params[3], 2) ;

    }
}