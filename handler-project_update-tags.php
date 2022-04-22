<?php
    $project_id = strip_tags($_POST['project_id']);

    foreach ($_POST['tag_name'] as $value) {
        echo $value ;
    }

            // require_once('db_connect.php');

            // $sql = 'SELECT * FROM `table_tags`';
            // $query = $db->prepare($sql);
            // $query->execute();
            // $tags = $query->fetchAll(PDO::FETCH_ASSOC);

            // print_r($tags ) ;
            // echo '<br><br>' ;
            
            // foreach($tags as $tag){
            //     $tag_id_.$tag['tag_name'] = strip_tags($_POST['data_'.$tag['tag_name']]) ;
            //     if ($project_tag_.$tag['tag_name']) {
            //         $tag_id = $tag['tag_id'];
            //         echo $tag_id . '<br>';
            //         echo $project_tag_.$tag['tag_name'] . '<br><br>';  
            //         $sql = 'UPDATE `intermediary_tags-to-projects` SET `tag_id`=:tag_id WHERE `project_id`=:project_id';
            //         $query = $db->prepare($sql);
            //         $query->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
            //         $query->execute();
            //     }
            // }

            // require_once('db_close.php');


// pas d'update
// au moment de l'édition des tags sur un projet, deux étapes :
// 1ère étape : suppression de tous les tags associés à un projet dans la table intermédiaire
// 2ème étape : insert de tous les nouveaux tags 