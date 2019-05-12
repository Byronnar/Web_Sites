  
<html>
<head>
<link rel="stylesheet" type="text/css" href=" ../CSS/enrol.css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Enrolment Management</title>
</head>
<?php
include("db_conn.php");
include("session.php");
if($_SESSION['user']==""or $session_access=="" ) 
{
	header('location: ./assign_login_form.php');
}
 else {
    

$query = "SELECT * FROM users WHERE username='$session_user'";
$result = $mysqli->query($query);
$row=$result->fetch_array(MYSQLI_ASSOC);

if($row['access']!='3')
{
echo"You can not access this function!";
 echo'[<a href="assign_management.php">Back</a>]';
die;
}
?>
<body background="../IMG/9.gif">
  <img src="../IMG/5.jpg" id="fimg">
  <td>
<a href="assign_login_form.php" id="link">Log in</a>
</td>
<h1 id="top">Enrolment Management</h1>
<center>
<table>
<tr> 
           
<td><h2><a href="assign_home.html" id="link1">Home Page</a></h2></td> 

<td><h2><a href="assign_post_results.php" id="link">Discussion Board</a></h2></td> 

<td><h2><a href="assign_enrolment.php" id="link">Enrolment</a></h2></td> 

</tr> 
</table>
</center>
        <?php
    

			if(isset($_POST["update"]))
			{
				include('db_conn.php');
				$id=$_POST["id"];
				$username=$_POST["username"];
				$password=$_POST["password"];
                                $encrypt_password=MD5($password);
				$access=$_POST["access"];	
				$query="update users set username='".$username."',password='".$encrypt_password."',access='".$access."'where id='".$id."'";
				$result = $mysqli->query($query);
                        }
		?>
		<?php
		include('db_conn.php');
		$query = "SELECT * FROM users";
		$result = $mysqli->query($query);
			/* the number of rows in the query result */
		$row_count = $result->num_rows;
		echo "<center>";
		echo "Total number of results: $row_count <br/>";
			/* numeric array */
		$result = $mysqli->query($query);
		echo "<table border=1>";     
			echo "<tr><td>ID</td><td>Username</td><td>Password</td><td>Access</td></tr>";
			while($row=$result->fetch_array(MYSQLI_ASSOC))
			{
			 echo "<tr>";
			 echo "<td>".$row["ID"]."</td>";   
			 echo "<td>".$row["username"]." </td>"; 
			 echo "<td>".$row["password"]." </td>";   
			 echo "<td>".$row["access"]." </td>";  
			 echo "</tr>";
 }}
			echo "</table>";
		echo "</center>";
		/* close connection */
		$mysqli->close();
		?>
		<form action="" method="post">
		<hr>
		<p>ID:<br> 
		<input type="text" name="id"></p >
		<p>Usename:<br> 
		<input type="text" name="username"></p >
		<p>Password: <br>
		<input type="text" name="password"></p >
		<p>Access: <br>
		<input type="text" name="access"></p >
		<hr>
		<input type="submit" name="update" value="update">
		<input type="reset" value="Reset"><br>
		</form>