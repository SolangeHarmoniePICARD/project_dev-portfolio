<?php

session_start();

if($_GET['user-token']){


        $user_token = strip_tags($_GET['user-token']);
        $user_status = 1;

        // Data insertion into the database
        require_once('db_connect.php');
        $sql = 'UPDATE `table_users` SET `user_status`= :user_status WHERE `user_token`=:user_token;';
        $query = $db->prepare($sql);
        $query->bindValue(':user_status', $user_status, PDO::PARAM_INT);
        $query->bindValue(':user_token', $user_token, PDO::PARAM_STR);
        $query->execute();
        require_once('db_close.php'); // Closing database access

        $_SESSION['message'] = "Ok, your registration is complete.";
        header('Location: form-user_login.php'); 
    

} else {

        $_SESSION['message'] =  "There is a problem..." ;
        header('Location: index.php'); 

 }

 // EOF