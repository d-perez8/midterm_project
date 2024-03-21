<?php
    class Category {

        private $conn;
        private $table = 'categories';

        public $id;
        public $category;

        //Constructor
        public function __construct($db) {
            $this->conn = $db;
        }


        //create category
        public function create($categoryName, $author_id, $quote_text) {
            //create
            $query = 'INSERT INTO ' . $this->table . ' (category, author_id, quote_text) VALUES (:category, :author_id, :quote_text)';
        
            //prep
            $stmt = $this->conn->prepare($query);
        
            //bind param
            $stmt->bindParam(':category', $categoryName);
            $stmt->bindParam(':author_id', $author_id);
            $stmt->bindParam(':quote_text', $quote_text);
        
            //execute
            try { 
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                // Log or handle the error appropriately
                error_log("Error creating category: " . $e->getMessage());
                return false;
            }
        }
        

        //get all categories
        public function read() {
            //cget query
            $query = 'SELECT id, category
            FROM ' . $this->table . '
            ORDER BY id ASC';

            //prep
            $stmt = $this->conn->prepare($query);

            //execute
            $stmt->execute();

            return $stmt;
        }

        //get one category
        public function read_single($id) {
            //get
            $query = 'SELECT id, category FROM ' . $this->table . ' WHERE id = :id';
            
            //prep
            $stmt = $this->conn->prepare($query);
            
            //bind param
            $stmt->bindParam(':id', $id);
            
            //execute
            $stmt->execute();
            
            //get one
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            //setting values
            $this->id = $row['id'];
            $this->category = $row['category'];
        }
        
        //update
        public function update($categoryID, $newName) {
            //update query
            $query = 'UPDATE ' . $this->table . ' SET category = :category WHERE id = :id'; 

            //prep
            $stmt = $this->conn->prepare($query);

            //params
            $stmt->bindParam(':category', $newName);
            $stmt->bindParam(':id', $categoryID);

            //execute
            try {
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error updating category: " . $e->getMessage();
                return false;
            }
        }

        //delete category
        public function delete($categoryID) {
            //dlete
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            //prep
            $stmt = $this->conn->prepare($query);

            //bind
            $stmt->bindParam(':id', $categoryID);

            //execute
            try {
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error deleting category: " . $e->getMessage();
                return false;
            }
        }
    }
?>