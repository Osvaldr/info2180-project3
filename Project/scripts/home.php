<?php
	
	session_start();
	
	if( ( (!isset($_SESSION['SESS_USERID'])) || (trim($_SESSION['SESS_USERID']) == '')) && ( (!isset($_SESSION['SESS_UNAME'])) || (trim($_SESSION['SESS_UNAME']) == '') )) {
		header("location: login.html");
		exit();
	};
	
		require_once('connecting.php');
		$id=$_SESSION['SESS_USERID'];
		$result3 = mysql_query("SELECT * FROM user where id='$id'");
		$result4 = mysql_query("SELECT * FROM message where users_id='$id'");
		$result5 = mysql_query("SELECT * FROM message_read where readers_id='$id'");
		
		while($row3 = mysql_fetch_array($result3))
		{ 
			$fname=$row3['firstname'];
			$lname=$row3['lastname'];
			$uname=$row3['username'];
		}
		//	$allmessages = mysql_num_rows('$result4');
		//	$allmessage_reads = mysql_num_rows('$result5');
				
		
?>


<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="styles/homepage.css"/>
	<script src = "scripts/homepage.js" type = "text/javascript"></script>
</head>
<body>
	<div id = "header">
		<h1> Home Page </h1> <a href="logout.php" style="float:right;"><button >Log Out</button></a>
		<br></br><br></br>
        <h3>WELCOME BACK</h3>
        <span><?= $uname; ?> </span>
     </div>
	
	
	<div id="inbox-outbox" >
		<form name = "email" method = "post" action="messaging.php">
		<fieldset>
			
			<div id="inbox" style="float:left" >
			<h2>Inbox</h2>
				<?php	
				$sql="SELECT body,subject,users_id FROM message where recipients_id=$id";
				$result= mysql_query($sql) or die(mysql_error());
					
					echo '<body bgcolor="skyblue"> <center>';
					echo'<table 	style="border: 5px solid red;">','<tr>','<th> Sender</th>','<th> Subject </th>','<th> Message</th>','</tr>';
				
					while($row3=mysql_fetch_array($result)){	
					$user_id=$row3['users_id'];
					$subject=$row3['subject'];
					$body=$row3['body'];
					
					$sql_again="SELECT username FROM user where id = '$user_id'";
					$result_again = mysql_query($sql_again) or die(mysql_error);
						while($row_again = mysql_fetch_array($result_again))
						{
							$auname = $row_again['username'];
						}
						
					echo '<tr>','<td>'.$auname.'</td>','<td>'.$subject.'</td>','<td>'.$body.'</td>','</tr>';
					}
						echo '</table>','<br>';
				?>
			</div>
			
			<div style="clear:both;"></div>
			<div id="compose" name="send"  >
			<h2>Send Message</h2>
				
				<label>Enter Username of recipient:<input type="text" size = "50" name="uname"  placeholder="Must be a cheapomail user, nuh stranger to the ting" required /><br></br> </label>
				<label>Subject:<input type="text" size = "50" name="subject"  placeholder="Enter Message Subject" required /><br></br> </label>
				<label>Body: <br><textarea rows = "10" cols="100" type="text" name="body" placeholder="Enter Message"/></textarea><br></br></label>
				<label><input type="submit" value="Submit"></label>
				
			</div>
				
		</fieldset>
		</form>
		
		
		
	</div>


</body>
</html>