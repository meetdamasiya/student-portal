<?php


session_start();
require 'Database.php';
require 'Student.php';


$database = new Database();
$db = $database->connect();
$student = new Student($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student->name = $_POST['name'];
    $student->course = $_POST['course'];
    $student->semester = $_POST['semester'];
    $student->email = $_POST['email'];
    $student->password = $_POST['password'];


    if ($student->register()) {
        echo "Registration successful.";
    } else {
        echo "Unable to register.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="validation.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Student Registration</h2>
        <form name="registrationForm" method="post" onsubmit="return validateRegistration();">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="course">Course:</label>
                <select class="form-control" id="course" name="course" required>
                    <option value="B.Tech">B.Tech</option>
                    <option value="M.Tech">M.Tech</option>
                    <option value="Bsc">Bsc</option>
                    <option value="Msc">Msc</option>
                    <option value="BCA">BCA</option>
                    <option value="MCA">MCA</option>
                </select>
            </div>

            <div class="form-group">
                <label for="semester">Semester:</label>
                <select class="form-control" id="semester" name="semester" required>
                    <option value="I">I</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                    <option value="VI">VI</option>
                    <option value="VII">VII</option>
                    <option value="VIII">VIII</option>
                    <option value="IX">IX</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>