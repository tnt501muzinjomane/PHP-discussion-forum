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
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
  $(function() {
    $( "#dob" ).datepicker({ dateFormat: 'yy-mm-dd'});
	
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
      <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="height:45px; margin-top: -13px;" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
       
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div id='welcome'>
<center><h2 style="margin-top:10px;color:#00678F; text-shadow:2px 2px 2px #000;">WELCOME TO MTN EDUCARE FORUM</h2></center>
</div>
<div class="col-lg-16">

<div class="col-lg-12" id="time" style="background-color:#00678F; color:#FFF; margin-right:8.5%;">
<?php
 echo "<b style='margin-left:8.5%;'>DATE : ". date("Y-m-d </b>");
 ?>
 &nbsp;&nbsp;&nbsp;
<?php 
 echo "<b>TIME : ". date("h:i:sa</b>"); 
 
?>
</div>
</div>


<div class="container" >

<div class="col-lg-5">
<br />

<div class="well" style="background-color:#FFF;">
<h4 style="margin-top:10px;color:#00678F;"><i class="fa fa-users"></i> registration</h4>

<form name="f" method="post" action="register-exec.php" enctype="multipart/form-data" >  
<input name="name" id="name" type="text" style="width:80%;padding:0px;"  required="required" placeholder="your name" />
<br /><br />
<input name="surname" id="surname" type="text" style="width:80%;padding:0px;"  required="required" placeholder="your surname" />
<br /><br />
 <select id="gender" name="gender"  style="width:80%;padding:0px;" required="required">
            <option value="">Please select gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
<br /><br />
<input name="dob" id="dob" type="date" style="width:80%;padding:0px;"  required="required" placeholder="date of birth" />
<br /><br />
Select your profile picture<br />
<input name="image" id="image" type="file" style="width:80%;padding:0px;"  required="required" title="Select your profile picture" />
<br />
<input name="amail" id="amail" type="email" style="width:80%;padding:0px;"  required="required" placeholder="your email" />
<br /><br />
<input name="password" id="password" type="password" style="width:80%;padding:0px;"  required="required" placeholder="your password" />
<br /><br />
<input name="cpassword" id="cpassword" type="password" style="width:80%;padding:0px;"  required="required" placeholder="confirm password" />
<br /><br />

<button type="submit"  class="btn btn-success"> Create account</i>
</button>

        </form>
</div>
</div>
</div>




<br />
<br />
<div id='welcome'>
<center><h2 style="margin-top:10px;color:#00678F; text-shadow:2px 2px 2px #000;">"BE THE BEST CANDIDATE"</h2></center>
</div>
<div class="well" style="background-color:#fff;">
<div id="bdiv">
 <p><img src="images/facebook.png" alt="Like Our Facebook Page" /><img src="images/twitter.png" alt="follow @RealImageSD on Twitter" /><img src="images/youtube.png" alt="Follow our Youtube Channel" />  Copyright &#169; <script language="javascript" type="text/ecmascript">
var today = new Date()
var year = today.getFullYear()
document.write(year)
</script></p>
</div>
</div>
</body>
</html>