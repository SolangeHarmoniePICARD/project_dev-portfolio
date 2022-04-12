<?php

// Verifying form fields
if(isset($_GET['project_id']) && !empty($_GET['project_id'])){

    require_once('db_connection.php');

    // Data cleaning & storing in variable
    $project_id = $_GET['project_id'];

    // Delete request
    $sql = 'DELETE FROM `table_projects` WHERE `project_id` = :project_id;';
    $query = $db->prepare($sql);
    $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
    $query->execute();

    // Success
    echo '<div>Project deleted!</div>';
    echo '<div><a href="index.php"><button>Back</button></a></div>';

//If the form fields are empty    
} else {

    echo '<div>URL is not valid...</div>'; 
    echo '<div><a href="home.php"><button>Back</button></a></div>';

}
