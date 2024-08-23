<?php
class Student
{
    private $conn;
    private $table_name = "students";

    public $id;
    public $name;
    public $course;
    public $semester;
    public $email;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register()
    {
        $this->name = $this->conn->real_escape_string($this->name);
        $this->course = $this->conn->real_escape_string($this->course);
        $this->semester = $this->conn->real_escape_string($this->semester);
        $this->email = $this->conn->real_escape_string($this->email);
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO " . $this->table_name . " (name, course, semester, email, password) VALUES ('$this->name', '$this->course', '$this->semester', '$this->email', '$this->password')";

        return $this->conn->query($sql);
    }

    public function login()
    {
        $this->email = $this->conn->real_escape_string($this->email);
        $sql = "SELECT id, name, course, semester, password FROM " . $this->table_name . " WHERE email = '$this->email'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->course = $row['course'];
                $this->semester = $row['semester'];
                return true;
            }
        }
        return false;
    }
}
