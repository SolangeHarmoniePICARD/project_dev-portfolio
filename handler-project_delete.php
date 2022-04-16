<?php
session_start();
if($_SESSION['username']){
    // Verifying form fields
    if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
        require_once('db_connect.php');
        // Data cleaning & storing in variable
        $project_id = $_GET['project_id'];
        // Checking existence of the id sent by url (method GET)
        $sql = 'SELECT * FROM `table_projects` WHERE `project_id` = :project_id;';
        $query = $db->prepare($sql);
        $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        if ($result) {
            // Delete request
            $sql = 'DELETE FROM `table_projects` WHERE `project_id` = :project_id;';
            $query = $db->prepare($sql);
            $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
            $query->execute();
            require_once('db_close.php'); // Closing database access
            unlink($result['project_thumbnail']);
            // Success
            $_SESSION['success'] = "Project deleted.";
            header('Location: view-backoffice_home.php'); 
        } else {
            $_SESSION['error'] = "This ID doesn\'t exist.";
            header('Location: view-backoffice_home.php'); 
        }

    //If the form fields are empty    
    } else {
        $_SESSION['error'] = "URL is not valid...";
        header('Location: view-backoffice_home.php'); 
    }
// If bad authentification
} else {
    $_SESSION['error'] = "Username or password are incorrect.";
    header('Location: index.php');
 }