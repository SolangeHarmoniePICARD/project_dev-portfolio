<?php

    require_once('db_connection.php');
    $project_id = $_GET['project_id'];
    $sql = 'DELETE FROM `table_projects` WHERE `project_id` = :project_id;';
    $query = $db->prepare($sql);
    $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
    $query->execute();
    echo '<div>Project deleted!</div>';
    echo '<div><a href="index.php"><button>Back</button></a></div>';