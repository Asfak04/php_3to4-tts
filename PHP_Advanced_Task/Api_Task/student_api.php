<?php

    require_once("config.php");

    $sselect = "select * from students";
    $squery = mysqli_query($con,$sselect);

    $student = [];


    while($sresult = mysqli_fetch_array($squery)){

        $sdata["name"] = $sresult["name"];
        $sdata["surname"] = $sresult["surname"];
        $sdata["email"] = $sresult["email"];
        $sdata["gender"] = $sresult["gender"];
        $sdata["password"] = $sresult["password"];


        array_push($student,$sdata);
    }

    echo json_encode($student);



?>