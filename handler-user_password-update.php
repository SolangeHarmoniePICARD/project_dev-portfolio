<?php

session_start();

if($_GET['user-email']){

    $user_email = strip_tags($_GET['user-email']);
    $user_unencrypted_password = strip_tags($_POST['data_password']);
    $user_encrypted_password = password_hash($user_unencrypted_password , PASSWORD_DEFAULT);

    require_once('db_connect.php');
    $sql = 'UPDATE `table_users` SET `user_password`=:user_password WHERE `user_email`=:user_email';
    $query = $db->prepare($sql);
    $query->bindValue(':user_password', $user_encrypted_password, PDO::PARAM_STR);
    $query->bindValue(':user_email', $user_email, PDO::PARAM_STR);
    $query->execute();
    require_once('db_close.php');

    // Redirection
    $_SESSION['message'] = 'Password updated.';
    header('Location: form-user_login.php'); 

//If the form fields are empty
} else {
    $_SESSION['message'] = 'There is a problem.';
    header('Location: index.php'); 
}