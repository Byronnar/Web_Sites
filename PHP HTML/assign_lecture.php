<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>   
<head>
<link rel="stylesheet" type="text/css" href=" ../CSS/dis.css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Discussion</title>
</head>
<body background="../IMG/9.gif">
    <center><h1 id="top">Discussion Board for Lecture </h1></center>
  <img src="../IMG/5.jpg" id="fimg">  
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
include("db_conn.php");
include("session.php");
$query = "SELECT * FROM users WHERE username='$session_user'";
$result = $mysqli->query($query);
$row=$result->fetch_array(MYSQLI_ASSOC);

if($row['access']!='3')
{
echo'<script language="JavaScript">;alert("You can not access this function!");location.href="assign_management.php";</script>;';
die;
}
?>

      <h2><a href="assign_management.php">Back</a></h2>
<body>
        <h2><a href="assign_post.php?">Post a new thread</a></h2>
       
<?php
	//query for retreiving all the items from the guestbook table (order by the recent items)
	$list_query = "SELECT * FROM post ORDER BY post_ID  DESC";
	//execute the query 'list_query'
	$result= $mysqli->query($list_query);

   	//covert the above result into array (associative array)
   	//keys of the array are the column name
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
    <tr>
   <!-- the below form is for the editing and deleting comments-->
     <tr>  <form action="./trans.php" name="authform" method="POST">
          <input type="submit" name="reply" style="color: black;" value="reply">
         <input type="hidden" name="id" value="<?php echo $postid;?>">
          <input type="hidden" name="access" value="<?php echo $postaccess;?>">
          <input type="hidden" name="user" value="<?php echo $postuser;?>">
            <?php
             if(($session_access>$postaccess&&$session_access!=4)||$session_user==$postuser){
             echo '<input type="submit" name="edit" value="edit" style="color: black;"> ';
             echo '<input type="submit" name="delete" value="delete" style="color: black;">';
             }                                                                       
            ?>
              </form>
            </table>
	                            
 
<?php 
}
?>


</body>
</html>