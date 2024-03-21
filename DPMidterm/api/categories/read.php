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

//read all
$stmt = $category->read();
$num = $stmt->rowCount();

//data check
if ($num > 0) {

    //categories array
    $categories_arr = array();
    $categories_arr["records"] = array();

    //get categories from database
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = array(
            "id" => $id,
            "category" => $category
        );

        array_push($categories_arr["records"], $category_item);
    }

    //found
    http_response_code(200);
    echo json_encode($categories_arr);
} else {
    //404 Not found
    http_response_code(404);
    echo json_encode(
        array("message" => "No categories found.")
    );
}

?>
