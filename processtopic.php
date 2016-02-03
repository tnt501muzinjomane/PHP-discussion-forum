<?php
    //Start session
	session_start();
	//Require auth
	require_once('auth.php');
	
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
	
	//Sanitize the POST values Button1
	
	$id = clean($_POST['id']);
	
	$description = clean($_POST['description']);
	

	//Create INSERT query
$qry = "INSERT INTO topics(topic_subject, topic_date, cat_id, user_id) VALUES ('$description',NOW(), $id, '".$_SESSION['SESS_MEMBER_ID']."')";

	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		
		echo '<script type="text/javascript">alert("Your question has been posted successfully! We value your contribution."); location.href="topics.php?id='.$id.'";</script>';
		
		exit();
	}else {
		
		die("Sorry! The system failed to process !");
	}

?>