<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A developer portfolio with back-office and visitor interface.">
    <title>Portfolio</title>
    <style>

        #warning_capsLock {
            display:none;
            color:red
        }

        /* The message box is shown when the user clicks on the password field */
        #message-validation {
            display:none;
            position: relative;
            padding: 20px;
            margin-top: 10px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -24px;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -24px;
            content: "✖";
        }

    </style>
</head>
<body>

<?php
    if(!empty($_SESSION['message'])){
        echo '<p>'.$_SESSION['message'].'</p>';
        $_SESSION['message'] = ''; // Cleaning the superglobal variable
    } 
?>
