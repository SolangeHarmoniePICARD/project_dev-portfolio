<?php include 'include_header.php';
    require_once('db_connection.php');
    $sql = 'SELECT * FROM `table_projects`';
    $query = $db->prepare($sql);
    $query->execute();
    $projects = $query->fetchAll(PDO::FETCH_ASSOC);
    require_once('db_close.php'); // Closing database access
?>

<?php foreach($projects as $project){ ?>
    <?php 
        if($project['project_status'] == 1){
            echo '<a href="view_front-single.php?project_id='. $project['project_id'] .'">'.'Project «&nbsp;'.$project['project_title'].'&nbsp;»</a>' ;
        } else {
            echo 'Project «&nbsp;'.$project['project_title'].'&nbsp;»: Currently, this project is private... come back later!';
        }
        ?>
    <br>
<?php } ?>

<div><a href="index.php"><button>Back</button></a></div>

<?php include 'include_footer.php'; ?>
