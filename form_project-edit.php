<?php

if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
    require_once('db_connection.php');
    $project_id = strip_tags($_GET['project_id']);

     // Checking existence of the id sent by url (method GET)
     $sql = 'SELECT * FROM `table_projects` WHERE `project_id` = :project_id;';
     $query = $db->prepare($sql);
     $query->bindValue(':project_id', $project_id, PDO::PARAM_INT);
     $query->execute();
     $result = $query->fetch();

     if ($result) {
        echo '<div>Ok, you can edit this project.</div>';
    } else {
        echo '<div>This ID doesn\'t exist.</div>';
        echo '<div><a href="index.php"><button>Back</button></a></div>';
    }

//If the form fields are empty   
} else {
    echo '<div>URL is not valid...</div>'; 
    echo '<div><a href="index.php"><button>Back</button></a></div>';
}

?>

<?php include 'include_header.php' ?>

<form action="handler_project-edit.php" method="post">
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

<?php include 'include_footer.php' ?>