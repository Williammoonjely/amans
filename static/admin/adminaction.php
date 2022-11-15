<?php
require 'config/dbc.php';
if(isset($_POST['NewProduct'])){
	
	$product_name 		= mysqli_real_escape_string($dbc, $_POST['productname']);
	$product_catid 		= mysqli_real_escape_string($dbc, $_POST['productcategory']);
	$product_shotdec 	= mysqli_real_escape_string($dbc, $_POST['productshotdec']);
	$product_summery 	= mysqli_real_escape_string($dbc, $_POST['productsummery']);
	$product_status 	= mysqli_real_escape_string($dbc, $_POST['productstatus']);
	$product_adddate 	= mysqli_real_escape_string($dbc, $_POST['productadddate']);
	$product_accessuser = mysqli_real_escape_string($dbc, $_POST['productadduser']);
	
	$post_image = $_FILES['productimage']['name'];
	$image_tmp= $_FILES['productimage']['tmp_name'];
	
	$sepext = explode('.', strtolower($_FILES['productimage']['name']));
	$type = end($sepext); 
	$allowtype = array('.jpg', '.jpeg', '.png' );
	$uploadDir = "../uploads/";
	$imagefirstname = "AMANSPRODUCT";
	$imagelastname = "IMG";
	$fileName = $imagefirstname.'_'.time().'_'.basename($imagelastname).'.'.$type;
	$targetPath = $uploadDir. $fileName;

	$err ='';
	
	if(!in_array($type, $allowtype))
	{
		if($err == '')
		{
			if(move_uploaded_file($_FILES['productimage']['tmp_name'], $targetPath))
			{
				$productsql = "INSERT INTO `tbl_products`
				(`product_catid`, `product_name`, `product_shotdec`, `product_summery`, `product_adddate`, `product_accessuser`, `product_status`) VALUES 
				('$product_catid', '$product_name','$product_shotdec','$product_summery', '$product_adddate', '$product_accessuser', '$product_status')";
				if(mysqli_query($dbc, $productsql))
				{
					$last_id = mysqli_insert_id($dbc);
					$productimgsql = "INSERT INTO `tbl_productimage`(`pimg_name`, `pimg_productid`) VALUE('$fileName', '$last_id')";
					if(mysqli_query($dbc, $productimgsql))
					{
						echo "<script>alert('Your Product Added Successfully')</script>";
						echo "<script>window.open('product.php','_self')</script>";
					}
					else
					{
						echo "<script>alert('Something Wrong in img upload')</script>";
						echo "<script>window.open('product.php','_self')</script>";
					}
				}
				else
				{
					echo "<script>alert('Something Wrong in data')</script>";
					echo "<script>window.open('product.php','_self')</script>";
				}
			}
			else
			{
				echo "<script>alert('Error In Image Uplaod')</script>";
				echo "<script>window.open('product.php','_self')</script>";
			}
		}
		
	}
	else
	{
		echo "<script>alert('The Uploaded file not has the allowed extension type. Please Upload .jpg, .jpeg, .png file type.')</script>";
		echo "<script>window.open('product.php','_self')</script>";
	}
}


if(isset($_GET['publish'])){
	$publish		= mysqli_real_escape_string($dbc, $_GET['publish']);
	
	$productpublish = "UPDATE `tbl_products` SET `product_status`='1' WHERE `product_id`='$publish'";
	if(mysqli_query($dbc, $productpublish))
	{
		echo "<script>alert('Product Published')</script>";
		echo "<script>window.open('product.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('product.php','_self')</script>";
	}
}

if(isset($_GET['unpublish'])){
	$unpublish		= mysqli_real_escape_string($dbc, $_GET['unpublish']);
	
	$productunpublish = "UPDATE `tbl_products` SET `product_status`='0' WHERE `product_id`='$unpublish'";
	if(mysqli_query($dbc, $productunpublish))
	{
		echo "<script>alert('Product Unpublish')</script>";
		echo "<script>window.open('product.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('product.php','_self')</script>";
	}
}

if(isset($_POST['ProductEdit'])){
	$productname 			= mysqli_real_escape_string($dbc, $_POST['productname']);
	$productcategory 		= mysqli_real_escape_string($dbc, $_POST['productcategory']);
	$productshotdec 		= mysqli_real_escape_string($dbc, $_POST['productshotdec']);
	$productsummery 		= mysqli_real_escape_string($dbc, $_POST['productsummery']);
	$productupdateddate 	= mysqli_real_escape_string($dbc, $_POST['productupdateddate']);
	$productadduser 		= mysqli_real_escape_string($dbc, $_POST['productadduser']);
	
	
	$productid 		= mysqli_real_escape_string($dbc, $_POST['productid']);
	
	
	$editproductsql = "UPDATE `tbl_products` SET 
	`product_name`='$productname',
	`product_catid`='$productcategory',
	`product_shotdec`='$productshotdec',
	`product_summery`='$productsummery',
	`product_updatedate`='$productupdateddate',
	`product_accessuser`='$productadduser',
	`product_status`='0'
	 WHERE `product_id`='$productid'";
	
	if(mysqli_query($dbc, $editproductsql))
	{
		echo "<script>alert('Product Details Updated Sucessfully')</script>";
		echo "<script>window.open('product.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('product.php','_self')</script>";
	}
}


