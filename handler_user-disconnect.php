<?php 

// User logout
session_start();
$_SESSION = array();
session_destroy();

// Disconnection Success Message
session_start();
$_SESSION['success'] = "Logout successfully!";
header('Location: index.php');  