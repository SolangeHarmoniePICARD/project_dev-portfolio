<?php include 'include_header.php'; ?>

    <form action="handler-user_login.php" method="post">
        <div>
            <label for="input_username">Username: </label>
            <input type="text" class="form-fields" id="input_username" name="data_username" spellcheck="false" required>
        </div>
        <div>
            <label for="input_password">Password: </label>
            <input type="password" class="form-fields" id="input_password" name="data_password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <input type="checkbox" id="input_show-password"> <span>Show Password</span> <span id="warning_capsLock">WARNING! Caps lock is ON.</span> 
        </div>
        <div>
            <input type="submit" id="form_submit" value="Log in">
        </div>
    </form>
    
    <div>
        <a href="index.php">
            <button>Back</button>
        </a>
        <a href="form-user_send-link.php">
            <button>Forgot password?</button>
        </a>
    </div>

    <script src="form-user_password-visibility.js"></script>
    <script src="form-user_detect-capslock.js"></script>

<?php include 'include_footer.php'; ?>