<?php

// Include author class
//require_once 'C:\xampp\htdocs\DPMidterm\models\Author.php';
//require_once 'C:\xampp\htdocs\DPMidterm\models\Category.php';
require_once 'C:\xampp\htdocs\DPMidterm\models\Quote.php';

// Database connection params
$db_host = 'localhost';
$db_port = '5432';
$db_name = 'quotesdb';
$db_user = 'postgres';
$db_pass = 'postgres';

// Create PDO instance for database connection
try {
    $pdo = new PDO("pgsql:host={$db_host};port={$db_port};dbname={$db_name}", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database successfully\n";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Create instance of Author class
//$author = new Author($pdo);
/*
// Test create method
$newAuthorName = "Chris Smith";
if ($author->create($newAuthorName)) {
    echo "Author '{$newAuthorName}' created successfully\n";
} else {
    echo "Failed to create author '{$newAuthorName}'\n";
}
*/

//Test update method
/*
$authorIdUpdate = 8;
$newName = "John Smith8";

if ($author->update($authorIdUpdate, $newName)) {
    echo "Author with ID {$authorIdUpdate} updated successfully\n";
}
else {
    echo "Failed to update author id number: {$authorIdUpdate}\n";
}
*/

//Test delte method
/*
$authorDelete = 8;
if ($author->delete($authorDelete)) {
    echo "Author with ID {$authorDelete} deleted successfully\n";
}
else {
    echo "Failed to delete author with ID {authorDelete}\n";
}

// Test read method
try {
    $result = $author->read();
    $authors = $result->fetchAll(PDO::FETCH_ASSOC);
    if ($authors) {
        echo "Authors retrieved successfully\n";
        echo "<pre>";
        print_r($authors);
        echo "</pre>";
    } else {
        echo "No authors found\n";
    }
} catch (PDOException $e) {
    echo "Error retrieving authors: " . $e->getMessage();
}
*/
/*
$category = new Category($pdo);
*/
//test create method
/*
$newCategoryName = "Motivational";
if ($category->create($newCategoryName)) {
    echo "Category '{$newCategoryName}' created successfully\n";
}
else {
    echo "Failed to create category '{$newCategoryName}';\n";
}
*/

//testing update method
/*
$categoryUpdateById = 1;
$newCategoryName = "Inspirational";
if ($category->update($categoryUpdateById, $newCategoryName)) {
    echo "Category with id {$categoryUpdateById} updated successfully\n";
}
else {
    echo "Failed to update category with ID {$categoryUPdateById}\n";
}
*/

//testing read method
/*
try {
    $result = $category->read();
    $categories = $result->fetchAll(PDO::FETCH_ASSOC);
    if ($categories) {
        echo "Categories retrieved successfully\n";
        echo "<pre>";
        print_r($categories);
        echo "</pre>";
    }
    else {
        echo "No categories found\n";
    }
} catch (PDOException $e) {
    echo "Error retrieving categories: " . $e->getMessage();
}
*/

//testing delete method
/*
$categoryDeleteById = 1;
if ($category->delete($categoryDeleteById)) {
    echo "Category with id {$categoryDeleteById} deleted successfully\n";
}
else {
    echo "Failed to delete category with id {$categoryDeleteById}\n";
}
*/

// Test getCategory_id method
/*
$categoryId = 2; // Replace with a valid category ID
$categoryInfo = $category->getCategory_id($categoryId);
if ($categoryInfo) {
    echo "Category with ID {$categoryId} found:\n";
    echo "<pre>";
    print_r($categoryInfo);
    echo "</pre>";
} else {
    echo "Category with ID {$categoryId} not found.\n";
}
*/


// Test findCategorykey method
/*
$keyword = "Motivational"; // Replace with a keyword to search for
$categories = $category->findCategorykey($keyword);
if ($categories->rowCount() > 0) {
    echo "Categories containing '{$keyword}':\n";
    while ($row = $categories->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: {$row['id']}, Category: {$row['category']}\n";
    }
} else {
    echo "No categories containing '{$keyword}' found.\n";
}
*/

//create instance of quote class
$quote = new Quote($pdo);


//testing create method
/*
$quoteText = "I hope this works.";
$authorID = 2;
$categoryID = 2;

if ($quote->create($quoteText, $authorID, $categoryID)) {
    echo "Quote created successfully\n";
} else {
    echo "Failed to create quote\n";
}
*/

// Test the read method
/*
try {
    $result = $quote->read();
    $quotes = $result->fetchAll(PDO::FETCH_ASSOC);
    
    if ($quotes) {
        echo "Quotes retrieved successfully\n";
        foreach ($quotes as $quote) {
            echo "ID: {$quote['id']}, Quote: {$quote['quote']}, Author ID: {$quote['author_id']}, Category ID: {$quote['category_id']}\n";
        }
    } else {
        echo "No quotes found\n";
    }
} catch (PDOException $e) {
    echo "Error retrieving quotes: " . $e->getMessage();
}
*/

//test read_one method
/*
$quoteID = 6;
try {
    $result = $quote->read_one($quoteID);
    $quoteData = $result->fetch(PDO::FETCH_ASSOC);
    if ($quoteData) {
        echo "Quote with ID {$quoteID} found:\n";
        echo "<pre>";
        print_r($quoteData);
        echo "</pre>";
    } else {
        echo "Quote with ID {$quoteID} not found\n";
    }
} catch (PDOException $e) {
    echo "Error retrieving quote: " . $e->getMessage();

}
*/

// Test update method
$quoteID = 6;
$newQuote = "update, i hope this works too.";
$newAuthorID = 2;
$newCategoryID = 2;
try {
    if ($quote->update($quoteID, $newQuote, $newAuthorID, $newCategoryID)) {
        echo "Quote with ID {$quoteID} updated successfully\n";
    } else {
        echo "Failed to update quote with ID {$quoteID}\n";
    }
} catch (PDOException $e) {
    echo "Error updating quote: " . $e->getMessage();
}

?>