<?php

class Order{
    public $id;
    public $numberOfLines;
    public $head;
    public $lines=array();

    public function __construct($id,$numberOfLines,$head, $lines=array())
    {
        $this->id = $id;
        $this->numberOfLines = $numberOfLines;
        $this->head= $head;
        $this->lines = ($lines==null)?array():$lines;
    }
    

    /**
     * Get the value of lines
     */ 
    public function getLines()
    {
        return $this->lines;
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

    
}

class head{
    public $sub_total;
    public $tax;
    public $total;
    public $customer;

    public function __construct($params)
    {
        $this->sub_total = $params[0];
        $this->tax = $params[1];
        $this->total= $params[2];
        $this->customer = $params[3];
    }
}

class line{
    public $position;
    public $name;
    public $price;
    public $quantity;
    public $row_total;

    public function __construct($position,$params)
    {
        $this->position = $position;
        $this->name = $params[0];
        $this->price= $params[1];
        $this->quantity = $params[2];
        $this->row_total = $params[3];

    }
}