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
        echo "Starting adding products to csv file <br>";
        $header = array("SKU", "name","brand", "price", "currency");
        $this->csvFile = fopen('output_files/product.csv', 'w');
        fputcsv($this->csvFile, $header);
        return "File product.csv created<br>";
    }

    public function formatRecord($record){        
        fputcsv($this->csvFile, array_values((array) $record));
        return $record." added to file <br>";
    }

    public function finish(){
        fclose($this->csvFile);
        return "file successfully populated. Find it at __DIR__ /output_files/ <br><br> ";
    }
}

class XML implements FormatInterface{
    protected $file;
    protected $myXML;

    public function start(){
        $this->myXML = new SimpleXMLElement("<xsd:schema></xsd:schema>");
        $this->myXML->addAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');

        $header = array("SKU", "name","brand", "price", "currency");
        // $this->file = fopen('output_files/customer.xml', 'w');

        
    }

    public function formatRecord($record){
        
    }

    public function finish(){
        Header('Content-type: text/xml');
        echo $this->myXML->asXML();
    }
}




class JSON implements FormatInterface{
    protected $jsonFile;
    protected $jsonArray;

    public function start(){
        $this->jsonArray = array("orders"=>
                        array(
                        )); 
        $this->jsonFile = fopen('output_files/orders.json', 'w');
        return "JSON file Created.<br>";
    }

    public function formatRecord($record){
        $this->jsonArray["orders"][]=(array)$record;
    }

    public function finish(){
        fwrite($this->jsonFile, json_encode($this->jsonArray,JSON_PRETTY_PRINT));
        return "Successfully add all the Orders in orders.json.<br><br>";

    }
}
