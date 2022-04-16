<?php include 'include_header.php'; 
if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
    $project_id = strip_tags($_GET['project_id']);
    require_once('db_connect.php');
    // Checking existence of the id sent by url
    $sql = 'SELECT * FROM `table_projects` WHERE `project_id` = :project_id';
    $query = $db->prepare($sql);
    $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();
    require_once('db_close.php'); // Closing database access
    // var_dump($result) ;
    // echo $result['project_id'];
    if ($result['project_id'] != $project_id) {
        $_SESSION['error'] = 'This ID doesn\'t exist.';
        header('Location: view-backoffice_home.php');
    } else if ($result) {
        echo '<div>Ok, you can edit this project.</div>';
    }
//If there is no id
} else {
    $_SESSION['error'] = 'URL is not valid...';
    header('Location: view-backoffice_home.php'); 
} 
?>

<figure>
    <img src="<?= $result['project_thumbnail'] ?>" alt="Thumbnail of the project <?= $result['project_title'] ?>">
</figure>

<form action="handler-project_update-thumbnail.php" method="post" enctype="multipart/form-data">
    <div>Select new image to upload:</div>
    <div>
        <input type="hidden" name="project_id" value='<?= $result['project_id'] ?>'>
        <input type="file" name="data_thumbnail" id="input_thumbnail">
        <input type="submit" value="Update Image" name="data_submit"  id="input_submit">
    </div>
</form>

<form action="handler-project_edit.php" method="post">
    <input type="hidden" name="project_id" value='<?= $result['project_id'] ?>'>
    <div>
        <label for="input_title">Title: </label>
        <input type="text" id="input_title" name="data_title" value="<?=$result['project_title']?>">
    </div>
    <div>
        <label for="input_description">Description: </label>
        <textarea id="input_description" rows="8" name="data_description"><?=$result['project_description']?></textarea>
    </div>
    <div>
        <input type="submit" id="form_submit" value="Edit Project">
        <input type="reset" value="Reset">
    </div>
</form>
<div>
    <a href="view-backoffice_home.php">
        <button>Back</button>
    </a>
</div>

<?php include 'include_footer.php'; ?>