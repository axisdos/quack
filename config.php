<?php
###################
// TinyBB 1.0 - www.TinyBB.net
// Jake Steele 
###################


error_reporting(E_ERROR | E_WARNING | E_PARSE);

define("IN_FORUM", 1);
@include("inc/version_checker.php");
require_once "lib/3rdparty/smarty/Smarty.class.php";

$tpl = new Smarty;
$tpl->assign('forumtitle', 'TinyBB');
$tpl->assign('username', '');

require_once '/lib/3rdparty/htmlpure/library/HTMLPurifier.auto.php';
$dcm = $_GET['vc'];
$hostname = "localhost";
$data_username = "root"; //database username
$data_password = "lol123"; //database password
$data_basename = "tinybb"; //database name
$conn = mysqli_connect($hostname, $data_username, $data_password, $data_basename);




function timeAgo($timestamp){
    $datetime1=new DateTime("now");
    $datetime2=date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';
    if($diff->y > 0){
        $timemsg = $diff->y .' year'. ($diff->y > 1?"s":'');

    }
    else if($diff->m > 0){
     $timemsg = $diff->m . ' month'. ($diff->m > 1?"s":'');
    }
    else if($diff->d > 0){
     $timemsg = $diff->d .' day'. ($diff->d > 1?"s":'');
    }
    else if($diff->h > 0){
     $timemsg = $diff->h .' hour'.($diff->h > 1 ? "s":'');
    }
    else if($diff->i > 0){
     $timemsg = $diff->i .' minute'. ($diff->i > 1?"s":'');
    }
    else if($diff->s > 0){
     $timemsg = $diff->s .' second'. ($diff->s > 1?"s":'');
    }

$timemsg = $timemsg.' ago';
return $timemsg;
}


?>