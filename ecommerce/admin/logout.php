<?php
    session_start();
    unset($_SESSION['ADMMIN_LOGIN']);
    unset($_SESSION['ADMIN_USERNAME']);
    header('location:login.php');
?>