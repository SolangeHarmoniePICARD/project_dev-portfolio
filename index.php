<?php

    require_once('db_connect.php');

    $sql = 'SELECT * FROM `table_users`';
    $query = $db->prepare($sql);
    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($users);
    
    include 'include_header.php'; 
    
?>

<div>
    <a href="view-front_home.php"><button>Visit Site</button></a>
    <?php 
    if(!empty($_SESSION['username'])){
        echo '<a href="view-backoffice_home.php"><button>Back-office</button></a>';
    }
?>
    <a href="form-contact_send-mail.php"><button>Contact</button></a>
</div>

<div>
    <?php 
        if (!$users) {
            echo '<a href="form-user_registration.php"><button>Sign up</button></a>';
        } else if(!isset($_SESSION['username'])){
            echo '<a href="form-user_login.php"><button>Log in</button></a>';
        } 
    ?>
</div>

<?php include 'include_footer.php'; ?>