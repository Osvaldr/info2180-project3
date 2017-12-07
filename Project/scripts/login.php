<?php

	session_start();
	include('connect.php');
	if ($_SERVER["REQUEST_METHOD"] == "POST"){ 

		$u_name = $p_word  = '';
		$u_name = u_name_filter($_POST['u_name']);
		$p_word = p_word_filter($_POST['p_word']);	
		if ($u_name === "" || $p_word === ""){
			session_destroy();
			include_once('login.html');
		}
		$pass_test = md5($p_word);

		$row = $sconn->query("SELECT * FROM Users WHERE username = '$u_name' AND password = '$pass_test'");
		$row->execute();

		if ($row){//Log the user in
			session_regenerate_id();
			echo "User verified";
			$_SESSION['SESS_DIGEST'] = $row['password_digest'];//this gives an error "Fatal error: Cannot use object of type PDOStatement as array"
			$_SESSION['SESS_UNAME'] = $row['username'];
			$_SESSION['SESS_USERID'] = $row['id'];
			session_write_close();
			header("Location: Homepage.php");
			exit();
		}else{
			echo "A username/password error prevented login";
			session_destroy();
			include_once('login.html');
		}
	}

	function filter_enter($input){//Filtering and Sanitizing the variables
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}

	function u_name_filter($u_name){
		if (empty($u_name)){ //Ensuring that the user name field is not empty
			echo "Please enter the username";
			return '';
		}else{
			$u_name = filter_enter($u_name);
			return $u_name;
		}
		return '';
	}

	function p_word_filter($p_word){
		if (empty($p_word)){ //Ensuring that the password field is not empty
			echo "Please enter the password";
			return '';
		}else{
			$p_word = filter_enter($p_word);
			return $p_word;
		}
		return '';
	}				

	function p_word_verify($digest, $pass_test){//Ensuring that the password matches the digest on the server
		if($digest != $pass_test){ 
			return false;
		}else{ //The password is correct
			return true;
		}	
	}		
?>
