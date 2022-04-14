<?php
session_start();
if($_SESSION['username']){
    require_once('db_connection.php');
    $sql = 'SELECT * FROM `table_projects`';
    $query = $db->prepare($sql);
    $query->execute();
    $projects = $query->fetchAll(PDO::FETCH_ASSOC);
// If bad authentification
} else {
    echo "Username or password are incorrect. ";
}
?>

<?php include 'include_header.php' ?>

<div>
    <?php foreach($projects as $project){ ?>
        <div>
            <?= $project['project_title'] ?> : <a href="form_project-edit.php?project_id=<?= $project['project_id'] ?>">Edit</a> || <a href="handler_project-delete.php?project_id=<?= $project['project_id'] ?>">Delete</a>
        </div>
    <?php } ?>
</div>

<div>
    <a href="form_project-add.php">
        <button>Add project</button>
    </a>
</div>
<div>
    <a href="handler_user-disconnect.php">
        <button>Log out</button>
    </a>
</div>


<?php include 'include_footer.php' ?>