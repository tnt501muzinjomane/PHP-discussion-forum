<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect($mysql_host, $mysql_user, $mysql_password);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db($mysql_database);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$id = ucwords(clean($_POST['id']));
	$fname = ucwords(clean($_POST['name']));
	$lname = ucwords(clean($_POST['surname']));
	$gender = clean($_POST['gender']);
	$dob = clean($_POST['dob']);
	$date = date("Y-m-d H:i");
	
	

	//Create INSERT query
	$qry = "UPDATE users set name = '$fname', surname = '$lname', gender = '$gender', dob = '$dob'  where id = $id";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		
		echo '<script type="text/javascript">alert("Profile updated successfully!"); location.href="profile_settings.php";</script>';
		exit();
		exit();
	}else {
		die("Query failed");
	}
?>