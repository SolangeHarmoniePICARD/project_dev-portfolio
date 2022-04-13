<?php

require_once('db_connection.php');
$sql = 'SELECT user_id, user_username, user_password FROM table_users WHERE user_username = :user_username';
$query = $db->prepare($sql);
$query->execute(array('user_username' => $_POST['data_username']));
$result = $query->fetch();

if(!$result){
    echo 'Username or password are incorrect.';
    echo '<a href="form_user-login.php"><button>Back</button></a>';
}else{
    $checking_password = password_verify($_POST['data_password'], $result['user_password']);
    if (!$checking_password) {
        echo 'Username or password are incorrect.';
        echo '<a href="form_user-login.php"><button>Back</button></a>';
    }else{
        session_start();
        $_SESSION['id'] = $result['user_id'];
        $_SESSION['username'] = $result['user_username'];
        $_SESSION['success'] = "Successs!";
        header('Location: view_back-home.php');  
    } 
}