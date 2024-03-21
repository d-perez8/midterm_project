<?php

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php'; // database
include_once 'C:\xampp\htdocs\DPMidterm\models\Author.php'; //author.php

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$author = new Author($db);

//get data from DELETE
$data = json_decode(file_get_contents("php://input"));

//if ID is provided check
if (!empty($data->id)) {
    //set author ID from reqruest
    $author_id = $data->id;

    //delete
    if ($author->delete($author_id)) {
        //200 OK, deleted
        http_response_code(200);
        echo json_encode(array("message" => "Author was deleted."));
    } else {
        //503 Service unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete author."));
    }
} else {
    //400 Bad request, no id
    http_response_code(400);
    echo json_encode(array("message" => "Unable to delete author. ID is missing."));
}
?>