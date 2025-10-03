<?php

require_once("config.php");
$id = $_POST["id"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$password = $_POST["password"];







$sinsert = "update students set name='$name', surname='$surname', email='$email', gender='$gender', password='$password' where id = '$id'";
$squery = mysqli_query($con, $sinsert);

if ($squery) {
    echo "data updated successfully.";
}
else
{
    echo 'Something Went Wrong';
}
