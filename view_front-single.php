<?php

    if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
        require_once('db_connection.php');
        $project_id = strip_tags($_GET['project_id']);

        // Checking existence of the id sent by url
        $sql = 'SELECT * FROM `table_projects` WHERE `project_id` = :project_id';
        $query = $db->prepare($sql);
        $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();

        if (!$result) {
            echo '<div>This ID doesn\'t exist.</div>';
            echo '<div><a href="view_front-home.php"><button>Back</button></a></div>';
        }

    //If there is no id
    } else {
        echo '<div>URL is not valid...</div>'; 
        echo '<div><a href="view_front-home.php"><button>Back</button></a></div>';
    }

?>

<?php include 'include_header.php' ?>

    <h1><?=$result['project_title']?> </h1>
    <p><?=$result['project_description']?></p>

<?php include 'include_footer.php' ?>