<?php
session_start();
if($_SESSION['username']){

    // Verifying form fields
    if(isset($_POST['data_title']) && !empty($_POST['data_title'])
    && isset($_POST['data_description']) && !empty($_POST['data_description'])){

        // Data cleaning & storing in variables
        $project_title = strip_tags($_POST['data_title']);
        $project_description = strip_tags($_POST['data_description']);
        $project_status = strip_tags($_POST['data_status']);

        $project_directoryUploads = 'uploads/';
        $project_thumbnail = $project_directoryUploads . 'thumbnail_' .time() . '_' . basename($_FILES['data_thumbnail']['name']);

        $check_upload = 1;
        $check_imageFileType = strtolower(pathinfo($project_thumbnail,PATHINFO_EXTENSION));
        $check_imageFileSize = getimagesize($_FILES['data_thumbnail']['tmp_name']);

    // Check if image file is a actual image or fake image
    if(isset($_POST['data_submit'])) {

        if($check_imageFileSize !== false) {
            // echo 'File is an image - ' . check_imageFileSize['mime'] . '. ';
            $check_upload = 1;
        } else {

            $check_upload = 0;
            $_SESSION['error'] .= 'File is not an image. ';
            header('Location: view_back-home.php'); 

        }

    }

    // Check if file already exists
    if (file_exists($project_thumbnail)) {

        $check_upload = 0;
        $_SESSION['error'] .= 'Sorry, file already exists. ';
        header('Location: view_back-home.php'); 

    }

    // Check file size
    if ($_FILES['data_thumbnail']['size'] > 2000000) {

        $check_upload = 0;
        $_SESSION['error'] .= 'Sorry, your file is too large. ';
        header('Location: view_back-home.php'); 

    }

    // Allow certain file formats
    if($check_imageFileType != 'jpg' && $check_imageFileType != 'png' && $check_imageFileType != 'jpeg'
    && $check_imageFileType != 'gif' ) {

        $check_upload = 0;
        $_SESSION['error'] .= 'Sorry, only JPG, JPEG, PNG & GIF files are allowed. ';
        header('Location: view_back-home.php'); 

    }

    // Check if $check_upload is set to 0 by an error
    if ($check_upload == 0) {

        $_SESSION['error'] .= 'Sorry, your file was not uploaded. ';
        header('Location: view_back-home.php'); 

    // if everything is ok, try to upload file
    } else {

        if (move_uploaded_file($_FILES['data_thumbnail']['tmp_name'], $project_thumbnail)) {

            // Data insertion into the database
            require_once('db_connect.php');

            $sql = 'SELECT * FROM `table_tags`';
            $query = $db->prepare($sql);
            $query->execute();
            $tags = $query->fetchAll(PDO::FETCH_ASSOC);

            $sql = 'INSERT INTO `table_projects` (`project_title`, `project_description`, `project_thumbnail`, `project_status`) VALUES (:project_title, :project_description, :project_thumbnail, :project_status)';
            $query = $db->prepare($sql);
            $query->bindValue(':project_title', $project_title, PDO::PARAM_STR);
            $query->bindValue(':project_description', $project_description, PDO::PARAM_STR);
            $query->bindValue(':project_thumbnail', $project_thumbnail, PDO::PARAM_STR);
            $query->bindValue(':project_status', $project_status, PDO::PARAM_STR);
            $query->execute();

            $project_id = $db->lastInsertId();
            
            $sql = 'INSERT INTO `intermediary_tags-to-projects` (`project_id`, `tag_id`) VALUES (:project_id, :tag_id)';
            $query = $db->prepare($sql);
            foreach($tags as $tag){
                $tag_id_.$tag['tag_name'] = strip_tags($_POST['data_'.$tag['tag_name']]) ;
                if ($project_tag_.$tag['tag_name']) {
                    $tag_id = $tag['tag_id'];
                    //echo $tag_id;
                    $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
                    $query->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
                    $query->execute();
                }
            }

            require_once('db_close.php'); // Closing database access

            // Redirection
            $_SESSION['success'] = "Project added.";
            header('Location: view-backoffice_home.php');


        } else {
            $_SESSION['error'] .= 'Sorry, there was an error uploading your file.';
            header('Location: view-backoffice_home.php'); 
        }

    }            

    //If the form fields are empty
    } else {
        $_SESSION['error'] = "Complete all fields.";
        header('Location: view-backoffice_home.php');
    }

// If bad authentification
} else {
    $_SESSION['error'] = "Username or password are incorrect.";
    header('Location: index.php');
 }