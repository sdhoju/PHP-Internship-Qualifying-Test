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
    protected $file;
    public function start(){

        // header("Content-type: text/csv");
        $header = array("SKU", "name","brand", "price", "currency");
        $field = array("SKU", "name","brand", "price", "currency");
        $this->file = fopen('output_files/product.csv', 'w');
        fputcsv($this->file, $header);
        return "File product.csv created<br>";
    }

    public function formatRecord($record){
        $product = new Product($record);
        
        fputcsv($this->file, array_values((array) $product));
        return $product." added to file <br>";

    }

    public function finish(){
        fclose($this->file);
        return "CSV complete <br> ";
    }
}



// $xml = new SimpleXMLElement('<xml/>');

// for ($i = 1; $i <= 8; ++$i) {
//     $track = $xml->addChild('track');
//     $track->addChild('path', "song$i.mp3");
//     $track->addChild('title', "Track $i - Track Title");
// }

// Header('Content-type: text/xml');
// print($xml->asXML());
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
        // fclose($this->file);
    }
}




class JSON implements FormatInterface{
    protected $file;
    public function start(){
    }

    public function formatRecord($record){
    }

    public function finish(){
    }
}
