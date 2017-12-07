<?php

	$servername = 'localhost'; 
	$dbname = 'mail'; 
	$db_u_name = 'root'; 
	$db_password = ''; 

	$sconn = new PDO ("mysql:host=$servername;dbname=$dbname", $db_u_name, $db_password);
	$sconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>