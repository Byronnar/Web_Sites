<?php
include("session.php");
session_destroy();
header('Location: ./assign_login_form.php');
?>
