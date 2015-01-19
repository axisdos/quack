<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
// Configuration include files
@include("inc/tinybb-settings.php"); // Most of the forum settings can be found in this file, it is located in your forum /inc/ folder 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="description" content="TinyBB Powered Forum" />
<meta name="keywords" content="General,Discussion,Discuss,Topics,Forum,Writing,People,Social,Network,Create,Accounts" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="style/pagination.css" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<title><?php echo "$bbsetting[tinybb_title]"; ?></title>
</head>
<body>

<div id="wrap">



    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="images/rubix.png" style="max-width:150px;margin-top: -7px;" /></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
		  <?php if($user['username'] == ""): ?>
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
		  <?php else: ?>
		  <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="?page=editaccount">User CP</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
		  <?php endif; ?>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	


<div class="container">
<div class="row">
<div class="col-lg-12">
<?php if ((!$bbsetting[tinybb_maintenance] == "1") && ($user[admin] == "1")){
  echo "<div class='warning' align'center'>The forum currently has maintenance mode enabled. To disable it, edit your <a href='admin.php?list=settings'>Forum Settings</a>.</div>";
}
?>
<?php if ($bbsetting[tinybb_categories] == "0"){
  include("inc/list.php"); }
  else {
  include("inc/list2.php");
  }
  ?>
</div>
</div>
</div>


<div style="clear: both;"> </div>

</div>
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="footer">
<hr />
Powered by Quack
<br />
<?php if ($user[admin] == "1"){ echo "<a href='admin.php'>Administration</a> &bullet; "; } ?><?php if (($user[admin] == "mod") || ($user[admin] == "1")){ echo "<a href='mod.php'>Moderation</a> &bullet; "; } ?> <?php if ($user[username] == ""){ } else { ?><a href="?page=logout">Logout</a><?php } ?>

<br />

Made in England &bullet; Licensed to domain.com &bullet; Copyright &copy 2015
<div style="height:30px;"></div>
</div>


</div>
</div>
</div>
</div>
</body>
</html>
