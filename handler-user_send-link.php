<?php

session_start();

require_once('db_connect.php');
$sql = 'SELECT * FROM table_users WHERE user_email = :user_email';
$query = $db->prepare($sql);
$query->execute(array('user_email' => $_POST['data_email']));
$result = $query->fetch();
require_once('db_close.php');

if(!$result){
    $_SESSION['message'] = 'That address is either invalid.';
    header('Location: index.php'); 
}else{
    $user_id = $result['user_id'];
    $user_token = md5(rand());
    // echo $user_token ;
    // echo '<br>';
    //var_dump($result);
    // echo $user_id ;

    require_once('db_connect.php');
    $sql = 'INSERT INTO table_reset(`reset_token`, `user_id`) VALUES(:reset_token, :user_id)';
    $query = $db->prepare($sql);
    $query->bindValue(':reset_token', $user_token, PDO::PARAM_STR);
    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    require_once('db_close.php');

    $user_email = $result['user_email'];
    $user_link = "<a href='http://localhost/project_dev-portfolio/handler-user_check-token.php?user-email=" . $user_email . "&user-token=" . $user_token ."'>Click here to update your password.</a>" ;
    $mail_headers = "From: " . "bdebot-dev@proton.me" . "<" .  $user_email . ">\r\n";
    $mail_headers .= 'MIME-Version: 1.0' . "\r\n";
    $mail_headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";
    if(mail($user_email, 'Update password', $user_link, $mail_headers)) {
        $_SESSION['message'] = "Please check your mail for updating your password.";
    } else {
        $_SESSION['message'] = "There is a problem.";
	}


    header('Location: index.php');  
}



