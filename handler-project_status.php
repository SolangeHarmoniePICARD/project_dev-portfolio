<?php
session_start();
if ($_SESSION['username']) {

    if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
        require_once('db_connect.php');
        $project_id = strip_tags($_GET['project_id']);
        $sql = 'SELECT * FROM `table_projects` WHERE `project_id` = :project_id';
        $query = $db->prepare($sql);
        $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        if (!$result) {
            $_SESSION['error'] = 'This ID doesn\'t exist.';
            header('Location: view-backoffice_home.php'); 
        } else {
            $project_status = ($result['project_status'] == 0) ? 1 : 0;
            $sql = 'UPDATE `table_projects` SET `project_status` = :project_status WHERE `project_id` = :project_id';
            $query = $db->prepare($sql);
            $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
            $query->bindValue(':project_status', $project_status, PDO::PARAM_INT);
            $query->execute();
            header('Location: view-backoffice_home.php');  
        }
        require_once('db_close.php');
    } else {
        $_SESSION['error'] = 'URL is not valid...';
        header('Location: view-backoffice_home.php'); 
    }
} else {
    $_SESSION['error'] = 'Username or password are incorrect.';
    header('Location: index.php');
}