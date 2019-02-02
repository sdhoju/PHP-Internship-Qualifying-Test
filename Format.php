<?php
require_once __DIR__ . '/RecordOutput.php';

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

class CSV implements FormatInterface{
    protected $csvFile;
    public function start(){
        // header("Content-type: text/csv");
        echo "===============================CSV===============================";
        $header = array("SKU", "name","brand", "price", "currency");
        $this->csvFile = fopen('output_files/product.csv', 'w');
        fputcsv($this->csvFile, $header);
        return "<br>File product.csv created<br><br>";
    }

    public function formatRecord($record){        
        fputcsv($this->csvFile, array_values((array) $record));
        return $record->getName()." added.<br>";
    }

    public function finish(){
        fclose($this->csvFile);
        return "<br>File successfully populated. Find product.csv at __DIR__ /output_files/ <br><br> ";
    }
}

class XML implements FormatInterface{
    protected $xml;
    protected $root;

    public function start(){
        echo "===============================XML===============================";

        $this->xml= new DomDocument('1.0');
        $this->root=$this->xml->createElement("customers");
        $this->xml->appendChild($this->root);
        return "<br>XML created from DomDocument.<br><br>";
    }

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

    public function finish(){
        $this->xml->preserveWhiteSpace = false;
        $this->xml->formatOutput = true;
        // echo $this->xml->saveXML();
        $this->xml->save("output_files/customers.xml");
        return "<br>File successfully populated. Find customers.xml at __DIR__ /output_files/ <br> ";
    }
}


class JSON implements FormatInterface{
    protected $jsonFile;
    protected $jsonArray;

    public function start(){
        echo "===============================JSON===============================";
        $this->jsonArray = array("orders"=> array( )); 
        $this->jsonFile = fopen('output_files/orders.json', 'w');
        return "<br>JSON file Created.<br><br>";
    }

    public function formatRecord($record){
        $this->jsonArray["orders"][]=$record;
        return $record->getID()." added.<br>";
    }

    public function finish(){
        fwrite($this->jsonFile, json_encode($this->jsonArray,JSON_PRETTY_PRINT));
        return "<br>File successfully populated. Find orders.json at __DIR__ /output_files/ <br><br> ";
    }
}
