<html>
<head>
<link rel="stylesheet" type="text/css" href=" ../CSS/reply.css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Reply area</title>
</head>

<body background="../IMG/9.gif">
  <img src="../IMG/5.jpg" id="fimg">

<h1 id="top">Reply area</h1>
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
include("session.php");
include("db_conn.php");   

     
     
				if(isset($_GET['error']))
				{
				$wrongmessage=$_GET['error'];
				echo "<script>alert('$wrongmessage');</script>";
				}
                                                        //query for retreiving all the items from the guestbook table (order by the recent items)
                                                        $list_query = "SELECT * FROM post where post_ID='$session_postid'";
                                                        //execute the query 'list_query'
                                                        $list_result= $mysqli->query($list_query);
                                                
                                                        //covert the above result into array (associative array)
                                                        //keys of the array are the column name
                                                        $row= $list_result->fetch_array(MYSQLI_ASSOC);
                                                        
                                                        //extract the values
                                                        $userid=$row['users_ID'];
                                                        $postname=$row['post_name'];
                                                        $postcontent=$row['content'];
                                                        $postid=$row['post_ID'];
                                                                

                                                        $user_query="select * from users where ID='$userid'";
                                                        $user_result= $mysqli->query($user_query);
                                                        $row_user= $user_result->fetch_array(MYSQLI_ASSOC);
                                                        $postuser=$row_user['username'];
                                                        $postaccess=$row_user['access'];
                                                        

                                                ?>    
        <section class="container-fluid" id="four">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h2 class="text-center text-primary" style="color: white;"><?php  echo $postname;  ?></h2>
                <hr>
                <div class="media wow fadeInRight">
                    
                    <div class="media-body media-middle">
                     
                          <h2 id="reply">The post content:</h2> <hr>
                           <center>
                                 <h2 id="reply"><?php     echo $postcontent;      ?></h2>
                      </center>
               
                    </div>
                 
                </div>
                <hr>
            </div>
        </div>
<?php
       
        $list_query = "SELECT * FROM reply";
	//execute the query 'list_query'
	$result= $mysqli->query($list_query);

   	//covert the above result into array (associative array)
   	//keys of the array are the column name
   	while($row= $result->fetch_array(MYSQLI_ASSOC))
      { 
        $id=$row['reply_ID'];  
      }
?>
 <?php
 if(isset($_POST['submit']))
    {
    $comments=$_POST['comments'];   
    //stting the error message
    $error="";
           
    //comment validation
    if($comments=="")
    {
    	$error.="Please type the conments"."<br/>";
    }
    if ($_FILES["file"]["error"]) {
        echo $_FILES["file"]["error"];
    } else {
        //Control upload file type, size.
        if (($_FILES["file"]["type"] == "image/jpeg" 
                || $_FILES["file"]["type"] == "image/png" 
                || $_FILES["file"]["type"] == "image/jpg"
                || $_FILES["file"]["type"] == "image/bmp"
                || $_FILES["file"]["type"] == "image/gif") 
                && $_FILES["file"]["size"] < 10240000) {
            //Find the location of the file
            $filename = "./file/" . date("YmdHis") . $_FILES["file"]["name"];

            //Convert encoding format
            $filename = iconv("UTF-8", "gb2312", $filename);

          
            if (file_exists($filename)) {
                $error.="The file has already existed!"."<br/>";
            } else {
            
                move_uploaded_file($_FILES["file"]["tmp_name"], $filename);

                $sql = "INSERT INTO `post`(`pic_name`) "
                        . "VALUES ('$filename')";
            }
        } else 
        {
            $error.="Incorrect file type！"."<br/>";
        }
    }
 if($error=="")
       {
       $comments = $mysqli->real_escape_string($comments);
    	//query for inserting
    	$insertquery="INSERT INTO reply (comments,users_ID,post_ID,pic_name) VALUES ('$comments','$session_userid','$session_postid','$filename')";
    	//execute the insert query
    	$signinresult =$mysqli->query($insertquery);   
     
		header('location: ./assign_reply.php');
        }
		}	
                ?>
            

</head>
 <script type="text/javascript">
            function F_Open_dialog()
            {
                document.getElementById("btn_file").click();
            }
            function PreviewImage(imgFile) {
                var filextension = imgFile.value.substring(imgFile.value
                        .lastIndexOf("."), imgFile.value.length);
                filextension = filextension.toLowerCase();
                if ((filextension != '.jpg') && (filextension != '.gif')
                        && (filextension != '.jpeg') && (filextension != '.png')
                        && (filextension != '.bmp')) {
                    alert("Sorry, the system only supports standard format photos, please re-upload formatting, thank you!");
                    imgFile.focus();
                } else {
                    var path;
                    if (document.all)//IE
                    {
                        imgFile.select();
                        path = document.selection.createRange().text;
                        document.getElementById("photo_info").innerHTML = "";
                        document.getElementById("photo_info").style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\""
                                + path + "\")";//使用滤镜效果  
                    } else//FF
                    {
                        path = window.URL.createObjectURL(imgFile.files[0]);// FF 7.0以上
                        //path = imgFile.files[0].getAsDataURL();// FF 3.0
                        document.getElementById("photo_info").innerHTML = "<img id='img1' width='120px' height='100px' src='" + path + "'/>";
                        //document.getElementById("img1").src = path;
                    }
                }
            }

        </script>
