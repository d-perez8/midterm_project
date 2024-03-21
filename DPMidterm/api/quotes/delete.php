<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow_Methods, Authorization, X-Requested-With');

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php'; //database php
include_once 'C:\xampp\htdocs\DPMidterm\models\Quote.php'; //quote.php

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$quote = new Quote($db);

//Get id
$data = json_decode(file_get_contents("php://input"));

//check for id
if (!empty($data->id)) {
    //set value for this method
    $quote->id = $data->id;

    //delete quote
    if ($quote->delete($quote->id)) {
        echo json_encode(array('message' => 'Quote deleted successfully'));
    }
    //404
    else {
        echo json_encode(array('message' => 'Unable to delete quote'));
    }
}
else {
    //no id
    echo json_encode(array('message' => 'Missing quote ID'));
}
?>