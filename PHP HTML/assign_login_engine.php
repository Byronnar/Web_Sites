<?php
include("session.php");
include("db_conn.php");

$username=$_POST['username'];
$password=$_POST['password'];
$encrypt_password=MD5($password);
$query = "SELECT * FROM users WHERE username='$username'";
$result = $mysqli->query($query);

$row=$result->fetch_array(MYSQLI_ASSOC);

if($row['username']!=$username or $username=="")
{
	
header('Location: ./assign_login_form.php?error=Invalid username');
	
}
else {
	if($row['password']==$encrypt_password) 
        {	
		       $session_user=$row['username'];
		       $_SESSION['user']=$session_user;
                       $session_access=$row['access'];
                       $_SESSION['access']= $session_access;
                       $session_userid=$row['ID'];
		       $_SESSION['session_userid']=$session_userid;
			header('location: ./assign_management.php');
	
	}
	else
        {

header('Location: ./assign_login_form.php?error=Invalid password');

	}
}
?>

