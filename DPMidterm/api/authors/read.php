<?php

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php'; // database
include_once 'C:\xampp\htdocs\DPMidterm\models\Author.php'; //author.php


//start up database and create authior object
$database = new Database();
$db = $database->connect();
$author = new Author($db);

//read authors
$stmt = $author->read();
$num = $stmt->rowCount();

//if exists
if ($num > 0) {
    //authors array
    $authors_arr = array();
    $authors_arr["authors"] = array();

    //get authors from database
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
    
        $author_item = array(
            "id" => $id, 
            "author" => $author
        );
    
        array_push($authors_arr["authors"], $author_item);
    }
    //200 OK
    http_response_code(200);
    echo json_encode($authors_arr);
}
else {
    //404 not found, no data
    http_response_code(404);
    echo json_encode(array("message" => "No authors found"));
}
?>