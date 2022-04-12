<?php

    // Data cleaning & storing in variables
    $project_title = strip_tags($_POST['data_title']);
    $project_description = strip_tags($_POST['data_description']);

    // Data insertion into the database
    require_once('db_connection.php');
    $sql = 'INSERT INTO `table_projects` (`project_title`, `project_description`) VALUES (:project_title, :project_description);';
    $query = $db->prepare($sql);
    $query->bindValue(':project_title', $project_title, PDO::PARAM_STR);
    $query->bindValue(':project_description', $project_description, PDO::PARAM_STR);
    $query->execute();

    // Redirection
    echo '<div>Project added.</div>';
    echo '<div><a href="index.php"><button>Back</button></a></div>';