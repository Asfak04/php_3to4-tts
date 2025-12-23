<?php
require_once "../models/Student.php";

$name  = $_POST['name'];
$marks = $_POST['marks'];
$subjects = ['Maths', 'English', 'Science','Gujarati','Hindi'];
$gpa   = $_POST['gpa'];

/* Combine subjects with marks */
$marksWithSubjects = array_combine($subjects, $marks);


$student = new Student($name, $marksWithSubjects, $gpa);

/* SAVE TO CSV */
$file = fopen("../reports/students.csv", "a");
fputcsv($file, $student->toCSVRow());
fclose($file);

/* PDF EXPORT */
if (isset($_POST['pdf'])) {
    require_once "../exports/generate_pdf.php";
    
}

header("Location: ../index.php");




