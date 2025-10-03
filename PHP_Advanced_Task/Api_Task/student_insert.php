<?php
require_once("config.php");

$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$password = $_POST["password"];






if($name == "" || $surname =="" ||  $email =="" ||  $gender == "" || $password == ""){
    echo "0";
}else{
    $sinsert = "insert into students (name,surname,email,gender,password) values('$name','$surname','$email','$gender','$password')";
    $squery = mysqli_query($con,$sinsert);

    if($squery){
        echo "data inserted successfully.";
    }

}
?>