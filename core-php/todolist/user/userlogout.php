<?php

    session_start();
    $_SESSION = []; // Clear session data
    session_destroy();
    header('location:../index.php');
?>