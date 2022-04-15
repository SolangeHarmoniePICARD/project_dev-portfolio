<?php
session_start();
// Verifying form fields
if(isset($_POST['data_username']) && !empty($_POST['data_username']) 
&& isset($_POST['data_email']) && !empty($_POST['data_email']) 
&& isset($_POST['data_password']) && !empty($_POST['data_password']) 
&& isset($_POST['data_pswd-confirmation']) && !empty($_POST['data_pswd-confirmation'])){
    // Check if password and confirmation matches
    if ($_POST['data_password'] == $_POST['data_pswd-confirmation']) {
        // Data cleaning and storage in database
        $user_username = strip_tags($_POST['data_username']);
        $user_email = strip_tags($_POST['data_email']);
        $user_unencrypted_password = strip_tags($_POST['data_password']);
        $user_encrypted_password = password_hash($user_unencrypted_password , PASSWORD_DEFAULT);
        // Checking if user already exist...
        require_once('db_connection.php');
        $sql = 'SELECT * FROM `table_users` WHERE `user_username` = :user_username';
        $query = $db->prepare($sql);
        $query->bindValue(':user_username', $user_username, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        //var_dump($result) ;
        if ($result['user_username'] == $user_username) {         
            $_SESSION['error'] = 'This user already exist.';
            header('Location: form_user-registration.php'); 
        } else {
            $sql = 'INSERT INTO table_users(`user_username`, `user_password`, `user_email`) VALUES(:user_username, :user_password, :user_email)';
            $query = $db->prepare($sql);
            $query->bindValue(':user_username', $user_username, PDO::PARAM_STR);
            $query->bindValue(':user_password', $user_encrypted_password, PDO::PARAM_STR);
            $query->bindValue(':user_email', $user_email, PDO::PARAM_STR);
            $query->execute();
            require_once('db_close.php'); // Closing database access
            // Redirection
            $_SESSION['success'] = 'Success ! User has been registered.';
            header('Location: form_user-login.php'); 
        }
    //If passwords don\'t match :)
    } else {
        $_SESSION['error'] = 'Passwords don\'t match.';
        header('Location: form_user-registration.php'); 
    }
//If the form fields are empty
}else{
    $_SESSION['error'] = 'Complete all form fields.';
    header('Location: form_user-registration.php'); 
}