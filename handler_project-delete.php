<?php
session_start();
if($_SESSION['username']){

    // Verifying form fields
    if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {

        require_once('db_connection.php');

        // Data cleaning & storing in variable
        $project_id = $_GET['project_id'];

        // Checking existence of the id sent by url (method GET)
        $sql = 'SELECT * FROM `table_projects` WHERE `project_id` = :project_id;';
        $query = $db->prepare($sql);
        $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        if ($result) {
            // Delete request
            $sql = 'DELETE FROM `table_projects` WHERE `project_id` = :project_id;';
            $query = $db->prepare($sql);
            $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
            $query->execute();
            require_once('db_close.php'); // Closing database access
            // Success
            echo '<div>Project deleted!</div>';
            echo '<div><a href="view_back-home.php"><button>Back</button></a></div>';
        } else {
            echo '<div>This ID doesn\'t exist.</div>';
            echo '<div><a href="view_back-home.php"><button>Back</button></a></div>';
        }

    //If the form fields are empty    
    } else {

        echo '<div>URL is not valid...</div>'; 
        echo '<div><a href="view_back-home.php"><button>Back</button></a></div>';

    }
// If bad authentification
} else {
    echo "Username or password are incorrect. ";
 }