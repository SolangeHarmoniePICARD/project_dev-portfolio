<?php
    $project_id = strip_tags($_POST['project_id']);
            // Data insertion into the database
            require_once('db_connect.php');

            $sql = 'SELECT * FROM `table_tags`';
            $query = $db->prepare($sql);
            $query->execute();
            $tags = $query->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($tags as $tag){
                $tag_id_.$tag['tag_name'] = strip_tags($_POST['data_'.$tag['tag_name']]) ;
                if ($project_tag_.$tag['tag_name']) {
                    $tag_id = $tag['tag_id'];
                    // echo $tag_id;
                    // Data insertion into the intermediary_tags-to-projects table
                    $sql = 'UPDATE `intermediary_tags-to-projects` SET `tag_id`=:tag_id WHERE `project_id`=:project_id';
                    $query = $db->prepare($sql);
                    $query->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
                    $query->execute();
                }
            }

            require_once('db_close.php'); // Closing database access