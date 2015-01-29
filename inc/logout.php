<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################
session_start();
include_once"config.php";;
$update = mysqli_query($conn,"UPDATE `members` SET `online` = '' WHERE `username` = '$user[username]';");
session_unset('username');
session_unset('password');
echo "<meta http-equiv='Refresh' content='0; URL=index.php'/>";
?>
