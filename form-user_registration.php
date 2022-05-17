<?php include 'include_header.php'; ?>

    <form action="handler-user_registration.php" method="post">
        <div>
            <label for="input_username" class="">Username:</label>
            <input type="text" id="input_username" name="data_username" required minlength="3" title="Must contain at least 3 or more characters.">
        </div>
        <div>
            <label for="input_email" class="">Email:</label>
            <input type="email" id="input_email" name="data_email" required>
        </div>
        <div>
            <label for="input_password" class="">Password:</label>
            <input type="password" id="input_password" name="data_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.">
            <input type="checkbox" id="input_show-password"> <span>Show Password</span> 
        </div>
        <div>
            <label for="input_pswd-confirmation" class="">Confirm Password:</label>
            <input type="password"  id="input_pswd-confirmation" name="data_pswd-confirmation" required>
            <input type="checkbox" id="input_show-confirmation"> <span>Show Confirmation</span> 
        </div>
        <div>
            <label for="input_captcha-checker">Captcha:</label>
            <input type="text" id="input_captcha-checker" name="data_captcha-checker" maxlength="5" autocomplete="off" required> &nbsp; <img src="include_captcha-generator.php" alt="captcha">
        </div>
        <div>
        <div>
            <input type="submit" id="form_submit" value="Sign up">
            <input type="reset" value="Reset">
        </div>
    </form>

    <div>
        <a href="index.php">
            Back
        </a>
    </div>

    <script src="form-user_show-password.js"></script>

<?php include 'include_footer.php'; ?>