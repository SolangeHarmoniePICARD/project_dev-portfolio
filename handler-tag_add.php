<?php session_start();
    if(isset($_POST['data_tag-name']) && !empty($_POST['data_tag-name'])){
        $tag_name = strip_tags($_POST['data_tag-name']);
        require_once('db_connect.php');
        $sql = 'INSERT INTO `table_tags` (`tag_name`) VALUES (:tag_name)';
        $query = $db->prepare($sql);
        $query->bindValue(':tag_name', $tag_name, PDO::PARAM_STR);
        $query->execute();
        require_once('db_close.php'); // Closing database access
        $_SESSION['success'] = "Tag added.";
        header('Location: view-backoffice_tags-manager.php');
    } else {
        $_SESSION['error'] = "Complete all fields.";
        header('Location: view-backoffice_tags-manager.php');
    }

