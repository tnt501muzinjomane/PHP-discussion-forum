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
	$g = $_GET['id'];
	
	$_SESSION['SUB_ID'] = $g;
	
	$qrycount = "SELECT count(*) from replies where topic_id = '".$_SESSION['SUB_ID']."'";
	//$result=mysql_query($qry);
	$resultcount=mysql_query($qrycount);
	if($resultcount != ''){
	$row = mysql_fetch_array($resultcount);
	$total = $row[0];
	}
	
	$perpage = 10;

if(isset($_GET["page"])){
	$page = intval($_GET["page"]);
}
else {
$page = 1;
}

$g = $_GET['id'];
	
$_SESSION['SUB_ID'] = $g;

$calc = $perpage * $page;
$start = $calc - $perpage;
//$result = "SELECT * FROM replies where topic_id = '".$_SESSION['SUB_ID']."' order by id DESC Limit $start, $perpage ";
$result = "SELECT u.profile_pic, u.name, u.surname, r.id, r.reply_content, r.reply_date, r.topic_id, r.user_id FROM users u, replies r WHERE u.id = r.user_id AND topic_id = '".$_SESSION['SUB_ID']."' order by id DESC Limit $start, $perpage ";

//SELECT u.profile_pic, r.id, r.reply_content, r.reply_date, r.topic_id, r.user_id FROM users u, replies r WHERE u.id = r.user_id

$rows = mysql_query($result);

$result1 = "SELECT * FROM users where id = '".$_SESSION['SESS_MEMBER_ID']."'  ";
$result2=mysql_query($result1);
$row = mysql_fetch_array ($result2,MYSQL_ASSOC);

$result3 = "SELECT * FROM topics where id = '".$_SESSION['SUB_ID']."' ";
$result3=mysql_query($result3);
if($result3 != ''){
$row1 = mysql_fetch_array ($result3,MYSQL_ASSOC);

}


//Create INSERT query
$qry33 = "INSERT INTO q_views (q_id, view_date, user_id) VALUES ('".$_SESSION['SUB_ID']."', NOW(), '".$_SESSION['SESS_MEMBER_ID']."')";
	$result33 = @mysql_query($qry33);

//Count replies 
$qrycount116 = "SELECT count(*) from replies where topic_id = '".$_SESSION['SUB_ID']."'";
			$resultcount116=mysql_query($qrycount116);
			$row116 = mysql_fetch_array($resultcount116);
			$total116 = $row116[0];

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
  
  <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
  
  <script>
  
  $(document).on('focusin', function(e) {
    if ($(event.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});
  
  
  </script>
  
  
  
    <script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>


</head>

<body>
<nav class="navbar navbar-inverse" style="border-radius:0px;">
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
       
        <li class="dropdown">
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
<h3 style="margin-top:10px;color:#00678F;margin-left:1%;"><?php echo $row1['topic_subject']; ?></h3>
</div>
</div>

<div class="container" >

<?php


function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}

?>


<hr />



<div class="col-lg-9" >
<button onclick='history.go(-1);'   class='fa fa-arrow-left big' style='border-radius:2px;' title='Go back'></button><br /><hr />
<button type='button' class='btn btn-success'  data-toggle='modal' data-target='#myModal' title="<?php echo $row['name']; ?> <?php echo $row['surname']; ?>">
<i class='fa fa-plus-square'> Answer</i>
</button><br /><br />
<div class="well" style="background-color:#FFF;color:#313300;" >

<table class='table table-stripped' style='border:0px;' >
			<tr>
			</tr>
			
            <th>[ <?php echo $total116; ?> ] Answers</th>
			<th></th>
            <th></th>
            
<?php

if ($total > 0){
	


  while ($display = mysql_fetch_array ($rows)) {
			//Successful
			
			
			$qrycount111 = "SELECT count(status) from likes where status = 'like'  AND a_id = {$display['id']} ";
			$resultcount111=mysql_query($qrycount111);
			$row111 = mysql_fetch_array($resultcount111);
			$total111 = $row111[0];
			
			
			
			
		echo "
			
			
			<tr>
			
			   <td>	
			   <p>{$display['reply_content']}</p>
			    <img src='{$display['profile_pic']}' width='25px' height='25px' class='img-circle' title='{$display['name']} {$display['surname']}' />
			   ";
			   
			   $time = strtotime($display['reply_date']);
              echo '<span style="color: #00678F; font-size:10px;">posted  '.humanTiming($time).' ago by '.$display['name'].' '.$display['surname'].' </span> ';


			   
			   echo "
			   
			  </td>  
			   <td>
			    <p>{$display['cat_description']}</p></td>
				 <td width='20%'><span id='circle' title='Number of likes'> $total111 </span> &nbsp;&nbsp;  <a href='likes.php?aid={$display['id']} &h=like &id=$g' title='Like'> <i class='fa fa-thumbs-o-up big'></i></a> || <a href='likes.php?aid={$display['id']} &h=unlike &id=$g' title='Unlike'><i class='fa fa-thumbs-o-down big1'></i></a></td>
				</tr>
				
		
			";
			
          }		  
}
          
else
{
	echo "<p style='color:#f00;'>No answers found </p>";
}

		  ?>
          </table>
</div>          
<?php

if(isset($page))

{

$result = "SELECT count(*)  As Total from replies where topic_id = $g ";


$qrycount1 = "SELECT count(*) As Total from replies where topic_id = $g";
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

echo "<span><a id='page_a_link' href='answers.php?id={$g}&page=$j'> << </a></span>";

}

for($i=1; $i <= $totalPages; $i++)

{

if($i<>$page)

{

echo "<span><a id='page_a_link' href='answers.php?id={$g}&page=$i'>$i</a></span>";

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

echo "<span><a id='page_a_link' href='answers.php?id={$g}&page=$j'> >> </a></span>";

}
}
}
?>
<hr />
 <button type='button' class='btn btn-success'  data-toggle='modal' data-target='#myModal' title="<?php echo $row['name']; ?> <?php echo $row['surname']; ?>">
<i class='fa fa-plus-square'> Answer</i>
</button>
<p style="float:right;"><a href="answers.php?id=<?php echo $g; ?>" class="back-to-top" title="Back to Top"><i class="fa fa-arrow-circle-up big2"></i></a></p>
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



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#000; color:#FFF;">
       
        <h4 class="modal-title" id="myModalLabel">Post your answer below</h4>
      </div>
      <div class="modal-body">
      
      <form  method="post" action="processanswer.php"  >  
<input name="id" id="id" type="hidden" value="<?php echo $_SESSION['SUB_ID'] ?>" />
<textarea rows="4" cols="50" name="answer"  width="50%"></textarea>
<br />


 </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <button type="submit" class="btn btn-success"> post answer</i>
</button>

</form> 
   
        
      </div>
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