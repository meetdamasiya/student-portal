<?php
require 'Database.php';
require 'Student.php';
session_start();

$database = new Database();
$db = $database->connect();
$student = new Student($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student->email = $_POST['email'];
    $student->password = $_POST['password'];


    if ($student->login()) {
        $_SESSION['student_id'] = $student->id;
        $_SESSION['student_name'] = $student->name;
        $_SESSION['student_course'] = $student->course;
        $_SESSION['student_semester'] = $student->semester;
        header("Location: feedback.php");
        exit();
    } else {
        echo "Login failed. Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="validation.js"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-5">Student Login</h2>
                <form name="loginForm" method="post" onsubmit="return validateLogin();" class="mt-4">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>


</body>

</html>
