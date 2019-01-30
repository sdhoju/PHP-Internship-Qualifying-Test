<?php


interface FormatInterface
{
    public function start();

    public function addToFile($record);

    public function finish();
}


class CSV implements FormatInterface{
    protected $file;
    public function start(){
        // header("Content-type: text/csv");
        $header = array("SKU", "name","brand", "price", "currency");
        $this->file = fopen('output_files/product.csv', 'w');
        fputcsv($this->file, $header);
    }

    public function addToFile($record){
        $recordArray =  (array) $record;
        fputcsv($this->file, array_values($recordArray));
    }

    public function finish(){
        fclose($this->file);
    }
}