<body>

	<h2>Add your ideas:</h2>
        [<a href="assign_post_results.php">Back to the comments lists</a>]

	<!--form for inserting the comments in the guestbook-->
        <form action="" method="post" enctype="multipart/form-data" name="upform">
	
	<table id="form">
		<!--row for name field (required field).-->

		<tr>	
   			<td class="label">* Reply_ID</td>
                        <td><input type="text" name="name"value="<?php echo $id; ?>"disabled/></td>
      	       </tr>
               <tr>	
   			<td class="label">* Post_ID</td>
      		<td><?php echo $session_postid; ?><input type="hidden" name="post_ID" value="<?php echo $session_postid;?>"></td>
      	       </tr>

   		<!--row for comments field (required field).-->   
   		<tr>
	   		<td class="label">* Comments</td>
    	  <td><textarea name="comments" cols="50" rows="10"  name="mypost"placeholder="Put your question here.."></textarea></td>
   		</tr>	
 <tr>
                    <td class="label">Picture</td>
                    <td><div class="col-sm-10">
                            <span class="btn btn-success btn-file"> <span
                                    class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                                <input type="file" name="file" value="" id="info_photo"
                                       onchange='PreviewImage(this)' />
                            </span>
                        </div><br>
                        <div id="photo_info" class="photo_info"></div>

                    </td>
                </tr>
                <!--row for submit button.-->
                <tr>
                    <td colspan="2" id="submit"><input type="submit" name="submit" value="submit"></td>
                </tr>

                <!--show error message if there is any.-->
                               
    	<!--show error message if there is any.-->
    	<tr>
    		<td colspan="2">
			<?php
			if (isset($error)) {
    			echo $error; 
			} 
			else 
                        echo "*";
			?> 
			</td>
    	</tr>
	</table>
	</form>
         <?php
                                                        //query for retreiving all the items from the guestbook table (order by the recent items)
                                                        $replylist_query = "SELECT * FROM reply where post_ID='$session_postid' order by reply_ID";
                                                        //execute the query 'list_query'
                                                        $replylist_result= $mysqli->query($replylist_query);
                                                
                                                        //covert the above result into array (associative array)
                                                        //keys of the array are the column name
                                                        while($row= $replylist_result->fetch_array(MYSQLI_ASSOC)){
                                                        
                                                        //extract the values
                                                        $userid=$row['users_ID'];
                                                        $replycomments=$row['comments'];
                                                        $replyid=$row['reply_ID'];
                                                        $replytime=$row['updated_time'];
                                                        $picture=$row['pic_name'];       
                                                        
                                                        $user_query="select * from users where ID='$userid'";
                                                        $user_result= $mysqli->query($user_query);
                                                        $row_user= $user_result->fetch_array(MYSQLI_ASSOC);
                                                        $replyuser=$row_user['username'];
                                                        $replyaccess=$row_user['access'];
                                                        
                                                
                                                
                                                        //printing out with list :) 	
                                                ?>
         
                                                <hr/>
                                                
                                                <div class="row">
              <div class="col-md-offset-5">
                                                <ol class="commentlist">
                                                      
                                                   
                                                        <div class="comment-meta">                                                                
                                                                 <p id="reply">The user:<?php echo $replyuser;?>-Reply</a></p>
                                                              <p id="reply">Time:<?php echo $replytime;?></p>
                                                                 <p>
                                                                         <div>
                                                                               Content: <?php echo $replycomments;?>
                                                                        </div>
                                                                     <tr>
                                                    <td class="title">Picture</td>
                                                 <td><?php echo "<img id='image0'width='500px' src='{$picture}'/>";?></td>
                                                       </tr>
                                                              
                                                                <p>
                                                                <form action="assign_delete.php" name="authform" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $replyid;?>">
                                                                        <input type="hidden" name="access" value="<?php echo $replyaccess;?>">
                                                                        <input type="hidden" name="user" value="<?php echo $replyuser;?>">
                                                                    
                                                                        <?php
                                                                        if(($session_access>$replyaccess&&$session_access!=4)||($session_user==$replyuser)){
                                                                               
                                                                                echo '<input type="submit" style="color: black;" name="delete" value="delete">';
                                                                        }
                                                                        
                                                                        ?>
                                                                       
                                                                </form>
                                                                </p>
                                                        </div>
      
                                                </div>
                                                <?php
                                                
                                                }
                                                ?>  
                                                </div>
      
    </section>
    </td>
                                                </tr>
                                                </table>
                                                </div>
                                              
                  
                  
                  
                </div>
              
              
              
              
            </div>
        </div>
    </section>

</html>