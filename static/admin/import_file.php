<?php
require 'config/dbc.php';
if(isset($_POST["NewProduct"]))
{
	$file = $_FILES["file"]["tmp_name"];
	$file_open = fopen($file,"r");
	while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
	{
	  $pimg_id  		= $csv[0];
	  $pimg_name 		= $csv[1];
	  $pimg_productid	= $csv[2];
	  
  
		$productsql = "INSERT INTO tbl_productimage  
		  (`pimg_id`, `pimg_name`, `pimg_productid`)
			VALUES
		  ('$pimg_id', '$pimg_name', '$pimg_productid')";
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