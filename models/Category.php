<?php
    class Category {
        // DB stuff
        private $conn;
        private $table = 'categories';

         // Category Properties
        public $id;
        public $name;
        public $created_at;

        // Constructor with DB 
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Categories
        public function read() {
            // Create query
            $query = 'SELECT 
                             id,
                             name,
                             created_at
                      FROM
                            ' .$this->table. '
                      ORDER BY
                            created_at DESC';

            // Prepare statement
            $stmt = $this->conn->prepare($query);  // $stmt stands for statement and is the current convention;

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get single category
        public function read_single() {
              // Create query
              $query = 'SELECT 
                              id,
                              name       
                        FROM
                               ' .$this->table. ' 
                        WHERE 
                               id = ?
                        LIMIT  0,1';

            // Prepare statement
            $stmt = $this->conn->prepare($query); 

            // Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->name = $row['name'];
        }


        // Create category
        public function create() {
            // Create query
            $query = 'INSERT INTO ' .$this->table. '
                      SET
                          name = :name';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query); 


            // Bind params
            $stmt->bindParam(':name', $this->name);

            // Execute query
            if($stmt->execute()) {
                return true;
            }  

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error); 
            
            return false;
        }


        // Update category
        public function update() {
            // Create query
            $query = 'UPDATE ' .$this->table. '
                      SET
                          name = :name
                      WHERE
                          id = :id';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query); 

            // Bind params
            $stmt->bindParam(':id', $this->id); 
            $stmt->bindParam(':name', $this->name);

            // Execute query
            if($stmt->execute()) {
                return true;
            }  

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error); 
            
            return false;
        }


        // Delete category
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' .$this->table. '
                      WHERE
                          id = :id';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query); 

            // Bind ID
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