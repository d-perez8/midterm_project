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

// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php';
include_once 'C:\xampp\htdocs\DPMidterm\models\Quote.php';

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$quote = new Quote($db);

// Get HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

// Process HTTP request method
switch ($method) {
    case 'GET':
        // Get all quotes
        $stmt = $quote->read();
        $num = $stmt->rowCount();

        //check for data
        if ($num > 0) {
            //quotes array
            $quotes_arr = array();
            $quotes_arr["quotes"] = array();

            //get from database
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $quote_item = array(
                    "id" => $id,
                    "quote" => $quote,
                    "author_id" => $author_id,
                    "category_id" => $category_id
                );

                array_push($quotes_arr["quotes"], $quote_item);
            }

            //found
            http_response_code(200);
            echo json_encode($quotes_arr);
        } else {
            //404 Not found
            http_response_code(404);
            echo json_encode(array("message" => "No quotes found."));
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
        //no other methodds
        http_response_code(405);
        echo json_encode(array("message" => "Method not allowed."));
        break;
}
?>
