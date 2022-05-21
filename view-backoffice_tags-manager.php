<?php 

    include 'include_header.php';

    if($_SESSION['username']){
        echo 'User:' . $_SESSION['username'] ;
        
        require_once('db_connect.php');
        $sql = 'SELECT * FROM `table_tags`';
        $query = $db->prepare($sql);
        $query->execute();
        $tags = $query->fetchAll(PDO::FETCH_ASSOC);
        require_once('db_close.php'); // Closing database access

        foreach($tags as $tag){
            echo '<div><button>'.$tag['tag_name'].'</button>: <a href="handler-tag_delete.php?tag_id=' .$tag['tag_id'].'">Delete</a></div>' ;
        } 

    } else {

        $_SESSION['message'] = 'You are not connected! Please log in!';
        header('Location: form-user_login.php'); 

    }

    ?>
    <p>
        <a href="form-tag_add.php"><button>Add Tag</button></a>
        <a href="view-backoffice_home.php"><button>Back</button></a>
    </p>
    

<?php include 'include_footer.php'; ?>