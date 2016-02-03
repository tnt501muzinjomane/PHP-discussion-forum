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
	$search = $_GET['search'];
	
	
	
	$qrycount = "SELECT count(*) from topics";
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



$calc = $perpage * $page;
$start = $calc - $perpage;

if($search == ''){

$result = "SELECT u.profile_pic, u.name, u.surname, t.id, t.topic_subject, t.topic_date, t.user_id FROM users u, topics t WHERE u.id = t.user_id  order by id DESC Limit $start, $perpage ";
$rows = mysql_query($result);
}
else
{
	$result = "SELECT u.profile_pic, u.name, u.surname, t.id, t.topic_subject, t.topic_date, t.user_id FROM users u, topics t WHERE u.id = t.user_id  AND topic_subject LIKE '%$search%' order by id DESC Limit $start, $perpage ";
$rows = mysql_query($result);
}

$result1 = "SELECT * FROM users where id = '".$_SESSION['SESS_MEMBER_ID']."'  ";
$result2=mysql_query($result1);
$row = mysql_fetch_array ($result2,MYSQL_ASSOC);

$result3 = "SELECT * FROM categories where id = '".$_SESSION['SUB_ID']."' ";
$result3=mysql_query($result3);
if($result3 != ''){
$row1 = mysql_fetch_array ($result3,MYSQL_ASSOC);

}

if($search == ''){	
$qrycount115 = "SELECT count(*) from topics";
			$resultcount115=mysql_query($qrycount115);
			$row115 = mysql_fetch_array($resultcount115);
			$total115 = $row115[0];
}
else
{
$qrycount115 = "SELECT count(*) from topics where topic_subject LIKE '%$search%'";
			$resultcount115=mysql_query($qrycount115);
			$row115 = mysql_fetch_array($resultcount115);
			$total115 = $row115[0];	
}


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
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  
  <script>
  
  $(document).on('focusin', function(e) {
    if ($(event.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});
  
  
  </script>
  
  <script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete this question and its relevant answers?");
      if (x)
          return true;
      else
        return false;
    }
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
        <li ><a href="subject.php"><i class="fa fa-book"></i> subjects <span class="sr-only">(current)</span></a></li>
        <li><a href="manage_questions.php"><i class="fa fa-question-circle"></i> manage questions</a></li>
        
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        
       
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><img src="<?php echo $row['profile_pic']; ?>" width="25px" height="25px" class="img-circle" /> <span class="caret"></span></a>
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
<h3 style="margin-top:10px; color:#00678F;margin-left:1%;">MANAGE QUESTIONS</h3>
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
<button onclick='history.go(-1);'   class='fa fa-arrow-left big' style='border-radius:2px;' title='Go back'></button>
<br />
<br />

<div class="col-lg-9" style="float:right;" >
<form  method='GET' action='manage_questions.php'  > 

<input name='search' id='search' type='text' value='' placeholder="search by keywords"/>
<button type='submit' class='btn btn-success' ><i class="fa fa-search"></i></button>
</form>
</div>

<br />
<br />

<div class="well" style="background-color:#FFF; color:#313300;" >
<table class='table table-stripped' style='border:0px;' >
			<tr>
			</tr>
			
            <th>[ <?php echo $total115; ?> ] Questions</th>
			<th>Action</th>
            
            
<?php

if ($total > 0){
	


  while ($display = mysql_fetch_array ($rows)) {
			//Successful
			
			
			$qrycount11 = "SELECT count(*) from replies where topic_id = {$display['id']} ";
			$resultcount11=mysql_query($qrycount11);
			$row11 = mysql_fetch_array($resultcount11);
			$total11 = $row11[0];
			
		echo "
			
			
			<tr>
			   
			   <td> 	
			   <p>{$display['topic_subject']}</p>
			   <img src='{$display['profile_pic']}' width='25px' height='25px' class='img-circle' title='{$display['name']} {$display['surname']}' />
			   ";
			   
			   $time = strtotime($display['topic_date']);
               echo '<span style="color: #00678F; font-size:10px;">posted  '.humanTiming($time).' ago by '.$display['name'].' '.$display['surname'].' </span> ';


			   
			   echo "
			   
			  </td>  
			   
				<form  method='post' action='deleteq.php' onsubmit='return confirm('Are you sure?');'  >
				<td>
				<input name='id' id='id' type='hidden' value='{$display['id']}'/>
				<button type='submit' class='btn btn-danger' Onclick='return ConfirmDelete();' title='Deleting this question will permanately remove it from the system'><i class='fa fa-trash'>delete</i>
</button>
			    <a href='manage_answers.php?id={$display['id']}&q={$display['topic_subject']}' class='btn btn-success'>
			    [ $total11 ] answers</a></td>
				</form> 
				</tr>
				
		
			";
			
          }		  
}
          
else
{
	echo "<p style='color:#f00;'>No questions found</p> ";
}

		  ?>
          </table>
</div>          
<?php

if(isset($page))

{

$result = "SELECT count(*)  As Total from topics";


$qrycount1 = "SELECT count(*) As Total from topics";
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

echo "<span><a id='page_a_link' href='manage_questions.php?id={$g}&page=$j'> << </a></span>";

}

for($i=1; $i <= $totalPages; $i++)

{

if($i<>$page)

{

echo "<span><a id='page_a_link' href='manage_questions.php?id={$g}&page=$i'>$i</a></span>";

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

echo "<span><a id='page_a_link' href='manage_questions.php?id={$g}&page=$j'> >> </a></span>";

}
}
}
?>
<hr />

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