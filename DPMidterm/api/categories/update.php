<?php

// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php';
include_once 'C:\xampp\htdocs\DPMidterm\models\Category.php';

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$category = new Category($db);

//update
$data = json_decode(file_get_contents("php://input"));

//data check
if (!empty($data->id) && !empty($data->category)) {
    //set values for this method
    $category->id = $data->id;
    $category->category = $data->category;

    //updates
    if ($category->update($data->id, $data->category)) {
        //updated successfully
        http_response_code(200);
        echo json_encode(array("message" => "Category was updated."));
    } else {
        //503 service unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update category."));
    }
} else {
    //400 bad request, wrong id, category, or both
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update category. Data is incomplete."));
}


?>
