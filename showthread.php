<?php
include "config.php";

if(!defined("IN_FORUM")){
	die("No FORUM init");
}

$tpl->display('lib/tpl/showthread.tpl');



?>
