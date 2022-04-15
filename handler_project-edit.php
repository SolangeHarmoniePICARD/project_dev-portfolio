<?php
session_start();
if($_SESSION['username']){

    // Verifying form fields
    if(isset($_POST['data_title']) && !empty($_POST['data_title'])
    && isset($_POST['data_description']) && !empty($_POST['data_description'])){

        // Data cleaning & storing in variables
        $project_id = strip_tags($_POST['project_id']);
        $project_title = strip_tags($_POST['data_title']);
        $project_description = strip_tags($_POST['data_description']);

        // Data insertion into the database
        require_once('db_connection.php');
        $sql = 'UPDATE `table_projects` SET `project_title`=:project_title, `project_description`=:project_description WHERE `project_id`=:project_id;';
        $query = $db->prepare($sql);
        $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $query->bindValue(':project_title', $project_title, PDO::PARAM_STR);
        $query->bindValue(':project_description', $project_description, PDO::PARAM_STR);
        $query->execute();
        require_once('db_close.php'); // Closing database access

        // Redirection
        $_SESSION['success'] = "Project modified.";
        header('Location: view_back-home.php'); 

    //If the form fields are empty
    } else {
        $_SESSION['error'] = "Complete all fields. ";
        header('Location: view_back-home.php'); 
    }
    
// If bad authentification
} else {
    $_SESSION['error'] = "Username or password are incorrect. ";
    header('Location: view_back-home.php'); 
 }