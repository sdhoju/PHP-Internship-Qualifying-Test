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
            $orders[] = new Order($orderID,$head); 
            break;
        case "order-line":        
            $orderLine= new line($record);
            $orders[$orderIndex]->addLine($orderLine);
            $numberOfLines--;      // decrease  number of lines by one after a line is added
            if ($numberOfLines==0) // if no lines are needed to be written go to next order.
                $orderIndex++; 
            break;
    }

}
fclose($file);
echo "Successfully Read all the line from input file.<br><br>";


// echo "<pre>"; //UNCOMMENT ME UNCOMMENT ME UNCOMMENT ME 


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
    $line=str_replace(array('"',"'","\n"), '', $line);
    return explode(",", $line);
}

//Instattiate the Format factory 
$factory = new FormatFactory(); 

$csvOutput = new RecordOutput();
$csvOutput->setRecords($products);
$csvOutput->setFormat($factory->create('csv'));
$csvOutput->format();
echo "==================================================================<br><br>";

$xmlOutput = new RecordOutput();
$xmlOutput->setRecords($customers);
$xmlOutput->setFormat($factory->create('xml'));
$xmlOutput->format();
echo "==================================================================<br><br>";


/**FUN FACT:  json_encode won't work with "protected member variables   */
$jsonOutput = new RecordOutput();
$jsonOutput->setRecords($orders);
$jsonOutput->setFormat($factory->create('json'));
$jsonOutput->format();
echo "==================================================================<br><br>";

echo "<center>";
echo "DID YOU FIND THE EASTER EGG? Mini Hint: Ctrl+/  <br>";
echo "Hint 1: My friend asked me how the 5K I participated went. I told her I was ultimate at the race. She googled the word \"ultimate\" and laughed at me.<br><br>";

/** Uncomment the ultimate 3 lines */

// $The_Colony= "                                                                                                                                                                                                                                                                                             \n                                                  *&&o        &8&.          \n                                                   o88:      :88o           \n*::::::**.                                         .&88.    .88&.           \n:oooooooooo:.                              *o&&o:.  :88&    &88*            \n:oo*     *ooo*                           :888&o&888. :88o  o88o             \n:oo*      .:oo.                         o88&    .&8&  o88*.&8&.   .:oo:*    \n:oo*       :oo* .&88888888888888888888o &88*     :88* .&88&88:  *ooo::oooo. \n:oo*       :oo*  oooooooooo:::::::&888o.88&      *88:  o8888&  .oo:     :o: \n*oo*       :oo.   .::::*         .&88: .88o      *88o   o88&   ooo      *oo*\n*oo*      :oo:  .oo:.*:oo.       &88o  .88o      *88o   *88:  .ooo      .oo:\n*oo:****:ooo:  .oo.    :o:      o88&   .88o      *88:   *88:  .oo:      .ooo\n*ooooooooo*     ..     :o:     :88&    .&88.     :88*   *88:  .oo:      .oo:\n*oo*   :oo:     .:oo::ooo:    *88&      o88o     &8o    *88:   oo:      .oo:\n*oo*    :oo*    oo*    :o:   .88&.       o88&* :888.    *88:   ooo      *oo.\n*oo:     :oo:  .oo     *o:  .&88.          :8888&*      .::.   .oo*     :o: \n.oo:     .ooo*  oo*    :o:  &88: ..........*******::::::::ooo:  *oo:*.*:oo. \n.oo:       :oo.  :oooo::o: *888888888888888&&&&&&&&&&&&&&&&ooo:   *::o::.   \n.oo:       .:oo.                                                            \n            .ooo.                                                           \n             .ooo                                                           \n                         ";
// echo "<div class='easteregg' style='  background-color: #56267a;  color: #fff; width:600px'>".$The_Colony."</div>";
// echo "<br>Hint 2: Doesn't make sense? May be you are not looking hard enough. Why don't you meet me half way.";



























// $header = array("SKU", "name","brand", "price", "currency");
// $csvfile = fopen('output_files/product.csv', 'w');
// fputcsv($csvfile, $header);
// foreach($products as $product){
//     fputcsv($csvfile, array_values((array) $product));
// }
// fclose($csvfile);

// $jsonArray = array("orders"=>$orders); 
// $fp = fopen('output_files/orders.json', 'w');
// fwrite($fp, json_encode($jsonArray,JSON_PRETTY_PRINT));
// fclose($fp);

// header('Content-type: text/xml');
// $xml= new DomDocument('1.0');
// $xmlCustomers=$xml->createElement("customers");
// $xml->appendChild($xmlCustomers);
// foreach($customers as $customer){
//     $xmlCustomer=$xml->createElement("customer");
//     $xmlCustomers->appendChild($xmlCustomer);

//     $customerID=$xml->createElement("id",$customer->getCustomerID());
//     $xmlCustomer->appendChild($customerID);

//     $customerID=$xml->createElement("name",$customer->getName());
//     $xmlCustomer->appendChild($customerID);

//     $customerID=$xml->createElement("email",$customer->getEmailAddress());
//     $xmlCustomer->appendChild($customerID);

//     $customerID=$xml->createElement("age",$customer->getAge());
//     $xmlCustomer->appendChild($customerID);

//     $customerID=$xml->createElement("gender",$customer->getGender());
//     $xmlCustomer->appendChild($customerID);

// }
// $xml->preserveWhiteSpace = false;
// $xml->formatOutput = true;
// echo $xml->saveXML();
// $xml->save("output_files/customers.xml");
