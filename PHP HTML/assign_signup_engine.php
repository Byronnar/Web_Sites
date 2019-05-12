<?php
include("session.php");
include("db_conn.php");
if($_SESSION['user']!="") 
{
	header('location: ./assign_management.php');
}
 else 
 {
$username=$_POST['name'];
$password=$_POST['passone'];
$repassword=$_POST['passtwo'];
$encrypt_password=MD5($password);
$query = "SELECT * FROM users WHERE username='$username'";
$result = $mysqli->query($query);

$row=$result->fetch_array(MYSQLI_ASSOC);
if($username=="" or $password=="") 
{
 header('Location: ./assign_signup_form.php?wrong=Please input your username and password');
}  

elseif($row['username']==$username & $username!="")
{
	
	header('Location: ./assign_signup_form.php?wrong=Username already exists');

	
}
else {
	 	if($repassword!== $password) 
		{
			header('Location: ./assign_signup_form.php?mistake=The retype password shoud be the same as password');
			
		}
		else{
		$query = "INSERT INTO users (username, password, access) VALUES('$username', '$encrypt_password', '4')";
		       $signinresult = $mysqli->query($query);
                       if( $signinresult){
		      echo "<script>alert('sign up successfully');</script>";
		       $session_user=$username;
		       $_SESSION['user']=$session_user;
                       $session_access=4;
                       $_SESSION['access']= $session_access;
                      	$select_query="select * from users where username='$username'";
			$select_result=$mysqli->query($select_query);
			$select_row=$select_result->fetch_array(MYSQLI_ASSOC);
			$session_userid=$select_row['ID'];
			$_SESSION['session_userid']=$session_userid;
			header('Location: ./assign_management.php');   
                }}
 }}
 echo "<hr/>";
?>
