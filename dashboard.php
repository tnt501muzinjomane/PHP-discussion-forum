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
	
	
	$qrycount = "SELECT count(*) from categories";
	//$result=mysql_query($qry);
	$resultcount=mysql_query($qrycount);
	$row = mysql_fetch_array($resultcount);
	$total = $row[0];
	
	
	$perpage = 10;

if(isset($_GET["page"])){
	$page = intval($_GET["page"]);
}
else {
$page = 1;
}

$calc = $perpage * $page;
$start = $calc - $perpage;
$result = "SELECT * FROM categories order by id DESC Limit $start, $perpage ";
$rows = mysql_query($result);

$result1 = "SELECT * FROM users where id = '".$_SESSION['SESS_MEMBER_ID']."'  ";
$result2=mysql_query($result1);
$row = mysql_fetch_array ($result2,MYSQL_ASSOC);







?>
    
    
    
    
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MTN Educare forum</title>
<link rel="stylesheet" href="css/style.css" />

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  


</head>

<body>
<nav class="navbar navbar-inverse" navbar-fixed-top style="border-radius:0px;">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php"><img src="images/logo.png" style="height:45px; margin-top: -13px;" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="dashboard.php"><i class="fa fa-book"></i> subjects</a></li>
        
        
        
        
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        
       
        <li class="dropdown"  >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><img src="<?php echo $row['profile_pic']; ?>" width="25px" height="25px" class="img-circle" title="<?php echo $row['name']; ?> <?php echo $row['surname']; ?>" /> <span class="caret"></span></a>
          <ul class="dropdown-menu" style="background-color:#ffcf00;" >
            <li style="width:100%;"><a href="profile_settings.php"><i class="fa fa-user"></i> profile setting</a></li>
            <li style="width:100%;"><a href="logout.php" title="Logout"><i class="fa fa-power-off"></i> <?php echo $row['name']; ?> <?php echo $row['surname']; ?></a></li>
            
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div id='welcome'>
<div class="container" >
<h3 style="margin-top:10px;color:#00678F; margin-left:1%;">SUBJECTS FOR DISCUSSION</h3>
</div>
</div>
<div class="container" >

<hr />

<div class="col-lg-9" >

<div class="well" style="background-color:#FFF; color:#313300;" >
<table class='table table-stripped'>
			<tr>
			</tr>
			
            <th>Subjects</th>
			<th></th>
            <th></th>
            
<?php

if ($total > 0){
	


  while ($display = mysql_fetch_array ($rows)) {
			//Successful
			
			$qrycount11 = "SELECT count(*) from topics where cat_id = {$display['id']} ";
			$resultcount11=mysql_query($qrycount11);
			$row11 = mysql_fetch_array($resultcount11);
			$total11 = $row11[0];
			
			
			$qrycount111 = "SELECT count(*) from sub_views where sub_id = {$display['id']} ";
			$resultcount111=mysql_query($qrycount111);
			$row111 = mysql_fetch_array($resultcount111);
			$total111 = $row111[0];
			
			
			
		echo "
			
			
			<tr>
			
			   <td>	
			   <p><b><a href='topics.php?id={$display['id']}'>{$display['cat_name']}</a></b></p></td>
			   <td>
			    <p>{$display['cat_description']}</p></td>
				 <td width='25%'><span id='circle'>$total111</span> <a href='topics.php?id={$display['id']}' >views</a> <span id='circle'>$total11</span><a href='topics.php?id={$display['id']}' title='Click to view questions or add your own question'> questions</a></td>
				</tr>
				
		
			";
			
          }
		  
		
		  
}
          



else
{
	echo "<p style='color:#f00;'>No results found</p> ";
}
	

		  ?>
          </table>
</div>          
<?php

if(isset($page))

{

$result = "SELECT count(*)  As Total from categories";


$qrycount1 = "SELECT count(*) As Total from categories";
$count = mysql_query($qrycount1);

$rs1 = mysql_fetch_array ($count);

$totalrelated = $rs1["Total"];


$rows = mysql_query($result);

if($rows)

{

$rs = mysql_fetch_array ($rows);

$total = $rs["Total"];

}

$totalPages = ceil($total / $perpage);
if ($total > 10){

if($page <=1 ){

echo "<span id='page_links' > << </span>";

}

else

{

$j = $page - 1;

echo "<span><a id='page_a_link' href='dashboard.php?page=$j'> << </a></span>";

}

for($i=1; $i <= $totalPages; $i++)

{

if($i<>$page)

{

echo "<span><a id='page_a_link' href='dashboard.php?page=$i'>$i</a></span>";

}

else

{

echo "<span id='page_links' style='font-weight: bold;'>$i</span>";

}

}

if($page == $totalPages )

{

echo "<span id='page_links' style='font-weight: bold;'> >> </span>";

}

else

{

$j = $page + 1;

echo "<span><a id='page_a_link' href='dashboard.php?page=$j'> >> </a></span>";

}
}
}
?>      

</div>

<div class="col-lg-3" style="color:#00678F;">
<div class="well" style="background-color:#fff; height:100%;" >
<h4>Follow Us</h4>
<hr />
<p><img src="images/facebook.png" alt="Like Our Facebook Page" /><img src="images/twitter.png" alt="follow @RealImageSD on Twitter" /><img src="images/youtube.png" alt="Follow our Youtube Channel" /></p>
<hr />
<?php


$qrycount112 = "SELECT count(*) from categories";
			$resultcount112=mysql_query($qrycount112);
			$row112 = mysql_fetch_array($resultcount112);
			$total112 = $row112[0];
			
$qrycount113 = "SELECT count(*) from topics";
			$resultcount113=mysql_query($qrycount113);
			$row113 = mysql_fetch_array($resultcount113);
			$total113 = $row113[0];
			
$qrycount114 = "SELECT count(*) from replies";
			$resultcount114=mysql_query($qrycount114);
			$row114 = mysql_fetch_array($resultcount114);
			$total114 = $row114[0];
			
$qrycount119 = "SELECT count(*) from users";
			$resultcount119=mysql_query($qrycount119);
			$row119 = mysql_fetch_array($resultcount119);
			$total119 = $row119[0];
			
			echo "<p>[ $total119 ] active users</p><hr>";
			echo "<p>[ $total112 ] subjects</p><hr>";
			echo "<p>[ $total113 ] questions</p><hr>";
			echo "<p>[ $total114 ] answers</p><hr>";

?>


</div>
</div>
</div>


<br />
<br />
<div class="well" style="background-color:#fff;">
<div id="bdiv">
 <p>Copyright &#169; <script language="javascript" type="text/ecmascript">
var today = new Date()
var year = today.getFullYear()
document.write(year)
</script></p>
</div>
</div>
</body>
</html>