<?php session_start(); ?>

<?php include 'include_header.php' ?>

<?php
    if(!empty($_SESSION['success'])){
        echo '<div>'.$_SESSION['success'].'</div>';
        $_SESSION['error'] = ''; // Cleaning the superglobal variable
    }
?>

<div>
    <a href="view_front-home.php">
        <button>Visit Site</button>
    </a>
</div>

<div>
    <a href="form_user-login.php">
        <button>Log in</button>
    </a>
    <a href="form_user-registration.php">
        <button>Sign up</button>
    </a>
</div>

<?php include 'include_footer.php' ?>