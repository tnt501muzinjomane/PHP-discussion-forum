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
      <a class="navbar-brand" href="#"><img src="images/logo.png" style="height:45px; margin-top: -13px;" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       
        
      </ul>
     
    
        <ul class="pull-right" style="padding-top:10px;">
    <!-- Button trigger modal -->
<form name="Form1" method="post" action="login-exec.php" >  

<input name="amail" id="amail" type="email" class="textbox"   required="required" placeholder="your email" />

<input name="password" id="password" type="password" class="textbox"   required="required" placeholder="your password" />


<button type="submit"  class="btn btn-success btn-xs"> Sign in</i>
</button> || <a href="user-registration.php" class="btn btn-success btn-xs">Sign up</a>

</form>
    
    </ul>
    
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



<div id='welcome'>
<center><h2 style="margin-top:10px;color:#00678F; text-shadow:2px 2px 2px #000;">WELCOME TO MTN EDUCARE FORUM</h2></center>
</div>



<div class="col-lg-16">

<div class="col-lg-12" id="time" style="background-color:#00678F; color:#FFF;">
<?php
 echo "<b style='margin-left:8.5%;'>DATE : ". date("Y-m-d");
 ?>
 &nbsp;&nbsp;&nbsp;
<?php 
 echo "<b>TIME : ". date("h:i:sa"); 
 
?>
</div>
</div>



<div class="col-lg-16">
<h3 style="z-index:31px;color:#00678F; text-align:center; text-shadow:1px 1px 1px #000;">The Future of Online Education in Swaziland</h3>
<img src="images/banner.jpg" style="width:100%; margin:0px;"  />
</div>



<br />
<br />
<div id='welcome'>
<center><h2 style="margin-top:10px;color:#00678F; text-shadow:2px 2px 2px #000;">"BE THE BEST CANDIDATE"</h2></center>
</div>
<div class="well" style="background-color:#fff;">
<div id="bdiv">
 <p><img src="images/facebook.png" alt="Like Our Facebook Page" /><img src="images/twitter.png" alt="follow @RealImageSD on Twitter" /><img src="images/youtube.png" alt="Follow our Youtube Channel" /> Copyright &#169; <script language="javascript" type="text/ecmascript">
var today = new Date()
var year = today.getFullYear()
document.write(year)
</script></p>
</div>
</div>
</body>
</html>