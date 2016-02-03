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
	$fname = ucwords(clean($_POST['name']));
	$lname = ucwords(clean($_POST['surname']));
	$login = clean($_POST['amail']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	$gender = clean($_POST['gender']);
	$dob = clean($_POST['dob']);
	$img = clean($_POST['image']);
	$date = date("Y-m-d H:i");
	
	
	
	
	//Input Validations
	if($fname == '') {
		$errmsg_arr[] = 'Name missing';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = 'Surname missing';
		$errflag = true;
	}
	if($login == '') {
		$errmsg_arr[] = 'Email missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
		echo '<script type="text/javascript">alert("Passwords do not match"); location.href="index.php";</script>';
	}
	
	
	
	define ("MAX_SIZE","1000"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
 
$errors=0;
$image=$_FILES['image']['name'];
if ($image) 
{
	$filename = stripslashes($_FILES['image']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif") && ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")) 
	{
		echo '<h3>Unknown extension! Please attach a png or jpg image!</h3>';
		$errors=1;
		exit();
	}
	else
	{
		$size=filesize($_FILES['image']['tmp_name']);
 
		if ($size > MAX_SIZE*2048)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
			exit();
		}
 
		$image_name=time().'.'.$extension;
		$newname="profile/".$image_name;
 
		$copied = copy($_FILES['image']['tmp_name'], $newname);
		
	}
}	
	
	
	
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM users WHERE email='$login'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Email already in use';
				$errflag = true;
				echo '<script type="text/javascript">alert("Email already in use!"); location.href="user-registration.php";</script>';
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("user-registration.php");
		exit();
	}

	//Create INSERT query
	$qry = "INSERT INTO users(name, surname,gender, dob, profile_pic, priv, email, password, created_at) VALUES('$fname','$lname','$gender','$dob','".$newname."','','$login','".md5($_POST['password'])."','$date')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		
		echo '<script type="text/javascript">alert("Registration successfully!"); location.href="index.php";</script>';
		exit();
		exit();
	}else {
		die("Query failed");
	}
?>