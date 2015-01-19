<!doctype>
<html>
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
</head>
<body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">I forgot my password</h4>
      </div>
      <div class="modal-body">
        <p>
		Administrators can easily recover their account if they have 'Easy Recovery' enabled. If you do not have this enabled, please contact the webmaster.
		
		</p>
		<p>
		If you do have it enabled, simply fill out this form and we'll reset your password.
		<hr />
		<form method="POST">
			<div class="form-group">
				<label>E-mail address</label>
				<input type="email" name="email" class="form-control" placeholder="admin@yourwebsite.com" />
				<p class="text-muted">That's the one registered to your account</p>
			</div>
		</form>
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="container">
	<div class="row">
	<div class="col-lg-6 col-lg-offset-3" style="margin-top:100px;">
		<img src="http://uploadir.com/u/qq2r0qor" class="img-responsive" />
		<hr />
		<div class="panel panel-default">
			<div class="panel-body">
			<form method="POST" role="form">
				<div class="form-group">
					<label for="username">Admin Username</label>
					<input type="text" name="username" placeholder="Administrator" class="form-control" />
				</div>
				
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="*******" class="form-control" />
				</div>
				
				<div class="form-group">
					<button type="submit" name="login" class="btn btn-primary pull-left">Sign in</button>
					<span class="pull-right">
					<a href="#"  data-toggle="modal" data-target="#myModal">I forgot my password</a>
					</span>
				</div>
			</form>
			</div>
		</div>
		<p class="pull-right">
		<a href="#">Forgotten Password?</a>
		</p>
	</div>
	</div>
</div>
</div>
</body>
</html>