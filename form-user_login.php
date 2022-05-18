<?php include 'include_header.php'; ?>

    <form action="handler-user_login.php" method="post">
        <div>
            <label for="input_username">Username: </label>
            <input type="text" class="form-fields" id="input_username" name="data_username" required>
        </div>
        <div>
            <label for="input_password">Password: </label>
            <input type="password" class="form-fields" id="input_password" name="data_password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <input type="checkbox" id="input_show-password"> <span>Show Password</span> 
        </div>
        <div>
            <input type="submit" id="form_submit" value="Log in">
            <input type="reset" value="Reset">
        </div>
    </form>
    
    <div id="message-validation">
        <h3>Password must contain the following:</h3>
        <p id="verify-letter" class="invalid-fields">A <b>lowercase</b> letter</p>
        <p id="verify-capital" class="invalid-fields">A <b>capital (uppercase)</b> letter</p>
        <p id="verify-number" class="invalid-fields">A <b>number</b></p>
        <p id="verify-length" class="invalid-fields">Minimum <b>8 characters</b></p>
    </div>

    <div>
        <a href="index.php">
            <button>Back</button>
        </a>
    </div>

    <script src="form-user_password-visibility.js"></script>

<?php include 'include_footer.php'; ?>