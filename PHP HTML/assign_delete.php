<?php
                include("session.php");
                include("db_conn.php");


                if(isset($_POST['delete']))
                {
   
                        $replyid=$_POST['id'];
                        $replyaccess=$_POST['access'];
                        $replyuser=$_POST['user'];
                        if(($session_access>$replyaccess&&$session_access!=4)||($session_user==$replyuser)){                                                     
                            $delete_query="delete from reply where reply_ID='$replyid'";
                            $delete_result=$mysqli->query($delete_query);
                            if($delete_result){
                                                            header('Location: ./assign_reply.php?error=delete successfully');
                            }else{
                                                            header('Location: ./assign_reply.php?error=delete failure');
                            }
                        }else{

                            header('Location: ./assign_reply.php?error=sorry, you do not have the access to delete');
                        } 
                }
        ?>       