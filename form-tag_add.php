<?php 

    include 'include_header.php';

    if($_SESSION['username']){
        echo 'User:' . $_SESSION['username'] ;
    } else {
        $_SESSION['message'] = 'You are not connected! Please log in!';
        header('Location: form-user_login.php'); 
    }
    
?>

<form action="handler-tag_add.php" method="post">
    <div>
        <label for="input_tag-name">Tag Name:</label>
        <input type="text" id="input_tag-name" name="data_tag-name" required>
    </div>
    <div >
        <input type="submit" value="Add a new tag">
    </div>
</form>
<div>
    <a href="index.php">
        <button>Back</button>
    </a>
</div>

<?php

    include 'include_footer.php'; 
    
?>