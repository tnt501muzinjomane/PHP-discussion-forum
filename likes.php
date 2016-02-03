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
	$g = $_GET['aid'];
	$status = $_GET['h'];
	
	$id = $_GET['id'];
	
	$_SESSION['SUB_ID'] = $g;
	
	$qrycount = "SELECT count(*) from likes where a_id = '".$_SESSION['SUB_ID']."' and user_id = '".$_SESSION['SESS_MEMBER_ID']."'";
	
	$resultcount=mysql_query($qrycount);
	
	$row = mysql_fetch_array($resultcount);
	$total = $row[0];
	
   if($total == 0){


//Create INSERT query
$qry33 = "INSERT INTO likes (a_id, status, like_date, user_id) VALUES ('".$_SESSION['SUB_ID']."','$status', NOW(), '".$_SESSION['SESS_MEMBER_ID']."')";

	$result33 = @mysql_query($qry33);
	header("Location:answers.php? id=$id");
   }
   else if($total == 1)
   {
	   
	// update likes set status = 'unlike' where a_id = 21;  
	 
	 $qry = "update likes set status = '$status' where a_id = '".$_SESSION['SUB_ID']."' AND user_id = '".$_SESSION['SESS_MEMBER_ID']."' ";  
	 $result = @mysql_query($qry);
	 header("Location:answers.php? id=$id");
   }


?>
    
   
