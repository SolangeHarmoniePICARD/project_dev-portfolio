<?php 

session_start();

if($_SESSION['username']){

    if(isset($_POST['data_submit']) && !empty($_POST['data_submit'])){

        $project_id = strip_tags($_POST['project_id']);

        require_once('db_connect.php');

        try {

            $sql = 'DELETE FROM `intermediary_tags-to-projects` WHERE `project_id` = :project_id;' ;
            $query = $db->prepare($sql);
            $db->beginTransaction();
            $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
            $query->execute();

            $sql = 'INSERT INTO `intermediary_tags-to-projects` (`project_id`, `tag_id`) VALUES (:project_id, :tag_id)';
            $query = $db->prepare($sql);
            foreach($_POST as $tag => $tag_id){
                if ($tag != 'project_id') {
                        $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
                        $query->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
                        $query->execute();
                }
            }
            
            $db->commit();

            $_SESSION['message'] = 'Tags have been updated. ';
            header('Location: form-project_edit.php?project_id='.$project_id); 
            
        } catch (\Exception $e) {
            if ($db->inTransaction()) {
                $db->rollback();
                // If we got here our two data updates are not in the database
            }
            throw $e;
        }

        require_once('db_close.php');
    } else {
        $_SESSION['message'] = "Complete all fields.";
        header('Location: view-backoffice_home.php');
    }
} else {
    $_SESSION['message'] = "Username or password are incorrect.";
    header('Location: index.php');
}

//EOF