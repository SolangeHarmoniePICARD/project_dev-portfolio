<?php 

    include 'include_header.php';   
    
    if($_SESSION['username']){

        echo 'User: ' . $_SESSION['username'] ;

        require_once('db_connect.php');
        // Checking existence of the id sent by url
        $sql = 'SELECT * FROM `table_tags`';
        $query = $db->prepare($sql);
        $query->execute();
        $tags = $query->fetchAll(PDO::FETCH_ASSOC);
        require_once('db_close.php'); // Closing database access
        // var_dump($tags) ;
        
        if(empty($tags)){
            $_SESSION['message'] = 'Impossible to add a new project: you have to create tags first.';
            header('Location: view-backoffice_home.php');      
        }

    } else {

        $_SESSION['message'] = 'You are not connected! Please log in!';
        header('Location: form-user_login.php'); 
        
    }
    
?>

<form id="form_project-edit" action="handler-project_add.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="input_title">Title: </label>
        <input type="text" id="input_title" name="data_title" required>
    </p>
    <p>
        <label for="input_project-tag">Tags: </label>
        <?php foreach($tags as $tag){ ?>
            <input type="checkbox" value="<?= $tag['tag_id'] ?>" id="input_<?= $tag['tag_name'] ?>" name="data_<?= $tag['tag_name'] ?>"> <label for="input_<?= $tag['tag_name'] ?>"><?= $tag['tag_name'] ?></label>
        <?php } ?>
    </p>
    <p>
        <label for="input_thumbnail">Thumbnail: </label>
        <input type="file" id="input_thumbnail" name="data_thumbnail" required>
    </p>
    <p>
        <label for="input_description">Description: </label>
        <textarea id="input_description" rows="8" name="data_description" required></textarea>
    </p>
    <p >
        <input type="hidden" value='0' name="data_status" id="input_status">
        <input type="submit" value="Add Project" name="data_submit"  id="input_submit">
    </p>
</form>
<p>
    <a href="view-backoffice_home.php">
        <button>Back</button>
    </a>
</p>

<script src="form-project_checkbox-checked.js"></script>

<?php include 'include_footer.php'; ?>