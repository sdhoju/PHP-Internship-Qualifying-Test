<?php

require_once __DIR__ . '/model/Product.php';
require_once __DIR__ . '/format.php';

$customerArr = array();
$products = array();
$orderArr = array();
$orderLineArr = array();

$file = fopen("test-file.txt","r");
while(! feof($file))
  {
        $line=fgets($file);  
        if(!empty($line)){
            $record = lineToArray($line);
            $recordType= array_shift($record);
            
            switch ($recordType) {
                case "customer":
                    $customerArr[]=$record;
                    break;
                case "product":
                    $products[]=$record;
                    break;
                case "order":
                    $orderArr[]=$record;
                    break;
                case "order-line":                
                    $orderLineArr[]=$record;
                    break;
            }
        }
  }
fclose($file);


$toCSV = new CSV();
$toCSV->start();
foreach($products as $product)
{
    $p = new Product($product);
    $toCSV->addToFile($p);
}
$toCSV->finish();


function lineToArray($line){
    $line=str_replace(array('"', "'","\n"), '', $line);
    return explode(",", $line);
}