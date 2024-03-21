<?php

class Quote {
    //databse connections
    private $conn;
    private $table_name = "quotes";

    //public objects
    public $id;
    public $quote;
    public $author_id;
    public $category_id;

    //constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    //create new quote
    public function create($quote, $author_id, $category_id) {
        //create query
        $query = "INSERT INTO {$this->table_name} (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)";

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //bind params
        $stmt->bindParam(':quote', $quote);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':category_id', $category_id);

        //execute query
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error creating quote: " . $e->getMessage();
            return false;
        }
    }

    public function read() {
        //create query
        $query = "SELECT id, quote, author_id, category_id FROM {$this->table_name}";

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

    public function read_single() {
        // Query to retrieve a single quote record based on the ID
        $query = "SELECT id, quote, author_id, category_id FROM quotes WHERE id = ? LIMIT 1 OFFSET 0";
    
        // Prepare the query statement
        $stmt = $this->conn->prepare($query);
    
        // Bind the quote ID parameter
        $stmt->bindParam(1, $this->id);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch the quote record
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Set the properties with the fetched data
        $this->id = $row['id'];
        $this->quote = $row['quote'];
        $this->author_id = $row['author_id'];
        $this->category_id = $row['category_id'];
    }

    public function update($quote_id, $quote, $author_id, $category_id) {
        // Create query
        $query = "UPDATE {$this->table_name} SET quote = :quote, author_id = :author_id, category_id = :category_id WHERE id = :id";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $quote_id);
        $stmt->bindParam(':quote', $quote);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':category_id', $category_id);


        // Execute query
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log or handle the error appropriately
            error_log("Error updating quote: " . $e->getMessage());
            return false;
        }
    }


    public function delete($quote_id) {
        //create query
        $query = "DELETE FROM {$this->table_name} WHERE id = :id";

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //bind param
        $stmt->bindParam(':id', $quote_id);

        //execute query
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error deleting quote: ". $d->getMessage();
            return false;
        }
    }
}
?>