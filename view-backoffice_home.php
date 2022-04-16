<?php include 'include_header.php';
if($_SESSION['username']){
    require_once('db_connect.php');
    $sql = 'SELECT * FROM `table_projects`';
    $query = $db->prepare($sql);
    $query->execute();
    $projects = $query->fetchAll(PDO::FETCH_ASSOC);
    require_once('db_close.php'); // Closing database access
}
?>
<?php foreach($projects as $project){ ?>
    <div>
       <span>Project «&nbsp;</span> <?= $project['project_title'] ?>&nbsp;» :</span> <a href="form-project_edit.php?project_id=<?= $project['project_id'] ?>">Edit</a> || <a href="handler-project_delete.php?project_id=<?= $project['project_id'] ?>">Delete</a> || <a href="handler-project_status.php?project_id=<?= $project['project_id'] ?>">
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
    <a href="form-project_add.php"><button>Add project</button></a>
    <a href="view-front_home.php"><button>Visit Site</button></a>
</div>
<div>
    <a href="handler-user_disconnect.php"><button>Log out</button></a>
</div>
<?php include 'include_footer.php'; ?>