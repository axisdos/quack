<?php



// include smarty templating

require_once "lib/3rdparty/smarty/Smarty.class.php";

$view = new Smarty;

// if user is logged in, let the template know

if(isset($user['username'])){
    $view->assign('user', $user);
}

// create instance of HTMLPurifier

$purifier = new HTMLPurifier();

function purify($message){
    global $purifier;
    return $purifier->purify($message);
}
// check to see if the web browser is requesting a thread

if(isset($_GET['post'])){
    // will implement PDO or something similar later on
    $identifier = mysqli_real_escape_string($conn,$_GET['post']);
    $findthread = mysqli_query($conn,"SELECT * FROM tinybb_threads INNER JOIN members ON tinybb_threads.thread_author = members.username WHERE tinybb_threads.thread_key = '{$identifier}'");
    
    if(mysqli_num_rows($findthread) == 0){
        $view->assign('url', 'showthread');
        $view->display('lib/tpl/404.tpl');
    } else {
        $firstpost = mysqli_fetch_assoc($findthread);
        
        // allow users to post
        
        if(isset($user) && isset($_POST['addpost'])){
            $message = mysqli_real_escape_string($conn,$_POST['message']);
            
            if(strlen($message) < 5 || strlen($message) > 10000){
                $view->assign('error', 'Your message length didn\'t meet our guidelines');
            } else {
                $username = $user['username'];
                $replykey = uniqid();
                $date = date("d-m-Y H:i:s");
                mysqli_query($conn,"INSERT INTO tinybb_replies (reply_content, reply_author, reply_key, thread_key, date) VALUES('$message', '$username', '$replykey', '$identifier', '$date')");
                
                $view->assign('success', 'Your post was successfully added');
            }
        }
        // let's generate the first post
        
        $view->assign('firstpost', $firstpost);
        
        $findposts = mysqli_query($conn,"SELECT *, tinybb_replies.date as postdate FROM tinybb_replies INNER JOIN members ON tinybb_replies.reply_author = members.username WHERE tinybb_replies.thread_key = '{$identifier}'");
        
        if(mysqli_num_rows($findposts) == 0){
            $view->assign('noreplies', 1);
            // tell the template to tell the browser there's no replies
        } else {
            $posts = array();
            
            while($post = mysqli_fetch_array($findposts)){
                $posts[] = $post;
            }
            
            $view->assign('subposts', $posts);
        }
        
        $view->display('lib/tpl/showthread.tpl');
        
    }
} else {
    $view->assign('url', 'showthread');
    $view->display('lib/tpl/404.tpl');
}

die();

/**
 * This is the original TinyBB viewthread.php which has not yet been removed
 */
 

		 $purifier = new HTMLPurifier();
      if (!$_GET['post']){ } else {
        $clean_get = clean($_GET[post]);
      $check_thread = mysqli_query($conn,"SELECT * FROM `tinybb_threads` WHERE `thread_key` = '$clean_get'") or die(mysqli_error());
      if(mysqli_num_rows($check_thread) == 0){
        die("<h2><img src='icons/idea.gif' border='0'> Boom! Error...</h2>The thread doesn't exist...");
      } }
?>
<div class="container">
<div class="row">
<div class="col-lg-8">
<?php if ($dcm == "vc"){ die("$tinybbkey"); } ?>
 <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">
function insertit(myField, myValue) {
if (document.selection) {
myField.focus();
sel = document.selection.createRange();
sel.text = myValue;
} else if (myField.selectionStart || myField.selectionStart == '0') {
var startPos = myField.selectionStart;
var endPos = myField.selectionEnd;
myField.value = myField.value.substring(0, startPos)
+ myValue
+ myField.value.substring(endPos, myField.value.length);
} else {
myField.value += myValue;
}
}
</script>
<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
 ?>
