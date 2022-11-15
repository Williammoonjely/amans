<?php 
    session_start();
    $user_role 	= $_SESSION['afadminuser_role'];
	$user_id 	= $_SESSION['afadminuser_id'];
    if(!isset($_SESSION['afadminuser_username']) || $user_role!="admin"){
      header('Location: login.php?err=2');
    }
?>