<?php include 'include_header.php';
if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
    require_once('db_connect.php');
    $project_id = strip_tags($_GET['project_id']);
    // Checking existence of the id sent by url
    $sql = 'SELECT * FROM `table_projects` WHERE `project_id` = :project_id';
    $query = $db->prepare($sql);
    $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();
    require_once('db_close.php'); // Closing database access
    if (!$result) {
        $_SESSION['error'] = 'This ID doesn\'t exist.';
        header('Location: view-front_home.php'); 
    }
//If there is no id
} else {
    $_SESSION['error'] = 'URL is not valid...';
    header('Location: view-front_home.php'); 
}
?>
<h1><?=$result['project_title']?> </h1>
<img src="<?=$result['project_thumbnail']?>" alt="The thumbnail of the project <?=$result['project_title']?>.">
<p><?=$result['project_description']?></p>
<div><a href="view-front_home.php"><button>Back</button></a></div>
<?php include 'include_footer.php'; ?>