<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>   
<head>
<link rel="stylesheet" type="text/css" href=" ../CSS/dis.css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
  <script src="http://code.jquery.com/jquery-latest.js"></script>
<title>Discussion</title>
</head>
<body background="../IMG/9.gif">
    <center><h1 id="top">Discussion Board for everyone </h1></center>
  <img src="../IMG/5.jpg" id="fimg">  
<center>
<table>
<tr>           
<td><h2><a href="assign_home.html" id="link">Home Page</a></h2></td> 
<td><h2><a href="assign_post_results.php" id="link">Discussion Board</a></h2></td> 
<td><h2><a href="assign_enrolment.php" id="link">Enrolment</a></h2></td> 
</tr> 
</table>
</center>
      <br/>
        <h2 id="i">If you want join in this discussion,welcome log in our site.</h2>
        <h3><a href="assign_signup_form.php?">Sign up</a></h3>
<?php
include("db_conn.php");
include("session.php");
$query = "SELECT * FROM users WHERE username='$session_user'";
$result = $mysqli->query($query);
$row=$result->fetch_array(MYSQLI_ASSOC);

?>
       
<?php
	//query for retreiving all the items from the guestbook table (order by the recent items)
	$list_query = "SELECT * FROM post ORDER BY post_ID  DESC";  //Turn out the curry
	//execute the query 'list_query'
	$result= $mysqli->query($list_query);

   	//covert the above result into array (associative array)
   
   	while($row= $result->fetch_array(MYSQLI_ASSOC)){ 	
   	//extract the values
   	$postid=$row['post_ID'];
   	$post_name=$row['post_name'];
   	$content=$row['content'];
        $userid=$row['users_ID'];
	$picture=$row['pic_name'];
         $reply_query="select COUNT(*) as count from reply where post_ID='$postid'";
                                                        $reply_count=$mysqli->query($reply_query);
                                                        $row_count= $reply_count->fetch_array(MYSQLI_ASSOC);
                                                        $count=$row_count['count'];
         $user_query="select * from users where ID='$userid'";
                                                        $user_result= $mysqli->query($user_query);
                                                        $row_user= $user_result->fetch_array(MYSQLI_ASSOC);
                                                        $postuser=$row_user['username'];
                                                        $postaccess=$row_user['access'];
                                                        
?>
<script>
                                          $("#hide").hide();
                                          $(document).ready(function(){
                                                $("#intro").click(function(){
                                        $("#hide").toggle();

                                });
                        });

                                        $("#post").hide();
                                          $(document).ready(function(){
                                                $("#postbutton").click(function(){
                                        $("#post").toggle();

                                });
                        });
                               
                                     
                                </script>
<br/>
<table id="list">
   <tr>
      <td class="title">post_ID</td>
      <td><?php echo $postid;?></td>     
   </tr>
   <tr>
      <td class="title">post_name</td>
      <td><?php echo $post_name;?></td>
   </tr>
   <tr>
      <td class="title">content</td>         
      <td colspan="3"><?php echo nl2br($content);?></td>
   </tr>
     <tr>
      <td class="title">users_ID</td>         
      <td colspan="3"><?php echo nl2br($userid);?></td>
   </tr>
    <tr>
       <td class="title">Picture</td>
       <td><?php echo "<img id='image0'width='500px' src='{$picture}'/>";  ?></td>
      <tr>
            <td>    
            <form action="" method="POST">
             <input type="hidden" name="id" value="">
                <td colspan="3"></td>
           </form>
       </td>
   </tr>

            </table>
	                            
 
<?php 
}
?>


</body>
</html>