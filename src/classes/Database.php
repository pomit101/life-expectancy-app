<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'your_database_name';
    private $username = 'your_username';
    private $password = 'your_password';
    public $conn;

    public function dbConnection() {
        $this->conn = null;   
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function create($table, $data) {
        // Prepare and execute the create operation in the database
    }

    public function read($table, $id) {
        // Prepare and execute the read operation in the database
    }

    public function update($table, $id, $data) {
        // Prepare and execute the update operation in the database
    }

    public function delete($table, $id) {
        // Prepare and execute the delete operation in the database
    }
}
