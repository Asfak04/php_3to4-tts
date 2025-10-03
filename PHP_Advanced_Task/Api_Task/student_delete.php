<?php
require_once("config.php");

$id = $_POST['id'];

$sdelete = "delete from students where id='$id'";
$sdquery = mysqli_query($con,$sdelete);
if($sdquery){
    echo "data deleted successfully.";
}else{
    echo "data not deleted";
}



?>