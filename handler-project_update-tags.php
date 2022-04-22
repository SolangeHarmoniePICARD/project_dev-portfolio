<?php

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
} 
catch (\Exception $e) {
    if ($db->inTransaction()) {
        $db->rollback();
        // If we got here our two data updates are not in the database
    }
    throw $e;
}


