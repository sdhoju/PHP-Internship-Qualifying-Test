<?php

class Order{
    /**
     * The order idowner.
     *
     * @var string
     */
    public $id;

    /**
     * The head of the order
     *
     * @var head
     */
    public $head;

    /**
     * The array of line.
     *
     * @var array
     */
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

    /**
     * Get the order id
     *
     * @return string id
     */ 
    public function getID()
    {
        return $this->id;
    }
}



class head{
    /**
     * The subtotal of order.
     *
     * @var float 
     */
    public $sub_total;

    /**
     * The order tax.
     *
     * @var float
     */
    public $tax;

    /**
     * The order total.
     *
     * @var float 
     */
    public $total;

    /**
     * The id of customer that placed the order
     *
     * @var string
     */
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

    /**
     * The id of customer that placed the order
     *
     * @var integer
     */
    public $position;

    /**
     * The product name
     *
     * @var string
     */
    public $name;

    /**
     * The price of product
     *
     * @var string
     */
    public $price;

    /**
     * The quantity of product
     *
     * @var string
     */
    public $quantity;

    /**
     * The total of the row 
     *
     * @var string
     */
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