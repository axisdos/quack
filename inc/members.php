<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele
###################
session_start();
include_once"config.php";
if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
	header("Location: ?page=login");
}else{
}

if(isset($_POST['change_password'])){
	$current_password = trim(sha1(md5(md5(sha1(md5(sha1(sha1(md5($_POST['current_password'])))))))));
	$new_password = trim(sha1(md5(md5(sha1(md5(sha1(sha1(md5($_POST['new_password'])))))))));
	$repeat_password = trim(sha1(md5(md5(sha1(md5(sha1(sha1(md5($_POST['new_password_repeat'])))))))));
	
	if($user['password'] != $current_password || strlen($_POST['new_password']) < 6){
		$profile_message = "Your current password does not match";
	} elseif($repeat_password != $new_password){
		$profile_message = "You didn't repeat the new password correctly";
	} else {
		mysqli_query($conn,"UPDATE `members` SET `password` = '$repeat_password' WHERE `username` = '" . $user['username'] . "'");
		$profile_message = "Your password was changed successfully";
	}
}
?>
<div class="row">
<div class="col-lg-3 col-lg-offset-1">
this is the profile!!
</div>

<div class="col-lg-8">
<div role="tabpanel">
<?php

if(isset($profile_message)){
?>
<div class="alert alert-warning"><?php echo $profile_message;?></div>
<?php
}
?>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">...</div>
    <div role="tabpanel" class="tab-pane" id="profile">...</div>
    <div role="tabpanel" class="tab-pane" id="messages">
		<div class="media">
  <a class="media-left" href="#">
   <img src="http://placehold.it/64x64" />
  </a>
  <div class="media-body">
   It looks like one of your accounts have been disabled through our automation.
  </div>
</div>
	</div>
    <div role="tabpanel" class="tab-pane" id="settings">
		<br />
		<div class="well well-sm">
			<h4>General Settings</h4>
			<hr />
			
			<form method="POST" role="form">
				<!-- START AVATAR -->
				<div class="form-group">
				<label for="avatar">Avatar URL</label>
				<input type="text" name="avatar_url" class="form-control" value="<?php echo $user['avatar']; ?>" />
				</div>
				<!-- START NAME -->
				<div class="form-group">
				<label for="avatar">Your Name</label>
				<input type="text" name="avatar_url" class="form-control" value="<?php echo $user['name']; ?>" />
				</div>
				
				<div class="form-group">
				<label for="avatar">Biography</label>
				<textarea class="form-control" name="bio">
				<?php echo $user['bio']; ?>
				</textarea>
				</div>
				
				<div class="form-group">
					<button type="submit" name="change_general_settings" class="btn btn-success">Save Changes</button>
				</div>
			</form>
		</div>
		
		<div class="well well-sm">
			<h4>Change Password</h4>
			<hr />
			
			<form method="POST" role="form">
				<div class="form-group">
				<label for="current_password">Current Password</label>
				<input type="password" name="current_password" class="form-control" />
				</div>
				
				<div class="form-group">
				<label for="new_password">New Password</label>
				<input type="password" name="new_password" class="form-control" />
				</div>
				
				<div class="form-group">
				<label for="new_password_repeat">Enter the new password again</label>
				<input type="password" name="new_password_repeat" class="form-control" />
				</div>
				
				<div class="form-group">
					<button type="submit" name="change_password" class="btn btn-success">Change Password</button>
				</div>
			</form>
		</div>
	</div>
  </div>

</div>
</div>
</div>

