<?php include 'include_header.php';
if($_SESSION['username']){
    require_once('db_connection.php');
    $sql = 'SELECT * FROM `table_projects`';
    $query = $db->prepare($sql);
    $query->execute();
    $projects = $query->fetchAll(PDO::FETCH_ASSOC);
    require_once('db_close.php'); // Closing database access
}
?>
<?php foreach($projects as $project){ ?>
    <div>
       <span>Project «&nbsp;</span> <?= $project['project_title'] ?>&nbsp;» :</span> <a href="form_project-edit.php?project_id=<?= $project['project_id'] ?>">Edit</a> || <a href="handler_project-delete.php?project_id=<?= $project['project_id'] ?>">Delete</a> || <a href="handler_project-status.php?project_id=<?= $project['project_id'] ?>">
        <?php 
        if($project['project_status'] == 0){
            echo 'Show' ;
        } else {
            echo 'Hide' ;
        }
        ?>
        </a>
    </div>
<?php } ?>
<div>
    <a href="form_project-add.php"><button>Add project</button></a>
</div>
<div>
    <a href="handler_user-disconnect.php"><button>Log out</button></a>
</div>
<?php include 'include_footer.php'; ?>