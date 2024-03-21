<?php

//required headers
header("Content-Type: application/json; charset=UTF-8");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php'; // database php file goes here
include_once 'C:\xampp\htdocs\DPMidterm\models\Quote.php'; // quote.php file goes here

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$quote = new Quote($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));

//check if data isn't empty
if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    //set values for this method
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    //tocreate quote
    if ($quote->create($data->quote, $data->author_id, $data->category_id)) {
        //quote created successfuly
        http_response_code(201);
        echo json_encode(array("message" => "Quote was created."));
    } else {
        //503 service unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create quote."));
    }
} else {
    //400 bad request, one, two, or all three required not here
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create quote. Data is incomplete."));
}


?>