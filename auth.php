<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		header("location: index.php");
		exit();
	}
	/*
	if(!isset($_SESSION['SESS_MEMBER_ID']) || time() - $_SESSION['login_time'] > 15000)
	{
		echo '<script type="text/javascript">alert("Your session has expired. Login again."); location.href="login.php";</script>';
	}*/
?>