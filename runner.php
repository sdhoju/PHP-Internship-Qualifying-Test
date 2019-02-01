<?php

require_once __DIR__ . '/model/Customer.php';
require_once __DIR__ . '/model/Product.php';
require_once __DIR__ . '/model/Order.php';

require_once __DIR__ . '/Format.php';
require_once __DIR__ . '/RecordOutput.php';


$customers = array();
$products = array();
$orders = array();
$orderIndex=0;

/** READ All the data from the file  */
$file = fopen("test-file.txt",'r');
while(!feof($file)) {
    $line = fgets($file);
    $record = lineToArray($line);
    $recordType= array_shift($record); // Get the head of the array (here is the record Type) and remove it from record array

    switch ($recordType) {
        case "customer":
            $customers[]=new Customer($record);
            break;
        case "product":
            $products[]=new Product($record);
            break;
        case "order":
            $orderID = array_shift($record);
            $numberOfLines = array_shift($record);
            $head=new head($record);
            $orders[] = new Order($orderID,$numberOfLines,$head); 
            $position=1;
            break;
        case "order-line":        
            $orderLine= new line($position,$record);
            $orders[$orderIndex]->addLine($orderLine);
           $numberOfLines--;  
           $position++; 
           if ($numberOfLines==0)
                {
                    $orderIndex++; 
                }        
            break;
    }

}
fclose($file);


/**
 * Convert line to an array
 * Clean the line by removing double quotes, single quote and line break 
 * 
 * @param string $line is the single raw line of file
 * Line:    "customer","CST9104","John Jones","jjones@email.com",25,1 
 * Array:   Array ( [0] => customer [1] => CST9104 [2] => John Jones [3] => jjones@email.com [4] => 25 [5] => 1 ) 
 *
 * @return  array 
 */ 
function lineToArray($line){
    $line=str_replace(array('"', "'","\n"), '', $line);
    return explode(",", $line);
}


$header = array("SKU", "name","brand", "price", "currency");
$csvfile = fopen('output_files/product.csv', 'w');
fputcsv($csvfile, $header);
foreach($products as $product){

    fputcsv($csvfile, array_values((array) $product));
}
fclose($csvfile);


// $factory = new FormatFactory(); 
// $csvOutput = new RecordOutput();
// $csvOutput->setRecords($products);
// $csvOutput->setFormat($factory->create('csv'));
// $csvOutput->format();


/** Did you know this? 
 * 
 */


// $xmlOutput = new RecordOutput();
// $xmlOutput->setRecords($products);
// $xmlOutput->setFormat($factory->create('xml'));
// $xmlOutput->format();

/**FACT:  json_encode won't work with "protected member variables   */
$jsonArray = array("orders"=>$orders); 
$fp = fopen('output_files/orders.json', 'w');
fwrite($fp, json_encode($jsonArray,JSON_PRETTY_PRINT));
fclose($fp);

// $jsonOutput = new RecordOutput();
// $jsonOutput->setRecords($products);
// $jsonOutput->setFormat($factory->create('json'));
// $jsonOutput->format();

