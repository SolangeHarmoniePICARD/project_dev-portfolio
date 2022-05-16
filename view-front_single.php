<?php include 'include_header.php'; ?>

<?php

if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {

    require_once('db_connect.php');

    $project_id = strip_tags($_GET['project_id']);
    // Checking existence of the id sent by url
    $sql = 'SELECT * FROM `table_projects` WHERE `project_id` = :project_id';
    $query = $db->prepare($sql);
    $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();

    $sql = 'SELECT * FROM `table_tags`';
    $query = $db->prepare($sql);
    $query->execute();
    $tags = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM `table_projects` 
    JOIN `intermediary_tags-to-projects` 
    ON `table_projects`.`project_id` = `intermediary_tags-to-projects`.`project_id` 
    JOIN `table_tags` 
    ON `intermediary_tags-to-projects`.`tag_id` = `table_tags`.`tag_id`';
    $query = $db->prepare($sql);
    $query->execute();
    $intermediary_tags = $query->fetchAll(PDO::FETCH_ASSOC);

    require_once('db_close.php'); // Closing database access

    if (!$result) {
        $_SESSION['message'] = 'This ID doesn\'t exist.';
        header('Location: view-front_home.php'); 
    }

//If there is no id
} else {
    $_SESSION['message'] = 'URL is not valid...';
    header('Location: view-front_home.php'); 
}

?>

<h1><?=$result['project_title']?> </h1>
<p>
<?php
    //print_r($intermediary_tags );
    foreach($intermediary_tags as $intermediary_tag){
        if ($intermediary_tag['project_id'] ==  $project_id ) {
            echo '<button>'.$intermediary_tag['tag_name'].'</button>&nbsp;' ;
        } 
    }
?>
</p>
<figure>
    <img src="<?=$result['project_thumbnail']?>" alt="The thumbnail of the project <?=$result['project_title']?>.">
</figure>
<p><?=$result['project_description']?></p>
<div><a href="view-front_home.php"><button>Back</button></a></div>
<?php 
    if(!empty($_SESSION['username'])){
        echo '<div><a href="view-backoffice_home.php"><button>Back-office</button></a></div>';
    } else {

    }
?>

<?php include 'include_footer.php'; ?>