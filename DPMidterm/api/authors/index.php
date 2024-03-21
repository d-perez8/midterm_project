<?php
/*    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELTE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

*/
// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php'; // database
include_once 'C:\xampp\htdocs\DPMidterm\models\Author.php'; //author.php

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$author = new Author($db);

// Get HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

// Process HTTP request method
switch ($method) {
    case 'GET':
        //GET all
        $stmt = $author->read();
        $num = $stmt->rowCount();

        //check for data
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

            //authors found
            http_response_code(200);
            echo json_encode($authors_arr);
        } else {
            //404 Not found
            http_response_code(404);
            echo json_encode(array("message" => "No authors found."));
        }
        break;
    case 'POST':
        //create author
        include_once 'create.php';
        break;
    case 'PUT':
        //update author
        include_once 'update.php';
        break;
    case 'DELETE':
        //delete author
        include_once 'delete.php';
        break;
    default:
        //405 no other methods here
        http_response_code(405);
        echo json_encode(array("message" => "Method not allowed."));
        break;
}
?>