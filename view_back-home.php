<?php
    session_start();
    if($_SESSION['username']){
        if(!empty($_SESSION['success'])){
            echo '<div>'.$_SESSION['success'].'</div>';
            $_SESSION['success'] = ''; // Cleaning the superglobal variable
            require_once('db_connection.php');
            $sql = 'SELECT * FROM `table_projects`';
            $query = $db->prepare($sql);
            $query->execute();
            $projects = $query->fetchAll(PDO::FETCH_ASSOC);
            require_once('db_close.php'); // Closing database access
        }
    // If bad authentification
    } else if(!empty($_SESSION['error'])) {
        echo '<div>'.$_SESSION['error'].'</div>';
        $_SESSION['error'] = ''; // Cleaning the superglobal variable
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