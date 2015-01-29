<?php if ($user[username] == ""){ echo "Please login to create a thread."; } else { ?>
<div class="container">
<div class="row">
<div class="col-lg-12">
<?php
      // TINYBB 1.3 UPDATE CODE
      // Check if the category exists, if it doesn't.. DIE and provide error....

      if ($_GET['do'] == "create"){ 
        $catid = clean($_POST[cat]);
      } else {
      $catid = clean($_GET[cat]);
      }
      $check_category = mysqli_query($conn,"SELECT * FROM `tinybb_categories` WHERE `cat_id` = '$catid'") or die(mysqli_error());
      if(mysqli_num_rows($check_category) == 0){
        die("<h2><img src='icons/idea.gif' border='0'> Boom! Error...</h2>The category you're attempting to post this thread in doesn't exist...");
      }
      $sql = mysqli_query($conn,"SELECT * FROM `tinybb_categories` WHERE `cat_id` = '$catid'");
      $checker = mysqli_fetch_array($sql);
      if (($checker[cat_admin] == "1") && (!$user[admin] == "1")) {  die("<h2><img src='icons/idea.gif' border='0'> \%\^\*\$\! Error...</h2>The category you're attempting to post this thread in is for staff only..."); }
      ?>

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
// Configuration include files
	// Check if the user is logged in
	?>
    <?php if ($_GET['do'] == "create"){ ?>
    <?php if(($_POST['check']) == $_SESSION['check']) {
      

                // THE THREAD ID RANDOMIZER
                         srand ((double) microtime( )*1000000); $random_number = rand(0,9999999999999);
                $title = trim(addslashes(htmlspecialchars($_POST[title])));
                $content = trim(addslashes(htmlspecialchars($_POST[content])));
                $author = "$user[username]";
                $id = "$random_number";
                $date = date("d-m-Y");
                $cat = clean($_POST[cat]);
                $order = date ("d-m-Y H:m");
                if(empty($title)) {
                echo "Something was left blank, go back and try again!";
                } elseif(empty($content)) {  echo "Something was left blank, go back and try again!"; } else {
				
                // To stop page refreshing
                header("Location: ?page=thread&post=$random_number");
                $sql = "INSERT INTO tinybb_threads
			(
			        thread_title,
				thread_content,
				thread_author,
				thread_key,
				date,
				cat_id

			)
			VALUES 
			(
				'$title',
                                '$content',
				'$author',
				'$id',
				'$date',
				'$catid'
			)";

		mysqli_query($conn,$sql) or die(mysqli_error());
		mysqli_close($sql);
		?>
		<?php unset($_SESSION['check']); ?>
		<?php } } else { echo "Spam code entered incorrectly."; } ?>
		<?php } else { ?>
		
		<?php
		$catid = clean($_GET['cat']);
                $cat = mysqli_query($conn,"SELECT * FROM `tinybb_categories` WHERE `cat_id` = '$catid'");
                $checker = mysqli_fetch_array($cat);
                echo "<img src='icons/idea.gif' border='0'> Creating new thread in <strong>$checker[cat_title]</strong><br /><br />";
                ?>
		
         <form action="?page=addthread&do=create" name="compose" method="POST" role="form">
         <input type="hidden" name="cat" value="<?php echo "$_GET[cat]"; ?>">
		 <div class="form-group">
         <label>Subject</label>
         <input type="text" name="title" size="50" autocomplete="off" class="form-control">
		 </div>
		 <div class="form-group">
		 <label>Message</label>
         <textarea cols=70 rows=5 maxlength='1000' name='content' class="form-control"></textarea>
		 <span class="text-muted">HTML is allowed (including YouTube embed)</span>
		 </div>
		 <hr />
		 <div class="form-group">
         Spam Protection - Enter the numbers you see below<br />
         <label><img src="inc/capya.php" /></label>
         <input type="text" size="50" autocomplete="off" name="check" class="form-control">
		 </div>
		 <div class="form-group">
         <input type="submit" value="Post Thread" class="btn btn-primary">
		 </div>
         </form>

		<?php } ?>

    <?php
	// End thread code
	}
	?>
    <br />
	</div>
	</div>
	</div>