<?php

//link files
require_once 'C:\xampp\htdocs\DPMidterm\config\Database.php';
require_once 'C:\xampp\htdocs\DPMidterm\models\Author.php';
require_once 'C:\xampp\htdocs\DPMidterm\models\Category.php';
require_once 'C:\xampp\htdocs\DPMidterm\models\Quote.php';

//for HTTP requests
$path = $_SERVER['REQUEST_URI'];

try {
    // Create database vlass
    $database = new Database();
    $db = $database->connect();

    if ($path === '/DPMidterm/models/index.php/authors') {
        //request for authors
        $author = new Author($db);
        $authors = $author->read();
        echo json_encode($authors);
    } elseif ($path === '/DPMidterm/models/index.php/categories') {
        //request for categories
        $category = new Category($db);
        $categories = $category->read();
        echo json_encode($categories);
    } elseif ($path === '/DPMidterm/models/index.php/quotes') {
        //request for quotes
        $quote = new Quote($db);
        $quotes = $quote->read();
        echo json_encode($quotes);
    } else {
        //if didnt get any
        http_response_code(404);
        echo 'Not Found';
    }
} catch (Exception $e) {
    //for other exceptions
    http_response_code(500);
    echo 'Internal Server Error: ' . $e->getMessage();
}

?>
