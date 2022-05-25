<?php

    require_once('db_connect.php');

    $sql = 'SELECT * FROM `table_projects`';
    $query = $db->prepare($sql);
    $query->execute();
    $projects = $query->fetchAll(PDO::FETCH_ASSOC);

    require_once('db_close.php'); // Closing database access

?>

<?php include 'include_header.php'; ?>

<?php foreach($projects as $project){ ?>
    <?php 
        if($project['project_status'] == 1){
            echo '<a href="view-front_single.php?project_id='. $project['project_id'] .'">'.'Project «&nbsp;'.$project['project_title'].'&nbsp;»</a>' ;
        } else {
            echo 'Project «&nbsp;'.$project['project_title'].'&nbsp;»: Currently, this project is private... come back later!';
        }
        ?>
    <br>
<?php } ?>

<div><a href="index.php"><button>Home</button></a></div>
<?php 
    if(!empty($_SESSION['username'])){
        echo '<div><a href="view-backoffice_home.php"><button>Back-office</button></a></div>';
    } else {

    }
?>

<?php include 'include_footer.php'; ?>
