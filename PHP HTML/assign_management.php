<html>
<head>
<link rel="stylesheet" type="text/css" href="../CSS/up_in.css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php
include("session.php");
include("db_conn.php");

  ?>


<body background="../IMG/9.gif">
<center>
<h1 id="top">Successfully Login</h1>
</center>
  <img src="../IMG/5.jpg" id="fimg">

        <h3>You have successfully Login in</h3>
    
    <?php     
    echo $session_user;      //Choose the user who signed in.
    echo "<hr/>";
    ?>
<a href="./assign_logout.php">Logout</a>
<br/><br/>
<center>
<table>
<tr> 
           
<td><h2><a href="assign_home.html" id="link">Home Page</a></h2></td> 

<td><h2><a href="assign_post_results.php" id="link">Discussion Board</a></h2></td> 

<td><h2><a href="assign_enrolment.php" id="link">Enrolment</a></h2></td> 

</tr> 
</table>
</center>
<h3 id="in">Click the pictuer,you can go to post or read posts.</h3>
<center>

<div id="left">
    <div id="word1">Lecture</div>
    <a href="assign_lecture.php"><img id="image1" src="../IMG/1.jpg"/></a>

</div>

<div id="middle">
    <div id="word2">Tutor</div>
<a href="assign_tutor.php"><img id="image2" src="../IMG/6.jpg"/></a>

</div>

<div id="right">
    <div id="word3">Student</div>
<a href="assign_student.php"><img id="image3" src="../IMG/3.jpg"/></a>

</div>
</center>

</body>
</html>