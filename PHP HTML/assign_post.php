<?php
include("db_conn.php");
include("session.php");
if($_SESSION['user']=="") 
{
	header('location: ./assign_login_form.php');
}?>

<html>
<head>
<link rel="stylesheet" type="text/css" href=" ../CSS/dis.css" media="screen"/>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Post Thread</title>
</head>

<body background="../IMG/9.gif">
  <img src="../IMG/5.jpg" id="fimg">
<h1 id="top1">Post Thread</h1>
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
//database connection
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $content = $_POST['content'];

    $error = "";
    //name validation
    if ($name == "") {
        $error.=" Please type the topic" . "<br/>";
    }
    //comment validation
    if ($content == "") {
        $error.="Please type the content" . "<br/>";
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

            }
        } else 
        {
            $error.="Incorrect file type！"."<br/>";
        }
    }
    if ($error == "") {
        //Escapes special characters in a string for use in an SQL statement
        $content = $mysqli->real_escape_string($content);
        //query for inserting
        $insertquery = "INSERT INTO `post`(`post_name`, `content`, `pic_name`,`users_ID`) "
                . "VALUES ('$name','$content','$filename','$session_userid')";
        //execute the insert query
        $mysqli->query($insertquery);
        //automatically go to list.php
        header('location: ./assign_post_results.php');
    }
}
?>

<html>
    <head>
        <title>Post a new thread</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
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
                    alert("Sorry, the system only supports standard format photos, please re-upload formatting, thank you! !");
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
    </head>
    <body>

        <h1>Post a new thread</h1>
        [<a href="assign_post_results.php">Back to the post resluts</a>]

        <!--form for inserting the comments in the guestbook-->
        <form action="" method="post" enctype="multipart/form-data" name="upform">

            <table id="form">
                <!--row for name field (required field).-->
                <tr>	
                    <td class="label">* Topic</td>
                    <td><input type="text" name="name"/></td>
                </tr>
                <!--row for comments field (required field).-->   
                <tr>
                    <td class="label">* Content</td>
                    <td><textarea name="content" cols="50" rows="10"></textarea></td>
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
                    <td colspan="2" id="submit"><input type="submit" name="submit" value="Submit"></td>
                </tr>

                <!--show error message if there is any.-->
                <tr>
                    <td colspan="2"><?php
			if (isset($error)) {
    			echo $error; 
    } 
			else 
                        echo "*Please type the comments and post topic.";
			?> </td>
                </tr>
            </table>
        </form>
    </body>
</html>