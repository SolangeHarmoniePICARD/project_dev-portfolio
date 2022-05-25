<?php

session_start();

if($_GET['user-email'] && $_GET['user-token']){

        $user_email = strip_tags($_GET['user-email']);
        $user_token = strip_tags($_GET['user-token']);

        // echo $user_email;
        // echo $user_token;

        require_once('db_connect.php');
        $sql = 'SELECT * FROM table_reset WHERE reset_token = :reset_token';
        $query = $db->prepare($sql);
        $query->execute(array('reset_token' => $user_token));
        $result = $query->fetch();
        require_once('db_close.php');

        if(!$result){
            $_SESSION['message'] = 'There is a problem...';
            header('Location: index.php'); 
        }else{

            $_SESSION['message'] = 'Successs!';
            header('Location: form-user_password-update.php?user-email=' . $user_email);  

        }
    

} else {
    $_SESSION['message'] = 'There is a problem...';
    header('Location: index.php'); 
 }

 // EOF