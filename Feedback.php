<?php
class Feedback
{
    private $conn;
    private $table_name = "feedbacks";

    public $student_id;
    public $date;
    public $tags;
    public $feedback;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function submit()
    {
        $query = "INSERT INTO " . $this->table_name . " (student_id, date, tags, feedback) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            echo "Error preparing statement: " . $this->conn->error;
            return false;
        }

        $stmt->bind_param("isss", $this->student_id, $this->date, $this->tags, $this->feedback);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error executing statement: " . $stmt->error;
            return false;
        }
    }
}
