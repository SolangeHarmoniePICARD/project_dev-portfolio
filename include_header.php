<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A developer portfolio with back-office and visitor interface.">
    <title>Portfolio</title>
</head>
<body>

<?php
    if(!empty($_SESSION['success'])){
        echo '<div>'.$_SESSION['success'].'</div>';
        $_SESSION['success'] = ''; // Cleaning the superglobal variable
    } 
    if(!empty($_SESSION['error'])){
        echo '<div>'.$_SESSION['error'].'</div>';
        $_SESSION['error'] = ''; // Cleaning the superglobal variable
    }
?>
