<?php 
    $con = mysqli_connect("localhost","root","","taskmanager");
    if(!$con){
        echo "database not connected";
    }
?>