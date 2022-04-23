<?php session_start();
require_once('db_connect.php');
$sql = 'SELECT user_id, user_username, user_password FROM table_users WHERE user_username = :user_username';
$query = $db->prepare($sql);
$query->execute(array('user_username' => $_POST['data_username']));
$result = $query->fetch();
require_once('db_close.php');
if(!$result){
    $_SESSION['error'] = 'Username or password are incorrect.';
    header('Location: form-user_login.php'); 
}else{
    $checking_password = password_verify($_POST['data_password'], $result['user_password']);
    if (!$checking_password) {
        $_SESSION['error'] = 'Username or password are incorrect.';
        header('Location: form-user_login.php');
    }else{
        $_SESSION['id'] = $result['user_id'];
        $_SESSION['username'] = $result['user_username'];
        $_SESSION['success'] = 'Successs!';
        header('Location: view-backoffice_home.php');  
    } 
}