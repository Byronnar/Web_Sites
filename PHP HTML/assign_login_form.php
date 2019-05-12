<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../CSS/up_in.css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>assign_login</title>
</head>

<body background="../IMG/9.gif">
  <img src="../IMG/5.jpg" id="fimg">
<h1 id="top"> LOGIN </h1>
<center>
<table>
<tr> 
           
<td><h2><a href="assign_home.html" id="link">Home Page</a></h2></td> 

<td><h2><a href="assign_post_results.php" id="link">Discussion Board</a></h2></td> 

<td><h2><a href="assign_enrolment.php" id="link">Enrolment</a></h2></td> 

</tr> 
</table>
</center>

<?php
include("session.php");
include("db_conn.php");
if($_SESSION['user']!="") 
{
	header('location: ./assign_management.php');
}
if(isset($_GET['error']))
{
	$errormessage=$_GET['error'];
	echo "<script>alert('$errormessage');</script>";
        echo "<hr/>";
}
?>	
    <br/>
    	
	<h2 id="h2">Please login to the system</h2>
	
        <form action="./assign_login_engine.php"method='post'>
            <center>
	    <table>
			<tr>
				<td id="text">Username :</td><td><input name="username" type="text" ></td>
			</tr>
			<tr>
				<td id="text">Password :</td><td><input name="password" type="password"</td>
                        </tr>  
            <br/>
                         <tr>     
				<td id="text"><input type="submit" name="submit" value="Sign In"></td>
                                <td id="text"><a href="assign_signup_form.php">Sign Up</a></td>
			</tr>     
			
   		</table>
                </center>
            <br/>
	</form>
<div align="center"><img src="../IMG/4.jpg" width="460" height="360"/></div>
</body>
</html>