if(isset($_POST['EditPImage'])){
	$productid 		= mysqli_real_escape_string($dbc, $_POST['productid']);
	
	
	$product_image 	= $_FILES['pvimage']['name'];
	$image_tmp		= $_FILES['pvimage']['tmp_name'];
		
	$product_sepext 			= explode('.', strtolower($_FILES['pvimage']['name']));
	$product_type 				= end($product_sepext); 
	$product_allowtype 			= array('jpg', 'jpeg', 'png', 'webp');
	$product_uploadDir 			= "../uploads/";
	$product_imagefirstname 	= "AMANSPRODUCT";
	$product_imagelastname 		= "IMG";
	$product_fileName 			= $product_imagefirstname.'_'.time().'_'.basename($product_imagelastname).'.'.$product_type;
	$product_targetPath 		= $product_uploadDir. $product_fileName;
	
	$product_err				='';
	
	if(!in_array($product_type, $product_allowtype)) 
		$product_err .= 'Please Upload .jpg, .jpeg, .png, webp file type.';
		if($product_err == '')
		{
			if(move_uploaded_file($_FILES['pvimage']['tmp_name'], $product_targetPath))
			{
				$productvarentimage = "INSERT INTO `tbl_productimage`(`pimg_name`, `pimg_productid`) VALUES ('$product_fileName','$productid')";
				if(mysqli_query($dbc, $productvarentimage))
				{
					echo "<script>alert('Product New Image Uploaded Successfully')</script>";
					echo "<script>window.open('product-image.php?product=$productid','_self')</script>";
				}
				else
				{
					echo "<script>alert('Error in uploading')</script>";
					echo "<script>window.open('product-image.php?product=$productid','_self')</script>";
				}
			}
		}
		else
		{ 
			echo "<script>alert('$post_err')</script>";
			echo "<script>window.open('product-image.php?product=$productid','_self')</script>";
		}
}


if (isset($_GET['ImageRemove'])){
	$delete_id = $_GET['ImageRemove'];
	$delete_query = "DELETE FROM `tbl_productimage` WHERE `pimg_id`='$delete_id'";
				 
		if(mysqli_query($dbc,$delete_query)){
		
			echo "<script>alert('Image Removed')</script>";
			echo "<script>window.open('product.php','_self')</script>";
		}
}

if(isset($_POST['NewVendor'])){
	$vendorname 		= mysqli_real_escape_string($dbc, $_POST['vendorname']);
	
	$vendor_image 	= $_FILES['vendorlogo']['name'];
	$image_tmp		= $_FILES['vendorlogo']['tmp_name'];
		
	$vendor_sepext 			= explode('.', strtolower($_FILES['vendorlogo']['name']));
	$vendor_type 			= end($vendor_sepext); 
	$vendor_allowtype 		= array('jpg', 'jpeg', 'png', 'webp');
	$vendor_uploadDir 		= "../uploads/";
	$vendor_imagefirstname 	= "AMANSVENDOR";
	$vendor_imagelastname 	= "IMG";
	$vendor_fileName 		= $vendor_imagefirstname.'_'.time().'_'.basename($vendor_imagelastname).'.'.$vendor_type;
	$vendor_targetPath 		= $vendor_uploadDir. $vendor_fileName;
	
	$vendor_err			='';
	
	if(!in_array($vendor_type, $vendor_allowtype)) 
		$vendor_err .= 'Please Upload .jpg, .jpeg, .png, webp file type.';
		if($vendor_err == '')
		{
			if(move_uploaded_file($_FILES['vendorlogo']['tmp_name'], $vendor_targetPath))
			{
				$vendorimage = "INSERT INTO `tbl_vendor`(`vendor_name`, `vendor_logo`) VALUES ('$vendorname','$vendor_fileName')";
				if(mysqli_query($dbc, $vendorimage))
				{
					echo "<script>alert('New Vendor Uploaded Successfully')</script>";
					echo "<script>window.open('vendors.php','_self')</script>";
				}
				else
				{
					echo "<script>alert('Error in uploading')</script>";
					echo "<script>window.open('vendors.php','_self')</script>";
				}
			}
		}
		else
		{ 
			echo "<script>alert('$vendor_err')</script>";
			echo "<script>window.open('vendors.php','_self')</script>";
		}
	
	
}

if(isset($_GET['VendorDelete'])){
	$VendorDelete		= mysqli_real_escape_string($dbc, $_GET['VendorDelete']);
	
	$VendorDelete = "DELETE FROM `tbl_vendor` WHERE `vendor_id` ='$VendorDelete'";
	if(mysqli_query($dbc, $VendorDelete))
	{
		echo "<script>alert('Vendor Removed Sucessfully')</script>";
		echo "<script>window.open('vendors.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('vendors.php','_self')</script>";
	}
}

