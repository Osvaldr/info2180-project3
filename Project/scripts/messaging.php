<?php
	session_start();
	include('connecting.php');
	
	// defining the variables and set they were set to empty values
		$id = $subject = $body = $recipient_ids = "";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$id=$_SESSION['SESS_USERID'];
			$subject=$_POST['subject'];
			$body=$_POST['body'];
			
			$auser = $_POST['uname'];
			$recipient_ids=(mysql_query("SELECT id FROM user where username = '$auser'"));
			//$recipient_ids=$_POST['recipients_id'];	
			
			$m_id=mysql_query("SELECT MAX(message_id) FROM message_read");
			date_default_timezone_set("America/Jamaica");
			$currentdate = date("Y-m-d h:i:sa");
			//$currentdate=mysql_query("SELECT NOW()");
			
			mysql_query("INSERT INTO Messages (body, subject, recipients_id, users_id, date_sent)VALUES('$body', '$subject', '$recipient_ids', '$id', '$currentdate')");
			mysql_query("INSERT INTO Messages_read (message_id, readers_id, the_date)VALUES('$m_id', '$recipient_ids', '$currentdate')");
			
			header("Location: Homepage.php");
			
		}
?>