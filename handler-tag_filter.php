<?php 

include 'include_header.php';

if($_SESSION['username']){

    echo 'User:' . $_SESSION['username'] ;

    $tagNames = array_keys($_POST); 
    $tagParams = array_map(function ($tagName) {    
        return "`tag_ids` LIKE :$tagName";    
    }, $tagNames);
    $inParams = implode(' AND ', $tagParams);

    require_once('db_connect.php');

    $sql = 'SELECT * FROM `table_tags`';
    $query = $db->prepare($sql);
    $query->execute();
    $tags = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($_POST) {
            $sql = "SELECT *, GROUP_CONCAT(`tag_name` SEPARATOR ' ') AS `tag_results` , GROUP_CONCAT(CONCAT('#', table_tags.tag_id, '#')) AS `tag_ids` 
            FROM `table_projects` 
            JOIN `intermediary_tags-to-projects` 
            ON `table_projects`.`project_id` = `intermediary_tags-to-projects`.`project_id` 
            JOIN `table_tags` ON `intermediary_tags-to-projects`.`tag_id` = `table_tags`.`tag_id` 
            GROUP BY `table_projects`.`project_id`
            HAVING" . $inParams ;
            $query = $db->prepare($sql);    
            foreach($_POST as $tagName => $tagId) {    
                $query->bindValue(":$tagName", "%#".$tagId."#%", PDO::PARAM_STR);    
            }    
            $query->execute();
            $projects = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        if (count($projects) == null) {
            $_SESSION['message'] = "No result: add tags & create new projects... ";
            header('Location: view-backoffice_home.php') ;
        } else {
            foreach($projects as $project){
                echo '<div>Project «&nbsp;'.$project['project_title'].'&nbsp;»:&nbsp;'.$project['tag_results'] ;
            }
        }   

} else {

    $_SESSION['message'] = 'You are not connected! Please log in!';
    header('Location: form-user_login.php'); 

}


 

    
    require_once('db_close.php'); // Closing database access
?>

<p><a href="view-backoffice_home.php"><button>Back</button></a></p>

<?php include 'include_footer.php'; ?>

