<?php 
    session_start();
    $userid = $_SESSION['userid'];

    //userid null user not login
    if(!isset($userid)){
        header("Location: ../index.php");
    }
?>