<?php if ((!$allowguests == "0") && ($user[username] == null)){ echo "<center><span style='color:red; font-weight:bold;'>Guests are not allowed to browse $bbtitle</span></center>"; include("login.php"); } else { ?>
         <?php
         $codes = array(
		'[b]' => '<span style="font-weight:bold">',
		'[B]' => '<span style="font-weight:bold">',
		'[/b]' => '</span>',
		'[/B]' => '</span>',
		'[i]' => '<span style="font-style:italic">',
		'[I]' => '<span style="font-style:italic">',
  		'[/i]' => '</span>',
  		'[/I]' => '</span>',
		'[u]' => '<span style="text-decoration:underline">',
		'[U]' => '<span style="text-decoration:underline">',
  		'[/u]' => '</span>',
  		'[/U]' => '</span>',
  		':)' => '<img src="icons/smile2.png" />',
  		':D' => '<img src="icons/bigsmile.png" />',
  		'(L)' => '<img src="icons/love.png" />',
  		';)' => '<img src="icons/wink.png" />',
  		':@' => '<img src="icons/angry.png" />',
  		':$' => '<img src="icons/blush.png" />',
  		':P' => '<img src="icons/tongue.png" />',
		':sw:' => '<img src="icons/skywalker.png" />',
		':tired:' => '<img src="icons/yawn.png" />',
		':(' => '<img src="icons/frown.png" />',
		'[youtube]' => '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="480" height="390" src="http://www.youtube.com/embed/',
		'[/youtube]' => '" frameborder="0"></iframe>'
		);
		function convertbb($t) { 
			$s = array_keys($GLOBALS['codes']);
 			$t = str_replace($s, $GLOBALS['codes'], $t);
  			return $t;
		}
		function nl2br_limit($string, $num){
   			$dirty = preg_replace('/\r/', '', $string);
			$clean = preg_replace('/\n{4,}/', str_repeat('<br/>', $num), preg_replace('/\r/', '', $dirty));
   			return nl2br($clean);
		}
		?>
		
		<div class="posts">
         <?php
         // The below is calling data from the "data"base and listing it here in an array.
         $result = mysqli_query($conn,"SELECT * FROM tinybb_threads WHERE thread_key ='".addslashes(htmlspecialchars($_GET['post']))."' LIMIT 1") or die("<h3><img src='icons/idea.gif'> Oops, an error?</h3>It seems an error has occured with the forum, contact the administrator to report this issue. (For documentation, MYSQL)<br /><br /><br /><br /><br /></h3>");
         while($row = mysqli_fetch_array($result))  {
         ?>
		 <div class="page-header" style="margin-top:0;">
		 <h2 class="pull-left">
		 <?php echo $row['thread_title']; ?>
		 </h2>
		 
		 <div class="pull-right">
		 <div class="btn-group2">
		 <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
    </div><!-- /input-group -->
		 </div>
		 </div>
		  <div class="clearfix"></div>
		 </div>
		 <div class="row">
		 <div class="col-lg-12 col-sm-12 col-md-12">
		 <div class="postbit">
		 <div>
			           <?php
           $av = mysqli_query($conn,"SELECT * FROM `members` WHERE `username` = '$row[thread_author]'");
           $av = mysqli_fetch_array($av);
		   if ($av[avatar] == null){ echo "<img src='https://en.gravatar.com/images/gravatars/no_gravatar.gif' class='avatar ' />"; } else { 
           echo "<img src='$av[avatar]' class='avatar' />";
           }
         ?>
		 <span class="pull-left">
         <a href="index.php?page=profile&id=<?php echo "$row[thread_author]"; ?>">
         <?php echo "$row[thread_author]"; ?></a>
         </a>
		 
        
         <?php
         $res = mysqli_query($conn,"SELECT * FROM tinybb_replies WHERE reply_author = '$row[thread_author]'");
         $res2 = mysqli_query($conn,"SELECT * FROM tinybb_threads WHERE thread_author = '$row[thread_author]'");
         $posts = mysqli_num_rows($res);
         $topics = mysqli_num_rows($res2);
		 $total = ($posts * $topics);
         echo "<br /> $total messages";
         ?>
		 </span>
		  <span class="pull-right text-muted"><?php echo timeAgo(($row['date'])); ?></span>
		 <div style="clear:both;"></div>
		 <br />
		 </div>
		 </div>
		 </div>
		 </div>
		 
		 <div class="row">
		 
		 <div class="col-lg-12 col-md-12 col-sm-12">
		 <div>
		 
		
		 <?php echo $purifier->purify($row['thread_content']); ?>
		 <br /><br />
		<div class="button-area">
		<div class="row">
		<div class="col-lg-3">
		   <?php if ($user[admin] == "1"){ ?>
		   
         <a href="admin.php?delete&thread=<?php echo "$row[thread_key]"; ?>" class="btn btn-danger btn-sm">
			<span class="glyphicon glyphicon-remove"></span> Delete
		 </a>
         <a href="admin.php?list=edit&type=thread&thread=<?php echo "$row[thread_key]"; ?>" class="btn btn-warning btn-sm">
			<span class="glyphicon glyphicon-pencil"></span> Edit
		 </a>
         <?php if ($row[thread_lock] == "1"){ ?>
         <a href="admin.php?lock&lock=2&thread=<?php echo "$row[thread_key]"; ?>" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicon-lock"></span>
			Unlock
		 </a>
         <?php } else { ?>
         <a href="admin.php?lock&lock=1&thread=<?php echo "$row[thread_key]"; ?>" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicon-lock"></span>
			Lock
		 </a>
         <?php } } ?>
		 </div>
		 
		 <div class="col-lg-3">
		 <h4>options</h4>
		 </div>
		 
		 <div class="col-lg-3">
		 <h4>profile</h4>
		 </div>
		 
		 <div class="col-lg-3">
		 </div>
		 </div>
		 </div>
		 </div>
		 </div>
		 </div>
         
       
         <?php } ?>
		 <hr />
         <?php
         // The below is calling data from the "data"base - FOR REPLIES
         $result = mysqli_query($conn,"SELECT * FROM tinybb_replies WHERE thread_key ='".addslashes(htmlspecialchars($_GET['post']))."' ORDER BY ABS(`aid`) ASC LIMIT 5000") or die("<h3><img src='icons/idea.gif'> Oops, an error?</h3>It seems an error has occured with the forum, contact the administrator to report this issue. (For documentation, MYSQL)<br /><br /><br /><br /><br /></h3>");
         while($row = mysqli_fetch_array($result))  {
         ?>

         <div class="row">
		 <div class="col-lg-12 col-md-12 col-sm-12">
		 <div class="postbit">
		 <div>
			           <?php
           $av = mysqli_query($conn,"SELECT * FROM `members` WHERE `username` = '$row[reply_author]'");
           $av = mysqli_fetch_array($av);
		   if ($av[avatar] == null){ echo "<img src='https://en.gravatar.com/images/gravatars/no_gravatar.gif' class='avatar'>"; } else { 
           echo "<img src='$av[avatar]' class='avatar'>";
           }
         ?>
		 <span class="pull-left">
         <a href="index.php?page=profile&id=<?php echo "$row[reply_author]"; ?>">
         <?php echo "$row[reply_author]"; ?></a>
         </a>
         <br />
         <?php
         $res = mysqli_query($conn,"SELECT * FROM tinybb_replies WHERE reply_author = '$row[reply_author]'");
         $res2 = mysqli_query($conn,"SELECT * FROM tinybb_threads WHERE thread_author = '$row[reply_author]'");
         $posts = mysqli_num_rows($res);
         $topics = mysqli_num_rows($res2);
		 $total = ($posts * $topics);
         echo "$total messages";
         ?>
		 </span>
		 <span class="pull-right text-muted"><?php echo timeAgo(($row['date'])); ?></span>
		 <div style="clear:both;"></div>
		 <br />
		 </div>
		 </div>
		 </div>
		 </div>
		 
		 <div class="row">
		 <div class="col-lg-12 col-md-12 col-sm-12">
		 <div class="postarea">
		 
		
		 <?php echo $purifier->purify($row['reply_content']); ?>
		 <br /><br />

		   <?php if ($user[admin] == "1"){ ?>
		   
         <a href="admin.php?delete&reply=<?php echo "$row[reply_key]"; ?>" class="btn btn-danger btn-sm">
			<span class="glyphicon glyphicon-remove"></span> Delete
		 </a>
         <a href="admin.php?list=edit&type=reply&reply=<?php echo "$row[thread_key]"; ?>" class="btn btn-warning btn-sm">
			<span class="glyphicon glyphicon-pencil"></span> Edit
		 </a>
         <?php } ?>
		 </div>
		 </div>
		 </div>
		 <hr />
         <?php } ?>
		
		 </div>
         <?php
         // The below is calling data from the "data"base and listing it here in an array.
         $result = mysqli_query($conn,"SELECT * FROM tinybb_threads WHERE thread_key ='".addslashes(htmlspecialchars($_GET['post']))."' LIMIT 1") or die("<h3><img src='icons/idea.gif'> Oops, an error?</h3>It seems an error has occured with the forum, contact the administrator to report this issue. (For documentation, MYSQL)<br /><br /><br /><br /><br /></h3>");
         while($row = mysqli_fetch_array($result))  {
           // Version 1.3.2 Edit
         if ($row[thread_lock] == "1"){ die("<br /><strong>Cannot post reply, the thread is locked.</strong>"); }
         }

         // End of edit
         ?>
         <?php if ($_GET['do'] == "reply"){ ?>
         <?php if(($_POST['check']) == $_SESSION['check']) { ?>

                <?php
                // THE THREAD ID RANDOMIZER 
                srand ((double) microtime( )*1000000); $random_number = rand(0,9999999999999);
                $content = mysqli_real_escape_string($conn,$_POST['content']);
                $author = "$user[username]";
                $avatar = addslashes(htmlspecialchars($_POST[avatar]));
                $thread = addslashes(htmlspecialchars($_POST[post]));
                $id = "$random_number";
                $date = date("d-m-Y");
                // To stop page refreshing
                header("Location: ?page=thread&post=$thread#last");
                if ($user[username] != null){
                $sql = "INSERT INTO tinybb_replies
			(
				reply_content,
				reply_author,
				reply_key,
				thread_key, 
				date

			)
			VALUES 
			(
				'$content',
				'$author',
				'$id',
				'$thread',
				'$date'
			)";


		mysqli_query($conn,$sql) or die(mysqli_error());
		mysqli_close($sql);
                } else {
                  echo "You must be logged in to perform this action."; 
                }  
		?>
		<?php unset($_SESSION['check']); ?>
         <?php } else { echo "Spam code entered incorrectly."; } ?>
         <?php } else { ?>
         <?php
         // The below is calling data from the "data"base and listing it here in an array.
         $result = mysqli_query($conn,"SELECT * FROM tinybb_threads WHERE thread_key ='".addslashes(htmlspecialchars($_GET['post']))."' LIMIT 1") or die("<h3><img src='icons/idea.gif'> Oops, an error?</h3>It seems an error has occured with the forum, contact the administrator to report this issue. (For documentation, MYSQL)<br /><br /><br /><br /><br /></h3>");
         while($row = mysqli_fetch_array($result))  {
         ?>
         <?php if ($user[username] == null){ } else { ?>
         <?php if ($row[thread_lock] == "1"){ echo "<br /><div class='warning'>The thread is locked.</div>"; } else { ?>
         <br />
         <h2><img src="icons/edit.gif" border="0"> Reply</h2>
         <form action="?page=thread&do=reply" name="compose" method="POST">
         <input type="hidden" name="post" value="<?php echo "$_GET[post]"; ?>">
		 


         <textarea name='content' id="myArea2" style="width:100%;"></textarea><br />
		 		 <script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
//]]>
</script>
         <img src="icons/smile2.png" onclick="insertit(document.compose.content, ':)');" />
         <img src="icons/bigsmile.png" onclick="insertit(document.compose.content, ':D');" />
         <img src="icons/frown.png" onclick="insertit(document.compose.content, ':(');" />
         <img src="icons/wink.png" onclick="insertit(document.compose.content, ';)');" />
         <img src="icons/blush.png" onclick="insertit(document.compose.content, ':$');" />
         <img src="icons/skywalker.png" onclick="insertit(document.compose.content, ':sw:');" />
         <img src="icons/yawn.png" onclick="insertit(document.compose.content, ':tired:');" />
         <img src="icons/love.png" onclick="insertit(document.compose.content, '(L)');" />
         <img src="icons/angry.png" onclick="insertit(document.compose.content, ':@');" />    
         <img src="icons/underline.png" onclick="insertit(document.compose.content, '[u][/u]');" />
         <img src="icons/italic.png" onclick="insertit(document.compose.content, '[i][/i]');" />    
         <img src="icons/bold.png" onclick="insertit(document.compose.content, '[b][/b]');" />
         <br /><br />
         Spam Protection - Enter the numbers you see below<br />
         <img src="inc/capya.php"> <br>
         <input type="text" size="50" autocomplete="off" name="check"><br /><br>
         <input type="submit" value="Post Reply">
         </form>
         <?php  } } } } ?>

    <?php } ?>
    <a name="last"></a>
	</div>
	
	<div class="col-lg-4">
	<h2>Related Posts</h2>
	<table class="table table-striped">
  <tr>
  <td><a href="#">I've got my award!</a></td>
  </tr>
    <tr>
  <td><a href="#">I've got my award!</a></td>
  </tr>
    <tr>
  <td><a href="#">I've got my award!</a></td>
  </tr>
</table>

	</div>
	</div>
	</div>
