<?php

session_start();

if($_SESSION['username']){
    if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
        require_once('db_connect.php');
        $project_id = $_GET['project_id'];
        $sql = 'SELECT * FROM `table_projects` WHERE `project_id` = :project_id;';
        $query = $db->prepare($sql);
        $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        if ($result) {
            $sql = 'DELETE FROM `table_projects` WHERE `project_id` = :project_id;';
            $query = $db->prepare($sql);
            $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
            $query->execute();
            require_once('db_close.php');
            unlink($result['project_thumbnail']);
            $_SESSION['message'] = "Project deleted.";
            header('Location: view-backoffice_home.php'); 
        } else {
            $_SESSION['message'] = "This ID doesn\'t exist.";
            header('Location: view-backoffice_home.php'); 
        }
    } else {
        $_SESSION['message'] = "URL is not valid...";
        header('Location: view-backoffice_home.php'); 
    }
} else {
    $_SESSION['message'] = "Username or password are incorrect.";
    header('Location: index.php');
 }

// EOF