<?php
session_start();

if (isset($_SESSION['student_id'])) {
   
    header("Location: feedback.php");
} else {
    header("Location: login.php");
}

exit();
