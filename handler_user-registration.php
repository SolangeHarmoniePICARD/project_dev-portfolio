<?php
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
        // Data insertion into the database
        require_once('db_connection.php');
        $sql = 'INSERT INTO table_users(`user_username`, `user_password`, `user_email`) VALUES(:user_username, :user_password, :user_email)';
        $query = $db->prepare($sql);
        $query->bindValue(':user_username', $user_username, PDO::PARAM_STR);
        $query->bindValue(':user_password', $user_encrypted_password, PDO::PARAM_STR);
        $query->bindValue(':user_email', $user_email, PDO::PARAM_STR);
        $query->execute();
        // Redirection
        echo 'Success! </br> <a href="index.php"><button>Back</button></a>';
    //If passwords don\'t match :)
    } else {
        echo 'Passwords don\'t match.'; 
    }
//If the form fields are empty
}else{
    echo 'Complete all form fields.';
}