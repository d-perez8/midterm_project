<?php
    class Author {
        //db private
        private $conn;
        private $table = 'authors';

        //db public
        public $id;
        public $author;

        //Constructor
        public function __construct($db) {
            $this->conn = $db;
        }


        //create an author
        public function create($authorName) {
            //create query
            $query = 'INSERT INTO ' . $this->table . ' (author) VALUES (:author)';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //bind param
            $stmt->bindParam(':author', $authorName);

            //execute query
            try { 
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error createing author: " . $e->getMessage();
                return false;
            }
        }

        //get all authors
        public function read() {
            //read query
            $query = 'SELECT id, author
            FROM ' . $this->table . '
            ORDER BY id ASC';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            return $stmt;
        }

        //get one author
        public function read_single($id) {
            // read query
            $query = "SELECT id, author FROM authors WHERE id = :id";
        
            //prepare statement
            $stmt = $this->conn->prepare($query);
        
            //bind param
            $stmt->bindParam(':id', $id);
        
            //execute query
            $stmt->execute();
        
            //get result
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            return $row;
        }

        //update author's name
        public function update($authorID, $newName) {
            //update query
            $query = 'UPDATE ' . $this->table . ' SET author = :author WHERE id = :id'; 

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bindParam(':author', $newName);
            $stmt->bindParam(':id', $authorID);

            //execute query
            try {
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error updating author: " . $e->getMessage();
                return false;
            }
        }

        //delete by id
        public function delete($authorID) {
            //delete query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //bind param
            $stmt->bindParam(':id', $authorID);

            //execute query
            try {
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error deleting author: " . $e->getMessage();
                return false;
            }
        }
    }
?>