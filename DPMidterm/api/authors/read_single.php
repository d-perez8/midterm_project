<?php

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php'; // database
include_once 'C:\xampp\htdocs\DPMidterm\models\Author.php'; //author.php

//instantiate database and author object
$database = new Database();
$db = $database->connect();

$author = new Author($db);

// Check if the ID parameter is provided in the request
if(isset($_GET['id'])) {
    // Get the ID from the request
    $author_id = $_GET['id'];

    // Call the read_single method with the author ID as parameter to fetch the author record
    $result = $author->read_single($author_id);

    if($result) {
        // Author found, return the result as JSON
        http_response_code(200);
        echo json_encode($result);
    } else {
        // Author not found
        http_response_code(404);
        echo json_encode(array("message" => "Author not found."));
    }
} else {
    // ID parameter not provided
    http_response_code(400);
    echo json_encode(array("message" => "ID parameter is required."));
}
?>