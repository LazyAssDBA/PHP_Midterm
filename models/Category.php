<?php
    class Category {
        // DB Stuff
        private $conn;
        private $table = 'categories';
        
        // Properties
        public $id;
        public $category;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Categories
        public function read() {
            // Create Query
            $query = 'SELECT
                id, 
                category
            FROM
                ' . $this->table . ' 
            ORDER BY 
                id ASC';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Category
        public function read_single() {
            // Create query
            $query = 'SELECT
                        id,
                        category 
                    FROM
                    ' . $this->table . ' 
                    WHERE
                        id = ?';
                    
            // Prepare statement
            $stmt = $this->conn->prepare($query);
        
            // Bind ID
            $stmt->bindParam(1, $this->id);
        
            try {
                // Execute query
                $stmt->execute();
        
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if($row) {
                    // Set properties
                    $this->category = $row['category'];
                    $this->id = $row['id'];
                    return true;
                } else {
                    return false;
                }
            } catch(PDOexception $d) {
                echo json_encode(array('message' => $e->getMessage()))
            }


        // Create a Category
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . ' (category) VALUES (:category)';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->category = htmlspecialchars(strip_tags($this->category));

            // Bind data
            $stmt->bindParam(':category', $this->category);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Update Category
        public function update() {
            // Create query
            $query = 'UPDATE ' . $this->table . ' SET category = :category WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':category', $this->category);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Author
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
?>