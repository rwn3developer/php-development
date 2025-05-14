<?php 
    session_start();
    $userid = $_SESSION['userid'];
    
    //user login but not admin
    if(!isset($userid) || $_SESSION['role']!=1){
        header("Location: ../index.php");
    }
?>