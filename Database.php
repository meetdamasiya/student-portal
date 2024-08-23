<?php
class Database
{
    private $host = "localhost";
    private $db_name = "student_portal";
    private $username = "root";
    private $password = "admin@123";
    public $conn;

    public function connect()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}
