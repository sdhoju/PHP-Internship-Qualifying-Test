<?php
require_once __DIR__ . '/RecordOutput.php';

/**
 * FormatFactory class 
 *
 * Is used to create the format and output the records.
 */
class FormatFactory
{
    /**
     * Creates the output of products in requested format 
     *
     * @param string $formatKey is the requested format key(csv,xml,json)
     *          
     * @return Format format is the implementation of Formatinterface
     */
    public function create($formatKey){
        switch ($formatKey) {
            case 'csv':          
                return   new CSV();
                break;
            case 'xml':
                return new XML();
                break;
            case 'json':
                return new JSON();
                break;
        }   
    }
}


/**
 * CSV class is the implementation of FormatInterface 
 *
 * is used to  write the products to csv file
 */
class CSV implements FormatInterface{
    /** @var file $csvFile is the file to be written*/
    protected $csvFile;


    /**
    * Creates the product.csv file and add header to it
    *  
    *@return string 
    */
    public function start(){
        // header("Content-type: text/csv");
        echo "===============================CSV===============================";
        $header = array("SKU", "name","brand", "price", "currency");
        $this->csvFile = fopen('output_files/product.csv', 'w');
        fputcsv($this->csvFile, $header);
        return "<br>File product.csv created<br><br>";
    }


    /**
    * Writes Product to csv file
    * 
    * @param $record is the Product object  
    * @return string 
    */
    public function formatRecord($record){        
        fputcsv($this->csvFile, array_values((array) $record));
        return $record->getName()." added.<br>";
    }


    /**
    * Closes the csv file 
    *  
    *@return string 
    */
    public function finish(){
        fclose($this->csvFile);
        return "<br>File successfully populated. Find product.csv at __DIR__ /output_files/ <br><br> ";
    }
}


/**
 * XML class is the implementation of FormatInterface 
 *
 * is used to  write the customers to xml file
 */
class XML implements FormatInterface{
    protected $xml;
    protected $root;

    /**
    * Creates the xml from DomDocuments and append customers as root to xml.
    *  
    *@return string 
    */
    public function start(){
        echo "===============================XML===============================";

        $this->xml= new DomDocument('1.0');
        $this->root=$this->xml->createElement("customers");
        $this->xml->appendChild($this->root);
        return "<br>XML created from DomDocument.<br><br>";
    }


    /**
    * Add customer to parent customers and append elements id,name,email,age,gender to customer
    * 
    * @param $record is the Customer object  
    * @return string 
    */
    public function formatRecord($record){
        $customer=$record;
        $xmlCustomer=$this->xml->createElement("customer");
        $this->root->appendChild($xmlCustomer);

        $customerID=$this->xml->createElement("id",$customer->getCustomerID());
        $xmlCustomer->appendChild($customerID);

        $customerID=$this->xml->createElement("name",$customer->getName());
        $xmlCustomer->appendChild($customerID);

        $customerID=$this->xml->createElement("email",$customer->getEmailAddress());
        $xmlCustomer->appendChild($customerID);

        $customerID=$this->xml->createElement("age",$customer->getAge());
        $xmlCustomer->appendChild($customerID);

        $customerID=$this->xml->createElement("gender",$customer->getGender());
        $xmlCustomer->appendChild($customerID);

        return $customer->getName()." added. <br>";
    }

    /**
    * Format the xml and out the xml object to xmlfile  
    *  
    *@return string 
    */
    public function finish(){
        $this->xml->preserveWhiteSpace = false;
        $this->xml->formatOutput = true;
        // echo $this->xml->saveXML();
        $this->xml->save("output_files/customers.xml");
        return "<br>File successfully populated. Find customers.xml at __DIR__ /output_files/ <br> ";
    }
}


/**
 * JSON class is the implementation of FormatInterface 
 *
 * is used to  write the orders to json file
 */
class JSON implements FormatInterface{
    protected $jsonFile;
    protected $jsonArray;


    /**
    * Create an empty json file or load the json file
    *  
    *@return string 
    */
    public function start(){
        echo "===============================JSON===============================";
        $this->jsonArray = array("orders"=> array( )); 
        $this->jsonFile = fopen('output_files/orders.json', 'w');
        return "<br>JSON file Created.<br><br>";
    }


    /**
    * Add order to json array of orders
    * 
    * @param $record is the Order object  
    * @return string 
    */
    public function formatRecord($record){
        $this->jsonArray["orders"][]=$record;
        return $record->getID()." added.<br>";
    }

    /**
    * Write the jsonArray to the json file and 
    *  
    *@return string 
    */
    public function finish(){
        fwrite($this->jsonFile, json_encode($this->jsonArray,JSON_PRETTY_PRINT));
        return "<br>File successfully populated. Find orders.json at __DIR__ /output_files/ <br><br> ";
    }
}
