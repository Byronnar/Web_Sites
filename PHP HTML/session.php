<?php
//starting session
session_start();

//if the session for username has not been set, initialise it
if(!isset($_SESSION['user'])){
	$_SESSION['user']="";
}

//save username in the session 
$session_user=$_SESSION['user'];

if(!isset($_SESSION['mode'])){
	$_SESSION['mode']="";
}
$session_edit=$_SESSION['mode'];

//if the session for access has not been set, initialise it
if(!isset($_SESSION['access'])){
	$_SESSION['access']="";
}

//save access in the session 
$session_access=$_SESSION['access'];

if(!isset($_SESSION['session_mode']))
{
$_SESSION['session_mode']="";
}
$session_mode=$_SESSION['session_mode'];

if(!isset($_SESSION['session_postid']))
{
$_SESSION['session_postid']=0;
}
$session_postid=$_SESSION['session_postid'];

if(!isset($_SESSION['session_userid']))
{
	$_SESSION['session_userid']=0;
}

$session_userid=$_SESSION['session_userid'];


?>




