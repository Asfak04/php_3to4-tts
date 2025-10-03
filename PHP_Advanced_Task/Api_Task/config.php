<?php
define('HOST','LOCALHOST');
define('USER','root');
define('PASS','');
define('DBNAME','tops');


$con = new mysqli(HOST,USER,PASS,DBNAME);

if($con){
    // echo "connected successfully.";
}else{
    die("connection failed".mysqli_connect_error());
}




?>