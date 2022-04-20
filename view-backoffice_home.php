<?php include 'include_header.php';
if($_SESSION['username']){
    require_once('db_connect.php');
    $sql = 'SELECT *, GROUP_CONCAT(`tag_name`) AS `tag_results`
    FROM `table_projects` 
    JOIN `intermediary_tags-to-projects` 
    ON `table_projects`.`project_id` = `intermediary_tags-to-projects`.`project_id` 
    JOIN `table_tags` 
    ON `intermediary_tags-to-projects`.`tag_id` = `table_tags`.`tag_id` 
    GROUP BY `table_projects`.`project_id`';
    $query = $db->prepare($sql);
    $query->execute();
    $projects = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM `table_projects` 
    JOIN `intermediary_tags-to-projects` 
    ON `table_projects`.`project_id` = `intermediary_tags-to-projects`.`project_id` JOIN `table_tags` 
    ON `intermediary_tags-to-projects`.`tag_id` = `table_tags`.`tag_id` 
    GROUP BY `table_tags`.`tag_id`';
    $query = $db->prepare($sql);
    $query->execute();
    $tags = $query->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = 'SELECT * FROM `table_projects` 
    JOIN `intermediary_tags-to-projects` 
    ON `table_projects`.`project_id` = `intermediary_tags-to-projects`.`project_id` JOIN `table_tags` 
    ON `intermediary_tags-to-projects`.`tag_id` = `table_tags`.`tag_id`';
    $query = $db->prepare($sql);
    $query->execute();
    $intermediary_tags = $query->fetchAll(PDO::FETCH_ASSOC);
    require_once('db_close.php'); // Closing database access
}
?>

<?php foreach($projects as $project){ ?>
<p>
    <div>
       <strong>Project «&nbsp;</span> <?= $project['project_title'] ?>&nbsp;»</strong>
    </div>
    <div>
        <?php
        foreach($intermediary_tags as $intermediary_tag){
            if ($intermediary_tag['project_id'] == $project['project_id']) {
                echo '<button>'.$intermediary_tag['tag_name'].'</button>&nbsp;' ;
            } 
        }
        ?>
    </div>
    <div>
    <a href="form-project_edit.php?project_id=<?= $project['project_id'] ?>">Edit</a> || <a href="handler-project_delete.php?project_id=<?= $project['project_id'] ?>">Delete</a> || <a href="handler-project_status.php?project_id=<?= $project['project_id'] ?>">
        <?php 
        if($project['project_status'] == 0){
            echo 'Show' ;
        } else {
            echo 'Hide' ;
        }
        ?>
    </a>
    </div>
</p>
<?php } ?>
<p>
    <form action="handler-tag_filter.php" method="post">
        <div>
        <input type="submit" value="Search"> &nbsp;
            <?php foreach($tags as $tag){ ?>
                <input type="checkbox" value="<?= $tag['tag_id'] ?>" id="input_<?= $tag['tag_name'] ?>" name="data_<?= $tag['tag_name'] ?>"> <label for="input_<?= $tag['tag_name'] ?>"><?= $tag['tag_name'] ?></label>
            <?php } ?>
        </div>
    </form>
</p>
<p>
    <a href="form-project_add.php"><button>Add project</button></a>
    <a href="view-backoffice_tags-manager.php"><button>Tags Manager</button></a>
    <a href="view-front_home.php"><button>Visit Site</button></a>
</p>
<p>
    <a href="handler-user_disconnect.php"><button>Log out</button></a>
</p>
<?php include 'include_footer.php'; ?>