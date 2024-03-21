<?php

// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php';
include_once 'C:\xampp\htdocs\DPMidterm\models\Category.php';

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$category = new Category($db);

//check for id
$id = isset($_GET['id']) ? $_GET['id'] : die();

//set id for this method
$category->read_single($id);

//array to hold id and category data
$category_arr = array(
    "id" => $category->id,
    "category" => $category->category
);

//200 OK
http_response_code(200);
echo json_encode($category_arr);

?>
