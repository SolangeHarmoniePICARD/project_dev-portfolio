<?php
session_start();
    // Verifying form fields
    if(isset($_POST['data_tag-name']) && !empty($_POST['data_tag-name'])){

        // Data cleaning & storing in variables
        $tag_name = strip_tags($_POST['data_tag-name']);

            // Data insertion into the database
            require_once('db_connect.php');
            $sql = 'INSERT INTO `table_tags` (`tag_name`) VALUES (:tag_name)';
            $query = $db->prepare($sql);
            $query->bindValue(':tag_name', $tag_name, PDO::PARAM_STR);
            $query->execute();
            require_once('db_close.php'); // Closing database access

            // Redirection
            $_SESSION['success'] = "Tag added.";
            header('Location: view-backoffice_tags-manager.php');
           

    //If the form fields are empty
    } else {
        $_SESSION['error'] = "Complete all fields.";
        header('Location: view-backoffice_tags-manager.php');
    }

