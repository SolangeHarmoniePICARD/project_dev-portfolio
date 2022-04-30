<?php include 'include_header.php'; 
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
    
    require_once('db_close.php'); // Closing database access
    // var_dump($project) ;
    // echo $project['project_id'];
    if ($project['project_id'] != $project_id) {
        $_SESSION['message'] = 'This ID doesn\'t exist.';
        header('Location: view-backoffice_home.php');
    } else if ($project) {
        echo '<div>Ok, you can edit this project.</div>';
    }
//If there is no id
} else {
    $_SESSION['message'] = 'URL is not valid...';
    header('Location: view-backoffice_home.php'); 
} 
?>

<figure>
    <img src="<?= $project['project_thumbnail'] ?>" alt="Thumbnail of the project <?= $project['project_title'] ?>">
</figure>

<form action="handler-project_update-thumbnail.php" method="post" enctype="multipart/form-data">
    <div>Select new image to upload:</div>
    <div>
        <input type="hidden" name="project_id" value='<?= $project['project_id'] ?>'>
        <input type="file" name="data_thumbnail" id="input_thumbnail">
        <input type="submit" value="Update Image" name="data_submit"  id="input_submit">
    </div>
</form>

<p> 
    <span>Tag(s) :</span>
    <form action="handler-project_update-tags.php" method="post">
        <input type="hidden" name="project_id" value='<?= $project['project_id'] ?>'>
        <input type="submit" value="Change Tags"> &nbsp;
        <?php     
            $tags_id_array = array();
            foreach($intermediary_tags as $intermediary_tag){
                if ($intermediary_tag['project_id'] == $project['project_id']) {   
                    array_push($tags_id_array, $intermediary_tag['tag_id'] );
                    echo '<input type="checkbox" checked value="'.$intermediary_tag['tag_id'].'" id="input_'.$intermediary_tag['tag_name'].'" name="data_'.$intermediary_tag['tag_name'].'"> <label for="input_'.$intermediary_tag['tag_name'].'">'. $intermediary_tag['tag_name'] .'</label>'  ;
                } 
            }
            //print_r($tag_id_array);   
            foreach($tags as $tag){  
                if (!in_array($tag['tag_id'], $tags_id_array)) {
                    echo '<input type="checkbox" value="'.$tag['tag_id'].'" id="input_'.$tag['tag_name'].'" name="data_'.$tag['tag_name'].'"> <label for="input_'.$tag['tag_name'].'">'. $tag['tag_name'] .'</label>'  ;
                } 
            }
            // print_r($tags);
        ?>
    </form>
</p>


<form action="handler-project_edit.php" method="post">
    <input type="hidden" name="project_id" value='<?= $project['project_id'] ?>'>
    <div>
        <label for="input_title">Title: </label>
        <input type="text" id="input_title" name="data_title" value="<?=$project['project_title']?>">
    </div>
    <div>
        <label for="input_description">Description: </label>
        <textarea id="input_description" rows="8" name="data_description"><?=$project['project_description']?></textarea>
    </div>
    <div>
        <input type="submit" id="form_submit" value="Edit Project">
        <input type="reset" value="Reset">
    </div>
</form>

<p>
    <a href="view-backoffice_home.php">
        <button>Back</button>
    </a>
</p>

<?php include 'include_footer.php'; ?>
