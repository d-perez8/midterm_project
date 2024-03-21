<?php

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//include database and author object file
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php'; // database
include_once 'C:\xampp\htdocs\DPMidterm\models\Author.php'; //author.php

//instantiate database and author object
$database = new Database();
$db = $database->connect();

$author = new Author($db);

//get data from POST
$data = json_decode(file_get_contents("php://input"));

//is data empty check
if (!empty($data->author)) {
    //set author property values
    $author->author = $data->author;

    //create author
    if($author->create($data->author)) {
        //201 created
        http_response_code(201);
        echo json_encode(array("message" => "Author was created"));
    }
    else {
        //503 service unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create author."));
    }
}
else {
    //data empty, 400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create author, data is empty"));
}
?>