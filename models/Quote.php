<?php
    class Quote {
        // DB Stuff
        private $conn;
        private $table = 'quotes';
        
        // Properties
        public $id;
        public $quote;
        public $author;
        public $category;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Quotes
        public function read() {
            if (isset($_GET['authorId'])) {
                $authorId = filter_input(INPUT_GET, 'authorId', FILTER_SANITIZE_NUMBER_INT);
                $whereAuthorId = ' AND author_id = :authorId';
            } else { $whereAuthorId = ''; }

            if (isset($_GET['categoryId'])) {
                $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
                $whereCategoryId = ' AND category_id = :categoryId';
            } else { $whereCategoryId = ''; }
            

            // Create Query
            $query = 'SELECT
                q.id, 
                q.quote,
                q.author_id,
                a.author,
                q.category_id,
                c.category
            FROM
                ' . $this->table . ' q 
            JOIN 
                authors a ON q.author_id = a.id
            JOIN 
                categories c ON q.category_id = c.id
            WHERE 1 = 1';
            
        
            $orderBy = ' ORDER BY q.id ASC';
            $query = $query . $whereAuthorId . $whereCategoryId . $orderBy;

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind params
            if (isset($_GET['authorId'])) { $stmt->bindParam(':authorId', $authorId); }
            if (isset($_GET['categoryId'])) { $stmt->bindParam(':categoryId', $categoryId); }

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Quote
        public function read_single() {
            // Create query
            $query = 'SELECT
                q.id, 
                q.quote,
                q.author_id,
                a.author,
                q.category_id,
                c.category 
            FROM
                ' . $this->table . ' q 
            JOIN 
                authors a ON q.author_id = a.id
            JOIN 
                categories c ON q.category_id = c.id
            WHERE
                q.id = :id';
                    
            // Prepare statement
            $stmt = $this->conn->prepare($query);
        
            // Bind ID
            $stmt->bindParam(':id', $this->id);
        
            // Execute query
            $stmt->execute();
        
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // Set properties
            $this->quote = $row['quote'];
            //$this->author_id = $row['author_id'];
            $this->author = $row['author'];
            //$this->category_id = $row['category_id'];
            $this->category = $row['category'];
        }


        // Create a Quote
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // Bind data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Update Quote
        public function update() {
            // Create query
            $query = 'UPDATE ' . $this->table . ' SET quote = :quote, author_id = :author_id, category_id = :category_id WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete quote
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