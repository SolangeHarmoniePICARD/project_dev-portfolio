<?php include 'include_header.php'; ?>

<?php

if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {

    $project_id = strip_tags($_GET['project_id']);

    require_once('db_connect.php');

    $sql = 'SELECT * FROM `table_projects` WHERE `project_id` = :project_id';
    $query = $db->prepare($sql);
    $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
    $query->execute();
    $project = $query->fetch();

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

    $sql = 'SELECT * FROM `table_projects`
    JOIN `intermediary_authors-to-projects` 
    ON `table_projects`.`project_id` = `intermediary_authors-to-projects`.`project_id` 
    JOIN `table_users` 
    ON `intermediary_authors-to-projects`.`user_id` = `table_users`.`user_id`';
    $query = $db->prepare($sql);
    $query->execute();
    $authors = $query->fetchAll(PDO::FETCH_ASSOC);
    // print_r($authors);

    require_once('db_close.php'); // Closing database access

    if (!$project) {
        $_SESSION['message'] = 'This ID doesn\'t exist.';
        header('Location: view-front_home.php'); 
    }


} else {

    $_SESSION['message'] = 'URL is not valid...';
    header('Location: view-front_home.php'); 

}

?>

<h1> <?= $project['project_title'] ?> </h1>
<h2> 
    <?php
            foreach($authors as $author){
                if ($author['project_id'] ==  $project_id ) {
                    echo $author['user_username'];
                }
            }
    ?>
</h2>
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
    <img src="<?=$project['project_thumbnail']?>" alt="The thumbnail of the project <?=$project['project_title']?>.">
</figure>
<p><?=$project['project_description']?></p>
<div><a href="view-front_home.php"><button>Back</button></a></div>
<?php 
    if(!empty($_SESSION['username'])){
        echo '<div><a href="view-backoffice_home.php"><button>Back-office</button></a></div>';
    } else {

    }
?>

<?php include 'include_footer.php'; ?>