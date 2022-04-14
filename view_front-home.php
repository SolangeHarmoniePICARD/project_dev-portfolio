<?php 
    require_once('db_connection.php');
    $sql = 'SELECT * FROM `table_projects`';
    $query = $db->prepare($sql);
    $query->execute();
    $projects = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'include_header.php' ?>

    <?php foreach($projects as $project){ ?>
       <a href="view_front-single.php?project_id=<?= $project['project_id'] ?>"><?= $project['project_title'] ?></a>
       <br>
    <?php } ?>

<?php include 'include_footer.php' ?>