<?php

// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php';
include_once 'C:\xampp\htdocs\DPMidterm\models\Category.php';

// Instantiate database and category object
$database = new Database();
$db = $database->connect();

$category = new Category($db);

// Get posted data
$data = json_decode(file_get_contents("php://input"));

// Check if data is not empty
if (!empty($data->category)) {
    // Set category property values
    $category->category = $data->category;

    // Create the category
    if ($category->create($data->category)) {
        // Set response code - 201 created
        http_response_code(201);

        // Tell the user
        echo json_encode(array("message" => "Category was created."));
    } else {
        // Set response code - 503 service unavailable
        http_response_code(503);

        // Tell the user
        echo json_encode(array("message" => "Unable to create category."));
    }
} else {
    // Set response code - 400 bad request
    http_response_code(400);

    // Tell the user
    echo json_encode(array("message" => "Unable to create category. Data is incomplete."));
}


?>
