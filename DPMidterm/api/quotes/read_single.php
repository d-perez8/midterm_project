<?php

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php'; //database
include_once 'C:\xampp\htdocs\DPMidterm\models\Quote.php'; //Quote.php

//instantiate database and quote object
$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

//get id of quote to read
$id = isset($_GET['id']) ? $_GET['id'] : die();

//read details of quote
$quote->id = $id;
$quote->read_single();

if ($quote->quote != null) {
    //create array to hold quote data
    $quote_arr = array(
        "id" => $quote->id, 
        "quote" => $quote->quote, 
        "author_id" => $quote->author_id, 
        "category_id" => $quote->category_id
    );

    //set response code 200 ok
    http_response_code(200);

    //change to JSON
    echo json_encode($quote_arr);
}
else {
    //404 not found
    http_response_code(404);
    echo json_encode(array("message" => "No quote found."));
}
?>
