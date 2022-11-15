<?php include('config/db.php')?>
<?php include('config/dbc.php')?>
<?php include("config/user.php");?>
<?php include('config/function.php')?>
<?php include('config/setup.php')?>
<?php include('config/session.php')?>
<?php $pagename = "Dashboard";?>
<?php
	mysqli_set_charset ($dbc,'utf8');
	$nameq = "SELECT * FROM `tbl_name`";
	$namerun = mysqli_query($dbc, $nameq);
	while($namerow=mysqli_fetch_assoc($namerun)){
		$nameid 		= $namerow['name_id'];
		$namename 		= $namerow['name_companyname'];
		$nameaddress 	= $namerow['name_companyaddress'];
	}	
?>
<?php
	mysqli_set_charset ($dbc,'utf8');
	$logoq = "SELECT * FROM `tbl_logo`";
	$logorun = mysqli_query($dbc, $logoq);
	while($logorow=mysqli_fetch_assoc($logorun)){
		$logoid 		= $logorow['logo_id'];
		$logoname 		= $logorow['logo_name'];
		$logoheight 	= $logorow['logo_height'];
		$logowidth 		= $logorow['logo_width'];
	}
?>


<?php
header("Content-Type: application/xls");
	if(isset($_GET['order'])){
	$page_id1 = $_GET['order'];  
	header("Content-Disposition: attachment; filename=$page_id1.xls");  
	}
header("Pragma: no-cache"); 
header("Expires: 0");
echo '<table border="1">';
//make the column headers what you want in whatever order you want
echo '<tr>
		<th>Order ID</th>
		<th>User Name</th>
		<th>Product ID</th>
		<th>Product Name</th>
		<th>Product Description</th>
		<th>Product Order Date</th>
		<th>Quantity</th>
	  </tr>';
//loop the query data to the table in same order as the headers
mysqli_set_charset ($dbc,'utf8');
	if(isset($_GET['order'])){
	$page_id1 = $_GET['order'];
	$cartquery = "SELECT * FROM tbl_cart WHERE`cart_orderid`='$page_id1'";
	$cartrun = mysqli_query($dbc, $cartquery);
	while($cartrow=mysqli_fetch_assoc($cartrun)){
	$cartid 			= mysqli_real_escape_string($dbc, $cartrow['cart_id']);
	$cartproductid 		= mysqli_real_escape_string($dbc, $cartrow['cart_productid']);
	$cartuserid			= mysqli_real_escape_string($dbc, $cartrow['cart_userid']);
	$cartqty 			= mysqli_real_escape_string($dbc, $cartrow['cart_qty']);
	$cartorderstatus	= mysqli_real_escape_string($dbc, $cartrow['cart_orderstatus']);
	$cartorderid		= mysqli_real_escape_string($dbc, $cartrow['cart_orderid']);
	$cartorderplace		= mysqli_real_escape_string($dbc, $cartrow['cart_orderplace']);
							
	mysqli_set_charset ($dbc,'utf8');
	$productq = "SELECT * FROM tbl_products WHERE product_id='$cartproductid'";
	$productrun = mysqli_query($dbc, $productq);
	while($productrow=mysqli_fetch_assoc($productrun)){
	$productpi_id 				= mysqli_real_escape_string($dbc, $productrow['product_id']);
	$productp_name	 			= mysqli_real_escape_string($dbc, $productrow['product_name']);
	$productp_product_shotdec	= mysqli_real_escape_string($dbc, $productrow['product_shotdec']);
	}
	mysqli_set_charset ($dbc,'utf8');
	$pimgq = "SELECT * FROM `tbl_productimage` WHERE `pimg_productid`='$productpi_id'";
	$pimgrun = mysqli_query($dbc, $pimgq);
	while($pimgrow=mysqli_fetch_assoc($pimgrun)){
	$pimg_id  		= $pimgrow['pimg_id'];
	$pimg_name 		= $pimgrow['pimg_name'];
	$pimg_productid = $pimgrow['pimg_productid'];
	}
	mysqli_set_charset ($dbc,'utf8');
	$userq1 = "SELECT * FROM `tbl_users` WHERE `user_id`='$cartuserid'";
	$userrun1 = mysqli_query($dbc, $userq1);
	while($userrow1=mysqli_fetch_assoc($userrun1)){
	$user_id1  		= $userrow1['user_id'];
	$user_name1 	= $userrow1['user_name'];
	$user_image1	= $userrow1['user_image'];
	}						
echo "<tr>
		<td>".$cartorderid."</td>
		<td>".$user_name1."</td>
	  	<td>".$productpi_id."</td>
		<td>".$productp_name."</td>
		<td>".$productp_product_shotdec."</td>
		<td>".$cartorderplace."</td>
		<td>".$cartqty."</td>
	  </tr>";
}}
echo '</table>';
?>