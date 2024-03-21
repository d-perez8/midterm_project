<?php

// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php'; // database
include_once 'C:\xampp\htdocs\DPMidterm\models\Author.php'; //author.php

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$author = new Author($db);

//get data from Delete
$data = json_decode(file_get_contents("php://input"));

//check for id and author
if (!empty($data->id) && !empty($data->author)) {

    //set values from body
    $author->id = $data->id;
    $author->author = $data->author;

    //updates author
    if ($author->update($author->id, $author->author)) {
        // Set response code - 200 OK
        http_response_code(200);
        echo json_encode(array("message" => "Author was updated."));
    } else {
        //503 Service unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update author."));
    }
} else {
    //400 Bad request, either author, id, or neither
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update author. Data is incomplete."));
}

?>