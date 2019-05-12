<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/up_in.css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title></title>
</head>
<body background="../IMG/9.gif">
  <img src="../IMG/5.jpg" id="fimg">

<center><h1 id="top"> Sign up</h1></center>
<center>
<table>
<tr> 
           
<td><h2><a href="assign_home.html" id="link">Home Page</a></h2></td> 

<td><h2><a href="assign_post_results.php" id="link">Discussion Board</a></h2></td>  

<td><h2><a href="assign_enrolment.php" id="link">Enrolment</a></h2></td> 

</tr> 
</table>
</center>
<center>
<form action="./assign_signup_engine.php" method="post">
    	<table>
        <tr>
            <td>Username: </td>
    	 <td><input name="name" type="text"></td>
 	</tr>
			
			<?php
                      include("session.php");
                      include("db_conn.php");
                       if($_SESSION['user']!="") 
                       {
	                  header('location: ./assign_management.php');
                       }
	

				if(isset($_GET['wrong']))
				{
				$wrongmessage=$_GET['wrong'];
				echo "<script>alert('$wrongmessage');</script>";
				}
                                echo "<hr/>";
			?>	
			<br/>
			
 	<tr>
         <td>Password :</td>
 	 <td><input name="passone" type="password"></td>
        </tr>
	<tr>		
            <td>Retype Password :</td>
 	    	<td><input name="passtwo" type="password"></td>
		 </tr>	
			<?php

				if(isset($_GET['mistake']))
				{
				$mistakemessage=$_GET['mistake'];
				echo "<script>alert('$mistakemessage');</script>";
				}
			?>	
			<br/>
                        <tr>
                              <td><a href="assign_home.html" id="link">Back to Home Page</a></td>
                                  
			 <td><input type="submit"name="signup" value="Sign Up"><input type="submit" name="reset" value="Reset"> </td>
                       
                        </tr>
        </table>
      	</form>
<hr>
</center>
</body>
</html>
