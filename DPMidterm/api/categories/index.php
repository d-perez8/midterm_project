<?php
/* 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELTE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}
*/

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php';
include_once 'C:\xampp\htdocs\DPMidterm\models\Category.php';

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$category = new Category($db);

// Get HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

// Process HTTP request method
switch ($method) {
    case 'GET':
        // Get all categories
        $stmt = $category->read();
        $num = $stmt->rowCount();

        //data check
        if ($num > 0) {
            //categories array
            $categories_arr = array();
            $categories_arr["categories"] = array();

            //get them from database
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $category_item = array(
                    "id" => $id,
                    "category" => $category
                );

                array_push($categories_arr["categories"], $category_item);
            }

            //found
            http_response_code(200);
            echo json_encode($categories_arr);
        } else {
            //404 Not found
            http_response_code(404);
            echo json_encode(array("message" => "No categories found."));
        }
        break;
    case 'POST':
        //create
        include_once 'create.php';
        break;
    case 'PUT':
        //update
        include_once 'update.php';
        break;
    case 'DELETE':
        //delete
        include_once 'delete.php';
        break;
    default:
        //no other methods
        http_response_code(405);
        echo json_encode(array("message" => "Method not allowed."));
        break;
}
?>