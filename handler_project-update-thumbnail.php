<?php 
session_start();

$project_id = strip_tags($_POST['project_id']);
$project_directoryUploads = 'uploads/';
$project_thumbnail = $project_directoryUploads . 'thumbnail_' .time() . '_' . basename($_FILES['data_thumbnail']['name']);

// echo $project_thumbnail ;
// echo $_FILES['data_thumbnail']['name'] ;

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
        header('Location: form_project-edit.php?project_id='.$_POST['project_id']); 

    }

}

// Check if file already exists
if (file_exists($project_thumbnail)) {

    $check_upload = 0;
    $_SESSION['error'] .= 'Sorry, file already exists. ';
    header('Location: form_project-edit.php?project_id='.$_POST['project_id']); 

}

// Check file size
if ($_FILES['data_thumbnail']['size'] > 2000000) {

    $check_upload = 0;
    $_SESSION['error'] .= 'Sorry, your file is too large. ';
    header('Location: form_project-edit.php?project_id='.$_POST['project_id']); 

}

// Allow certain file formats
if($check_imageFileType != 'jpg' && $check_imageFileType != 'png' && $check_imageFileType != 'jpeg'
&& $check_imageFileType != 'gif' ) {

    $check_upload = 0;
    $_SESSION['error'] .= 'Sorry, only JPG, JPEG, PNG & GIF files are allowed. ';
    header('Location: form_project-edit.php?project_id='.$_POST['project_id']); 

}

// Check if $check_upload is set to 0 by an error
if ($check_upload == 0) {

    $_SESSION['error'] .= 'Sorry, your file was not uploaded. ';
    header('Location: form_project-edit.php?project_id='.$_POST['project_id']); 

// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES['data_thumbnail']['tmp_name'], $project_thumbnail)) {

        // Data insertion into the database
        require_once('db_connection.php');
        $sql = 'UPDATE `table_projects` SET `project_thumbnail`=:project_thumbnail WHERE `project_id`=:project_id';
        $query = $db->prepare($sql);
        $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $query->bindValue(':project_thumbnail', $project_thumbnail, PDO::PARAM_STR);
        $query->execute();
        require_once('db_close.php'); // Closing database access

        // Redirection
        $_SESSION['success'] = 'The file '. htmlspecialchars( basename( $_FILES['data_thumbnail']['name'])). ' has been uploaded. ';
        header('Location: form_project-edit.php?project_id='.$_POST['project_id']); 


    } else {
        $_SESSION['error'] .= 'Sorry, there was an error uploading your file.';
        header('Location: form_project-edit.php?project_id='.$_POST['project_id']); 
    }

}