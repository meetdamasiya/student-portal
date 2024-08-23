<?php


require 'Database.php';
require 'Feedback.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->connect();
$feedback = new Feedback($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback->student_id = $_SESSION['student_id'];
    $feedback->date = date("Y-m-d");

    if (isset($_POST['tags']) && !empty($_POST['tags'])) {
        $feedback->tags = implode(",", $_POST['tags']);
    } else {
        echo "Please select at least one tag.";
        exit();
    }

    $feedback->feedback = $_POST['feedback'];

    if ($feedback->submit()) {
        echo "Feedback submitted successfully.";
    } else {
        echo "Unable to submit feedback.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="validation.js"></script>
</head>

<body>
    <div class="container mt-5 d-flex flex-column">
        <form action="logout.php" method="post" class="mt-4 align-self-end">
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
        <h2 class="mb-4">Student Feedback</h2>
        <form name="feedbackForm" method="post" onsubmit="return validateFeedback();">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" value="<?php echo $_SESSION['student_name']; ?>" disabled>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="text" class="form-control" id="date" value="<?php echo date('Y-m-d'); ?>" disabled>
            </div>

            <div class="form-group">
                <label for="course">Course:</label>
                <input type="text" class="form-control" id="course" value="<?php echo $_SESSION['student_course']; ?>" disabled>
            </div>

            <div class="form-group">
                <label for="semester">Semester:</label>
                <input type="text" class="form-control" id="semester" value="<?php echo $_SESSION['student_semester']; ?>" disabled>
            </div>

            <div class="form-group">
                <label for="tags">Tags:</label>
                <select class="form-control" id="tags" name="tags[]" required>
                    <option value="Poor">Poor</option>
                    <option value="Medium">Medium</option>
                    <option value="Good">Good</option>
                    <option value="Excellent">Excellent</option>
                </select>
            </div>

            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form>


    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>