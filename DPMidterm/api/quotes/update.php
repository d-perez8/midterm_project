<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT"); // Adjust method if using PATCH instead of PUT
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php';
include_once 'C:\xampp\htdocs\DPMidterm\models\Quote.php';

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$quote = new Quote($db);

//get id
$id = isset($_GET['id']) ? $_GET['id'] : die();
echo "Retrieved quote ID: " . $id . "<br>"; // is error here?

//
$data = json_decode(file_get_contents("php://input"));

//is error here?
echo "Request data: ";
print_r($data);
echo "<br>";

//data check
if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    //set values
    $quote->id = $id;
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    //update
    if ($quote->update($id, $data->quote, $data->author_id, $data->category_id)) {
        //succesffulyl updated
        http_response_code(200);
        echo json_encode(array("message" => "Quote was updated."));
    } else {
        //503 service unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update quote."));
    }
} else {
    //400 bad request, something wrong with data
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update quote. Data is incomplete."));
}

?>