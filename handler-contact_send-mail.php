<?php session_start();

if(!empty($_POST["data_send"])) {

	$contact_username = strip_tags($_POST["data_username"]);
	$contact_email = strip_tags($_POST["data_email"]);
	$contact_subject = strip_tags($_POST["data_subject"]);
	$contact_message = strip_tags($_POST["data_message"]);

	require_once('db_connect.php');
	$sql = 'INSERT INTO `table_contacts` (`contact_username`, `contact_email`, `contact_subject`, `contact_message`) VALUES (:contact_username, :contact_email, :contact_subject, :contact_message)';
	$query = $db->prepare($sql);
	$query->bindValue(':contact_username', $contact_username, PDO::PARAM_STR);
	$query->bindValue(':contact_email', $contact_email, PDO::PARAM_STR);
	$query->bindValue(':contact_subject', $contact_subject, PDO::PARAM_STR);
	$query->bindValue(':contact_message', $contact_message, PDO::PARAM_STR);
	$query->execute();
	require_once('db_close.php');

	$mail_recipient  = "bdebot-dev@outlook.com";
	$mail_headers = "From: " . $contact_username . "<". $contact_email .">\r\n";
	if(mail($mail_recipient, $contact_subject, $contact_message, $mail_headers)) {
	    $_SESSION['success'] = "Your contact information is send and saved successfully.";
	} else {
		$_SESSION['error'] = "There is a problem.";
	}

	header('Location: index.php');
} else {
	$_SESSION['error'] = "There is a problem.";
}

