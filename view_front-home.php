<?php 
session_start();
    require_once('db_connection.php');
    $sql = 'SELECT * FROM `table_projects`';
    $query = $db->prepare($sql);
    $query->execute();
    $projects = $query->fetchAll(PDO::FETCH_ASSOC);
    require_once('db_close.php'); // Closing database access
    if(!empty($_SESSION['error'])){
        echo '<div>'.$_SESSION['error'].'</div>';
        $_SESSION['error'] = ''; // Cleaning the superglobal variable
    }
?>

<?php include 'include_header.php' ?>

    <?php foreach($projects as $project){ ?>
       <a href="view_front-single.php?project_id=<?= $project['project_id'] ?>"><?= $project['project_title'] ?></a>
       <br>
    <?php } ?>

    <div><a href="index.php"><button>Back</button></a></div>

<?php include 'include_footer.php' ?>