<?php
      $catid = clean($_GET[cati]);
      $check_category = mysqli_query($conn,"SELECT * FROM `tinybb_categories` WHERE `cat_id` = '$catid'") or die(mysqli_error());
      if(mysqli_num_rows($check_category) == 0){
        die("<h2><img src='icons/idea.gif' border='0'> Boom! Error...</h2>The category you're attempting to view doesn't exist...");
      }
?>
<style>
.paginate {
font-family:Arial, Helvetica, sans-serif;
	padding: 3px;
	margin: 3px;
}

.paginate a {
	padding:2px 5px 2px 5px;
	border:1px solid #999;
	text-decoration:none;
	color: #000;
}
.paginate a:hover, .paginate a:active {
	border: 1px solid #999;
	color: #000;
}
.paginate span.current {
	padding: 2px 5px 2px 5px;
		border: 1px solid #999;
		
		font-weight: bold;
		background-color: #999;
		color: #000;
	}
	.paginate span.disabled {
		padding:2px 5px 2px 5px;
		margin:2px;
		border:1px solid #eee;
		color:#fff;
	}

	ul{margin:6px;
	padding:0px;}	

</style>
<?php
        // PAGINATION SCRIPT CREDITS
        // http://papermashup.com/easy-php-pagination/
	$tableName="tinybb_threads";
	$targetpage = "index.php?page=cat&cati=$catid";
	$limit = $bbsetting[tinybb_list_amount];

	$query = "SELECT COUNT(*) as num FROM $tableName WHERE `cat_id` = '$catid'";
	$total_pages = mysqli_fetch_array(mysqli_query($conn,$query));
	$total_pages = $total_pages[num];
	
	$stages = 3;
	$page = mysqli_real_escape_string($conn,$_GET['c']);
	if($page){
		$start = ($page - 1) * $limit; 
	}else{
		$start = 0;	
		}	
	
    // Get page data
	$query1 = "SELECT * FROM $tableName WHERE `cat_id` = '$catid' ORDER BY ABS(`aid`) DESC LIMIT $start, $limit";
	$result = mysqli_query($conn,$query1);
	
	// Initial page num setup
	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
	

	
	
		$paginate .= "<div class='paginate'>";
		// Previous
		if ($page > 1){
			$paginate.= "<a href='$targetpage&c=$prev'>previous</a>";
		}else{
			$paginate.= "";	}
			

		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='current'>$counter</span>";
				}else{
					$paginate.= "<a href='$targetpage&c=$counter'>$counter</a>";}
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&c=$counter'>$counter</a>";}
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage&c=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage&c=$lastpage'>$lastpage</a>";
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='$targetpage&c=1'>1 </a>";
				$paginate.= "<a href='$targetpage&c=2'>2 </a>";
				$paginate.= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&c=$counter'>$counter</a>";}
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage&c=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage&c=$lastpage'>$lastpage</a>";
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='$targetpage&c=1'>1 </a>";
				$paginate.= "<a href='$targetpage&c=2'>2 </a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&c=$counter'>$counter</a>";}
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a href='$targetpage&c=$next'>next</a>";
		}else{
			$paginate.= "";
			}
			
		$paginate.= "</div>";		
	
	
}echo "";
?>
<?php
      $cat = mysqli_query($conn,"SELECT * FROM `tinybb_categories` WHERE `cat_id` = '$catid'");
      $checker = mysqli_fetch_array($cat);               
      if(@mysqli_num_rows($cat) == 0){
        $category = "Unknown";
      } else {
        $category = "$checker[cat_title]";
      }
      echo "<span style=\"line-height:31px;\"><img src='icons/idea.gif' border='0'> Currently Browsing <strong>$category</strong></span>";
?>
<?php if (!$user[username] == ""){ ?><span style="float:right"> <a class="btn btn-primary" href="index.php?page=addthread&cat=<?php echo $_GET[cati]; ?>">Create a thread</a><br /></span><?php } ?><br /><br />
<?php  echo $paginate; ?>
<table class="table table-striped">
<th></th>
<th>Title</th>
<th>Author</th>
<th>Latest Comment</th>
<th></th>
<?php
 while($row = mysqli_fetch_array($result))
		{
                  ?>
                            
                            <tr>
                            <td><?php if ($row[thread_lock] == "1"){ echo "<img src='icons/lock.gif' border='0'>"; } else { ?><img src='icons/none.gif' border='0'><?php } ?></td>
                            <td><a href="thread/<?php echo "$row[thread_key]"; ?>"><?php $title = stripslashes($row[thread_title]); echo "$title"; ?></a></td>
                            <td><a href="?page=profile&id=<?php echo "$row[thread_author]"; ?>"><?php echo "$row[thread_author]"; ?></a></td>
                            <td>
                            
 <?php
$sql2 = "SELECT * FROM tinybb_replies WHERE thread_key = '$row[thread_key]' ORDER BY aid DESC LIMIT 1";
$tt = mysqli_query($conn,$sql2) or die (mysqli_error());
while($p=mysqli_fetch_assoc($tt)){
  if ($p['reply_key'] == 0){ echo "No Replies"; } 
echo "<a href=\"?page=profile&id=".$p['reply_author']."\">".$p['reply_author']."</a>";
}

                                $result3 = mysqli_query($conn,"SELECT * FROM tinybb_replies WHERE thread_key = '$row[thread_key]'");
                                $rthreads = mysqli_num_rows($result3);
                                if ($rthreads == "0"){ echo "No Replies"; }


?>


                            </td>
                            <td align="center">
                            <?php
                            $result4 = mysqli_query($conn,"SELECT * FROM tinybb_replies WHERE thread_key = '$row[thread_key]'");
                            $treplies = mysqli_num_rows($result4);
                            echo "<strong>$treplies</strong> replies";
                            ?>
                            </td>
                            </tr>

                  <?php } ?>
                  </table>
<center>
<br /><br />

</center>
</tr></td>
</table>
                  <br /><br />







