<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>User Creation</title>
	</head>

	<body>

		<?php

			if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
				
				$password = '';
				$salt = mt_rand(); 
				$servername = getenv('localhost'); //What goes here again?-Verify this
				$dbname = 'mail'; //What goes here again?-I think the default db is c9 since one wasnt specified in .sql file
				$db_u_name = 'root'; //What goes here again?-Verify this
				$db_password = ''; //What goes here again?
				$f_name = $l_name = $u_name = $p_word = "";

				$f_name = name_filter($_POST['f_name']);
				$l_name = name_filter($_POST['l_name']);
				$u_name = u_name_filter($_POST['u_name']);
				$p_word = p_word_filter($_POST['p_word']);			
				$password = md5($p_word);
				$p_word = '';

				if (empty($f_name) || empty($l_name) || empty($u_name) || empty($password)){
					echo "The database was not updated and so the user was not added";
				}else{ 
					try{
						$sconn = new PDO ("mysql:host=$servername;dbname=$dbname", $db_u_name, $db_password);
						$sconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "INSERT INTO Users (firstname, lastname, username, password) VALUES ('$f_name', '$l_name', '$u_name', '$password')";
						$sconn->exec($sql);
						echo nl2br("Data recorded successfully\n");
					}catch(PDOException $e){
						echo $sql.$e->getMessage();
						echo nl2br("Data NOT recorded\n");
					}
					$sconn = null;
				}
			}

			function filter_enter($input){
				$input = trim($input);
				$input = stripslashes($input);
				$input = htmlspecialchars($input);
				return $input;
			}

			function name_filter($_name){
				if(empty($_name)){ 
					echo "An [empty name] error occurred";
					return '';
				}else{
					$_name = filter_enter($_name);
					return $_name;
				}
				return '';
			}

			function u_name_filter($u_name){
				if (empty($u_name)){ 
					echo "An [empty u_name] error occurred";
					return '';
				}else{
					$u_name = filter_enter($u_name);
					return $u_name;
				}
				return '';
			}

			function p_word_filter($p_word){
				if (empty($p_word)){
					echo "An [empty password] error occurred";
					return '';
				}else if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/', $p_word)){
					echo "A password matching error occurred";
					return '';
				}else{
					$p_word = filter_enter($p_word);
					return $p_word;
				}
				return '';
			}
		?>
	</body>
</html>


