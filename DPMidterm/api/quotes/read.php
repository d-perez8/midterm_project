<?php

//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//link database and author
include_once 'C:\xampp\htdocs\DPMidterm\config\Database.php'; //database
include_once 'C:\xampp\htdocs\DPMidterm\models\Quote.php'; //quote.php

//start up database and create authior object
$database = new Database();
$db = $database->connect();
$quoteObj = new Quote($db);

//to read all
$stmt = $quoteObj->read();
$num = $stmt->rowCount();

//data check
if ($num > 0) {
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
}
else {
    //404 not found
    http_response_code(404);
    echo json_encode(array("message" => "No quotes found."));
}
?>
