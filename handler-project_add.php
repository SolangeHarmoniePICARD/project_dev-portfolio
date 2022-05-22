<?php

session_start();

if($_SESSION['username']){

    if(isset($_POST['data_title']) && !empty($_POST['data_title'])
    && isset($_POST['data_description']) && !empty($_POST['data_description'])){

        $project_title = strip_tags($_POST['data_title']);
        $project_description = strip_tags($_POST['data_description']);
        $project_status = strip_tags($_POST['data_status']);
        $project_author = strip_tags($_SESSION['username']);

        $project_directoryUploads = 'uploads/';
        $project_thumbnail = $project_directoryUploads . 'thumbnail_' .time() . '_' . basename($_FILES['data_thumbnail']['name']);

        $check_upload = 1;
        $check_imageFileType = strtolower(pathinfo($project_thumbnail,PATHINFO_EXTENSION));
        $check_imageFileSize = getimagesize($_FILES['data_thumbnail']['tmp_name']);

        if(isset($_POST['data_submit'])) {

            if($check_imageFileSize !== false) {

                $check_upload = 1;

            } else {

                $check_upload = 0;
                $_SESSION['message'] .= 'File is not an image. ';
                header('Location: view_back-home.php'); 

            }
            
        }

        if (file_exists($project_thumbnail)) {

            $check_upload = 0;
            $_SESSION['message'] .= 'Sorry, file already exists. ';
            header('Location: view_back-home.php'); 

        }

        if ($_FILES['data_thumbnail']['size'] > 2000000) {

            $check_upload = 0;
            $_SESSION['message'] .= 'Sorry, your file is too large. ';
            header('Location: view_back-home.php'); 

        }

        if($check_imageFileType != 'jpg' && $check_imageFileType != 'png' && $check_imageFileType != 'jpeg' && $check_imageFileType != 'gif' ) {

            $check_upload = 0;
            $_SESSION['message'] .= 'Sorry, only JPG, JPEG, PNG & GIF files are allowed. ';
            header('Location: view_back-home.php'); 

        }

        if ($check_upload == 0) {

            $_SESSION['message'] .= 'Sorry, your file was not uploaded. ';
            header('Location: view_back-home.php'); 

        } else {

            if (move_uploaded_file($_FILES['data_thumbnail']['tmp_name'], $project_thumbnail)) {

                require_once('db_connect.php');

                $sql = 'SELECT user_id, user_username FROM table_users WHERE user_username = :user_username';
                $query = $db->prepare($sql);
                $query->bindValue(':user_username', $project_author, PDO::PARAM_STR);
                $query->execute();
                $user = $query->fetch();
                print_r($user);

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

                $sql = 'INSERT INTO `intermediary_authors-to-projects` (`project_id`, `user_id`) VALUES (:project_id, :user_id)';
                $query = $db->prepare($sql);
                $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
                $query->bindValue(':user_id', $user['user_id'], PDO::PARAM_INT);
                $query->execute();

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

                require_once('db_close.php');

                $_SESSION['message'] = "Project added.";
                header('Location: form-project_edit.php?project_id='.$project_id);

            } else {

                $_SESSION['message'] .= 'Sorry, there was an error uploading your file.';
                header('Location: view-backoffice_home.php'); 

            }

        }            
    } else {

        $_SESSION['message'] = "Complete all fields.";
        header('Location: view-backoffice_home.php');

    }

} else {

    $_SESSION['message'] = "Username or password are incorrect.";
    header('Location: index.php');

}

// EOF