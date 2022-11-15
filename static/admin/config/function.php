<?php
function data_user($dbc, $user_id){
	if(is_numeric($user_id)){
		$q = "SELECT * FROM tbl_users WHERE user_id = '$user_id'";
		} 
		else 
		{
			$q = "SELECT * FROM tbl_users WHERE user_email = '$user_id'";
		}
		$r = mysqli_query($dbc,$q);
			
		$data = mysqli_fetch_assoc($r);
			$data['realname'] = $data['user_name'];
			$data['profile'] = $data['user_image'];
			return $data;
		}
?>