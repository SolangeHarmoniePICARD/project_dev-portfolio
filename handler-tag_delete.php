<?php
session_start();

    if (isset($_GET['tag_id']) && !empty($_GET['tag_id'])) {
        require_once('db_connect.php');
        // Data cleaning & storing in variable
        $tag_id = $_GET['tag_id'];
        // Checking existence of the id sent by url (method GET)
        $sql = 'SELECT * FROM `table_tags` WHERE `tag_id` = :tag_id;';
        $query = $db->prepare($sql);
        $query->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        if ($result) {
            // Delete request
            $sql = 'DELETE FROM `table_tags` WHERE `tag_id` = :tag_id;';
            $query = $db->prepare($sql);
            $query->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
            $query->execute();
            require_once('db_close.php'); // Closing database access
            // Success
            $_SESSION['success'] = "Tag deleted.";
            header('Location: view-backoffice_tags-manager.php'); 
        } else {
            $_SESSION['error'] = "This ID doesn\'t exist.";
            header('Location: view-backoffice_tags-manager.php'); 
        }

    //If the form fields are empty    
    } else {
        $_SESSION['error'] = "URL is not valid...";
        header('Location: view-backoffice_tags-manager.php'); 
    }
