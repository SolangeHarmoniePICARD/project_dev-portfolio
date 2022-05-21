<?php include 'include_header.php'; ?>

<form action="handler-user_send-link.php" method="post">
        <div>
            <label for="input_email">Your email: </label>
            <input type="text" id="input_email" name="data_email" required>
        </div>
        <div>
            <input type="submit" id="form_submit" value="Send link">
        </div>
    </form>

    <div>
        <a href="index.php">
            <button>Back</button>
        </a>
    </div>


<?php include 'include_footer.php'; ?>