<?php include 'include_header.php' ?>

    <form action="handler_user-login.php" method="post">
        <div>
            <label for="input_username">Username: </label>
            <input type="text" class="" id="input_username" name="data_username" required>
        </div>
        <div>
            <label for="input_password">Password: </label>
            <input type="password" class="" id="input_password" name="data_password" required>
        </div>
        <div>
            <input type="submit" id="form_submit" value="Log in">
            <input type="reset" value="Reset">
        </div>
    </form>

    <div>
        <a href="index.php">
            <button>Back</button>
        </a>
    </div>

<?php include 'include_footer.php' ?>