if(isset($_POST['NewClient'])){
	$NewClient		= mysqli_real_escape_string($dbc, $_POST['client']);
	
	$ClientInsert = "INSERT INTO `tbl_clients`(`client_vendorid`, `client_status`) VALUES ('$NewClient','1')";
	if(mysqli_query($dbc, $ClientInsert))
	{
		echo "<script>alert('Client Added Sucessfully')</script>";
		echo "<script>window.open('clients.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('clients.php','_self')</script>";
	}
}

if(isset($_GET['ClientDelete'])){
	$ClientDelete		= mysqli_real_escape_string($dbc, $_GET['ClientDelete']);
	
	$ClientDelete = "DELETE FROM `tbl_clients` WHERE `client_id` ='$ClientDelete'";
	if(mysqli_query($dbc, $ClientDelete))
	{
		echo "<script>alert('Client Removed Sucessfully')</script>";
		echo "<script>window.open('clients.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('clients.php','_self')</script>";
	}
}

if(isset($_GET['DisableClient'])){
	$DisableClient		= mysqli_real_escape_string($dbc, $_GET['DisableClient']);
	
	$DisableClient = "UPDATE `tbl_clients` SET `client_status`='0' WHERE `client_id`='$DisableClient'";
	if(mysqli_query($dbc, $DisableClient))
	{
		echo "<script>alert('Client Disabled Sucessfully')</script>";
		echo "<script>window.open('clients.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('clients.php','_self')</script>";
	}
}

if(isset($_GET['EnableClient'])){
	$EnableClient		= mysqli_real_escape_string($dbc, $_GET['EnableClient']);
	
	$EnableClient = "UPDATE `tbl_clients` SET `client_status`='1' WHERE `client_id`='$EnableClient'";
	if(mysqli_query($dbc, $EnableClient))
	{
		echo "<script>alert('Client Enabled Sucessfully')</script>";
		echo "<script>window.open('clients.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('clients.php','_self')</script>";
	}
}

if(isset($_POST['AddNewCategory'])){
	$AddNewCategory		= mysqli_real_escape_string($dbc, $_POST['catname']);
	
	$AddNewCategory = "INSERT INTO `tbl_category`(`category_name`, `category_status`) VALUES ('$AddNewCategory','1')";
	if(mysqli_query($dbc, $AddNewCategory))
	{
		echo "<script>alert('Category Added Sucessfully')</script>";
		echo "<script>window.open('categories.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('categories.php','_self')</script>";
	}
}

if(isset($_GET['Disablecat'])){
	$Disablecat		= mysqli_real_escape_string($dbc, $_GET['Disablecat']);
	
	$Disablecat = "UPDATE `tbl_category` SET `category_status`='0' WHERE `category_id`='$Disablecat'";
	if(mysqli_query($dbc, $Disablecat))
	{
		echo "<script>alert('Category Disabled Sucessfully')</script>";
		echo "<script>window.open('categories.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('categories.php','_self')</script>";
	}
}

if(isset($_GET['Enablecat'])){
	$Enablecat		= mysqli_real_escape_string($dbc, $_GET['Enablecat']);
	
	$Enablecat = "UPDATE `tbl_category` SET `category_status`='1' WHERE `category_id`='$Enablecat'";
	if(mysqli_query($dbc, $Enablecat))
	{
		echo "<script>alert('Category Enabled Sucessfully')</script>";
		echo "<script>window.open('clients.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('clients.php','_self')</script>";
	}
}


if(isset($_POST['AddNewUser'])){
	$username		= mysqli_real_escape_string($dbc, $_POST['username']);
	$useremail		= mysqli_real_escape_string($dbc, $_POST['useremail']);
	$usermobile		= mysqli_real_escape_string($dbc, $_POST['usermobile']);
	$userpassword	= mysqli_real_escape_string($dbc, $_POST['userpassword']);
	$useraddress	= mysqli_real_escape_string($dbc, $_POST['useraddress']);
	$userrole		= mysqli_real_escape_string($dbc, $_POST['userrole']);
	$userimage		= 'user.webp';
	
	
	$AddNewUser = "INSERT INTO `tbl_users`(`user_name`, `user_email`, `user_mobile`, `user_password`, `user_address`, `user_role`, `user_image`) VALUES 
	('$username','$useremail','$usermobile','$userpassword','$useraddress','$userrole','$userimage')";
	if(mysqli_query($dbc, $AddNewUser))
	{
		echo "<script>alert('User Added Sucessfully')</script>";
		echo "<script>window.open('users.php','_self')</script>";
	}
	else
	{
		echo "<script>alert('Sorry. Something Went Wrong')</script>";
		echo "<script>window.open('users.php','_self')</script>";
	}
}
?>