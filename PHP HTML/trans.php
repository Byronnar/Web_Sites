<?php
                include("session.php");
                include("db_conn.php");
                if(isset($_POST['reply']))
                {
                        $_SESSION['session_postid']=$_POST['id'];
                        $session_postid=$_SESSION['session_postid'];
                        $_SESSION['session_mode']="reply";
                        $session_mode=$_SESSION['mode'];
                        header('Location: ./assign_reply.php');
                                                                                                                     
                }

                if(isset($_POST['edit']))
                {
                        $_SESSION['session_postid']=$_POST['id'];
                        $session_postid=$_SESSION['session_postid'];
                                                                               
                        $postaccess=$_POST['access'];
                        $postuser=$_POST['user'];
                    
                        if(($session_access>$postaccess&&$session_access!=4)||($session_user==$postuser)){
                        $_SESSION['session_mode']="edit";
             
                      
                         header('Location: ./assign_post_edit.php');
                        } 
                }

                if(isset($_POST['delete']))
                {
                        $_SESSION['session_postid']=$_POST['id'];
                        $session_postid=$_SESSION['session_postid'];
                        $postaccess=$_POST['access'];
                        $postuser=$_POST['user'];
                        if(($session_access>$postaccess&&$session_access!=4)||($session_user==$postuser)){                                                     
                            $delete_query="delete from post where post_ID='$session_postid'";
                            $delete_result=$mysqli->query($delete_query);
                            if($delete_result){
                                echo "<script>alert('delete successfully');</script>";
                                header('Location: ./assign_post_results.php?error=delete successfully');
                            }else{
                                echo "<script>alert('delete failure, please try again');</script>";
                                header('Location: ./assign_post_results.php.php');
                            }
                        }else{
                            echo "<script>alert('sorry, you don't have the access to delete');</script>";
                            header('Location: ./assign_post_results.php.php');
                        } 
                }
        ?>                