<?php include 'include_header.php';

    $tagNames = array_keys($_POST); 
    $tagParams = array_map(function ($tagName) {    
        return "`tag_ids` LIKE :$tagName";    
    }, $tagNames);
    $inParams = implode(' AND ', $tagParams);

    require_once('db_connect.php');
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
    if (count($projects) == 0) {
        echo 'No result.' ;
    } else {
        foreach($projects as $project){
            echo '<div>Project «&nbsp;'.$project['project_title'].'&nbsp;»:&nbsp;'.$project['tag_results'] ;
        }
    }
    require_once('db_close.php'); // Closing database access
?>

<p><a href="view-backoffice_home.php"><button>Back</button></a></p>

<?php include 'include_footer.php'; ?>