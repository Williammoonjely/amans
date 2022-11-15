<?php
require 'config/dbc.php';
if(isset($_POST["NewProduct"]))
{
	$file = $_FILES["file"]["tmp_name"];
	$file_open = fopen($file,"r");
	while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
	{
	  $product_id   		= $csv[0];
	  $product_catid 		= $csv[1];
	  $product_name			= $csv[2];
	  $product_shotdec		= $csv[3];
	  $product_qty			= $csv[4];
	  $product_summery		= $csv[5];
	  $product_price		= $csv[6];
	  $product_salesprice	= $csv[7];
	  $product_SKU			= $csv[8];
	  $product_vendor		= $csv[9];
	  $product_collection	= $csv[10];
	  $product_tags			= $csv[11];
	  $product_adddate		= $csv[12];
	  $product_updatedate	= $csv[13];
	  $product_accessuser	= $csv[14];
	  $product_status		= $csv[15];
	  
  
		$productsql = "INSERT INTO `tbl_products`
		(`product_id`, `product_catid`, `product_name`, 
		`product_shotdec`, `product_qty`, `product_summery`, 
		`product_price`, `product_salesprice`, `product_SKU`, 
		`product_vendor`, `product_collection`, `product_tags`, 
		`product_adddate`, `product_updatedate`, `product_accessuser`, 
		`product_status`) VALUES
		  ('$product_id', '$product_catid', '$product_name',
		  '$product_shotdec','$product_qty','$product_summery',
		  '$product_price','$product_salesprice','$product_SKU',
		  '$product_vendor','$product_collection','$product_tags',
		  '$product_adddate','$product_updatedate','$product_accessuser','$product_status'
		  )";
		  
		  
			if(mysqli_query($dbc, $productsql))
			{
				echo "<script>alert('Your Product Added Successfully')</script>";
				
			}
			else
			{
				echo "<script>alert('Your Product Added Successfully')</script>";
				
			}
	}
}
?>