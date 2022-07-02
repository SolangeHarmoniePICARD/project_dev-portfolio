<?php

session_start();

if ($_SESSION["submit_captcha-checker"] == $_POST["data_captcha-checker"]) {

    if(isset($_POST['data_username']) && !empty($_POST['data_username']) 
    && isset($_POST['data_email']) && !empty($_POST['data_email']) 
    && isset($_POST['data_password']) && !empty($_POST['data_password']) 
    && isset($_POST['data_pswd-confirmation']) && !empty($_POST['data_pswd-confirmation'])){

        if ($_POST['data_password'] == $_POST['data_pswd-confirmation']) {

            $user_username = strip_tags($_POST['data_username']);
            $user_email = strip_tags($_POST['data_email']);
            $user_unencrypted_password = strip_tags($_POST['data_password']);
            $user_encrypted_password = password_hash($user_unencrypted_password , PASSWORD_DEFAULT);
            $user_token = md5(rand());
            $user_status = 0;

            require_once('db_connect.php');
            $sql = 'SELECT * FROM `table_users` WHERE `user_username` = :user_username OR `user_email` = :user_email';
            $query = $db->prepare($sql);
            $query->bindValue(':user_username', $user_username, PDO::PARAM_STR);
            $query->bindValue(':user_email', $user_email, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch();
            //var_dump($result) ;
            if ($result['user_username'] == $user_username && $result['user_email'] == $user_email) {
                $_SESSION['message'] = 'This user registered with this email already exist.';
                header('Location: index.php'); 
            } else if ( $result['user_email'] == $user_email){
                $_SESSION['message'] = 'This email is already registered in the database.';
                header('Location: index.php'); 
            }else if ( $result['user_email'] == $user_email) {
                $_SESSION['message'] = 'This user already exist.';
                header('Location: index.php');
            } else {
                $sql = 'INSERT INTO table_users(`user_username`, `user_password`, `user_email`, `user_status`, `user_token`) VALUES(:user_username, :user_password, :user_email, :user_status, :user_token)';
                $query = $db->prepare($sql);
                $query->bindValue(':user_username', $user_username, PDO::PARAM_STR);
                $query->bindValue(':user_password', $user_encrypted_password, PDO::PARAM_STR);
                $query->bindValue(':user_email', $user_email, PDO::PARAM_STR);
                $query->bindValue(':user_status', $user_status, PDO::PARAM_INT);
                $query->bindValue(':user_token', $user_token, PDO::PARAM_STR);
                $query->execute();
                require_once('db_close.php'); // Closing database access

                $user_link = "http://localhost/project_dev-portfolio/handler-user_email-verification.php?user-token=" . $user_token ;
                $mail_headers = "From: " . "bdebot.dev@gmail.com" . "<" .  $user_email . ">\r\n";
                $mail_headers .= 'MIME-Version: 1.0' . "\r\n";
                $mail_headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";
                if(mail($user_email, 'Email confirmation', "Click to verify your Email: " . $user_link, $mail_headers)) {
                    $_SESSION['success'] = "Register done: please check your mail.";
                } else {
                    $_SESSION['error'] = "There is a problem.";
	            }

                // Redirection
                $_SESSION['message'] = 'Success ! User has been registered: verify your email adress.';
                header('Location: index.php'); 
            }


        } else {
            $_SESSION['message'] = 'Passwords don\'t match.';
            header('Location: index.php'); 
        }

    } else {
        $_SESSION['message'] = 'Complete all form fields.';
        header('Location: index.php'); 
    }

} else {
    $_SESSION['message'] = "There is an error with captcha!";
    header('Location: index.php'); 
}

// EOF