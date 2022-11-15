<?php
	if(isset($_SESSION['afadminuser_id'])){
		$pageid = $_SESSION['afadminuser_id'];
		} else {
			$pageid = 0;
		}
	mysqli_set_charset ($dbc,'utf8'); 	
	$q = "SELECT * FROM tbl_users where user_id= $pageid";
	$r = mysqli_query($dbc, $q);
	$page = mysqli_fetch_assoc($r);
?>