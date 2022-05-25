<?php include 'include_header.php'; ?>
    <div>
        <form name="" id="" method="post" action="handler-contact_send-mail.php" enctype="multipart/form-data" onsubmit="return validateContactForm()">
            <div>
                <label for="input_username">Name</label>
                <input type="text" name="data_username" id="input_username">
            </div>
            <div>
                <label for="input_email">Email</label>
                <input type="text" name="data_email" id="input_email">
            </div>
            <div>
                <label for="input_subject">Subject</label> 
                <input type="text" name="data_subject" id="input_subject" />
            </div>
            <div>
                <label for="input_message">Message</label> 
                <textarea name="data_message" id="input_message"></textarea>
            </div>
            <div>
                <input type="submit" name="data_send" value="Send">
            </div>
        </form>
        <div><a href="index.php"><button>Back</button></a></div>
    </div>

<?php include 'include_footer.php'; ?>