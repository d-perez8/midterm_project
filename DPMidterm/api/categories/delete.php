<?php

// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php';
include_once 'C:\xampp\htdocs\DPMidterm\models\Category.php';

// Instantiate database and category object
$database = new Database();
$db = $database->connect();
$category = new Category($db);

//from delete
$data = json_decode(file_get_contents("php://input"));

//id check
if (!empty($data->id)) {
    //set id for method
    $category_id = $data->id;

    //delete
    if ($category->delete($category_id)) {
        //deleted author with id given
        http_response_code(200);
        echo json_encode(array("message" => "Category was deleted."));
    } else {
        //503 Service unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete category."));
    }
} else {
    //400 Bad request, id not found
    http_response_code(400);
    echo json_encode(array("message" => "Unable to delete category. ID is missing."));
}
?>